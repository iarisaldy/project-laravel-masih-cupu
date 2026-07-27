/**
 * App Interactivity & Client State Manager for Personal Web Profile & Admin System
 */

document.addEventListener('DOMContentLoaded', () => {
  initThemeToggle();
  initPortfolioFilters();
  initContactForm();
  initModals();
  initAdminDashboard();
  initSmoothScroll();
});

/* --- Theme Management --- */
function initThemeToggle() {
  const toggleBtn = document.getElementById('theme-toggle-btn');
  const storedTheme = localStorage.getItem('app-theme') || 'dark';
  
  document.documentElement.setAttribute('data-theme', storedTheme);
  updateThemeIcon(toggleBtn, storedTheme);

  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const currentTheme = document.documentElement.getAttribute('data-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('app-theme', newTheme);
      updateThemeIcon(toggleBtn, newTheme);
    });
  }
}

function updateThemeIcon(btn, theme) {
  if (!btn) return;
  btn.innerHTML = theme === 'dark' ? '☀️' : '🌙';
  btn.setAttribute('aria-label', `Switch to ${theme === 'dark' ? 'light' : 'dark'} mode`);
}

/* --- Portfolio Filtering --- */
function initPortfolioFilters() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const projectCards = document.querySelectorAll('.project-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');

      projectCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filterValue === 'all' || category === filterValue) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.4s ease';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

/* --- Contact Form Handling --- */
function initContactForm() {
  const contactForm = document.getElementById('contact-form');
  if (!contactForm) return;

  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const submitBtn = contactForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = 'Sending... ⏳';
    submitBtn.disabled = true;

    const formData = new FormData(contactForm);
    const data = {
      name: formData.get('name'),
      email: formData.get('email'),
      subject: formData.get('subject'),
      message: formData.get('message'),
      created_at: new Date().toISOString()
    };

    // Store message in local storage for admin inbox sync
    saveInboxMessage(data);

    // Try posting to Laravel endpoint
    try {
      await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
    } catch (err) {
      console.log('Local fallback used for contact message');
    }

    setTimeout(() => {
      showToast('✨ Message sent successfully! I will reply soon.');
      contactForm.reset();
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
    }, 800);
  });
}

function saveInboxMessage(msg) {
  const messages = JSON.parse(localStorage.getItem('inbox_messages') || '[]');
  messages.unshift({ id: Date.now(), ...msg, status: 'unread' });
  localStorage.setItem('inbox_messages', JSON.stringify(messages));
}

/* --- Modal System --- */
function initModals() {
  const modalTriggers = document.querySelectorAll('[data-modal]');
  const modalCloseBtns = document.querySelectorAll('.modal-close');
  const modalOverlays = document.querySelectorAll('.modal-overlay');

  modalTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const modalId = trigger.getAttribute('data-modal');
      const targetModal = document.getElementById(modalId);
      if (targetModal) {
        targetModal.classList.add('active');
      }
    });
  });

  modalCloseBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const modal = btn.closest('.modal-overlay');
      if (modal) modal.classList.remove('active');
    });
  });

  modalOverlays.forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('active');
      }
    });
  });
}

/* --- Admin Dashboard Controls --- */
function initAdminDashboard() {
  const adminMenuItems = document.querySelectorAll('.admin-menu-item');
  const adminTabs = document.querySelectorAll('.admin-tab-content');

  if (adminMenuItems.length > 0) {
    adminMenuItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        const tabTarget = item.getAttribute('data-tab');

        adminMenuItems.forEach(m => m.classList.remove('active'));
        adminTabs.forEach(t => t.classList.remove('active'));

        item.classList.add('active');
        const activeTab = document.getElementById(`tab-${tabTarget}`);
        if (activeTab) activeTab.classList.add('active');
      });
    });

    renderAdminInbox();
    initProjectCrud();
  }
}

function renderAdminInbox() {
  const inboxContainer = document.getElementById('admin-inbox-list');
  if (!inboxContainer) return;

  const defaultInbox = [
    { id: 1, name: 'Alice Smith', email: 'alice@company.io', subject: 'Project Collaboration Request', message: 'Hi! We would love to discuss an enterprise project with you.', created_at: '2026-07-26 14:30', status: 'unread' },
    { id: 2, name: 'Budi Santoso', email: 'budi@techcorp.id', subject: 'Senior Full Stack Position', message: 'Halo mas, tertarik join tech lead position di tim kami?', created_at: '2026-07-25 09:15', status: 'read' }
  ];

  const storedMessages = JSON.parse(localStorage.getItem('inbox_messages') || 'null');
  const messages = storedMessages || defaultInbox;

  if (messages.length === 0) {
    inboxContainer.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--text-muted); padding: 2rem;">No messages in inbox.</td></tr>';
    return;
  }

  inboxContainer.innerHTML = messages.map(msg => `
    <tr>
      <td><strong>${escapeHtml(msg.name)}</strong><br><small style="color: var(--text-muted);">${escapeHtml(msg.email)}</small></td>
      <td>${escapeHtml(msg.subject)}</td>
      <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(msg.message)}</td>
      <td><span class="status-badge" style="padding: 0.2rem 0.6rem; font-size: 0.75rem; background: ${msg.status === 'unread' ? 'rgba(99, 102, 241, 0.15)' : 'rgba(148, 163, 184, 0.15)'}; color: ${msg.status === 'unread' ? 'var(--accent-primary)' : 'var(--text-secondary)'};">${msg.status}</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="deleteInboxMessage(${msg.id})">Delete</button>
      </td>
    </tr>
  `).join('');

  // Update counter
  const unreadCount = messages.filter(m => m.status === 'unread').length;
  const countBadge = document.getElementById('unread-msg-count');
  if (countBadge) countBadge.textContent = unreadCount;
}

window.deleteInboxMessage = function(id) {
  let messages = JSON.parse(localStorage.getItem('inbox_messages') || '[]');
  messages = messages.filter(m => m.id !== id);
  localStorage.setItem('inbox_messages', JSON.stringify(messages));
  renderAdminInbox();
  showToast('Message deleted.');
};

/* --- Project CRUD in Admin --- */
function initProjectCrud() {
  const addProjectForm = document.getElementById('add-project-form');
  if (!addProjectForm) return;

  addProjectForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(addProjectForm);
    const newProject = {
      id: Date.now(),
      title: formData.get('title'),
      category: formData.get('category'),
      tech_stack: formData.get('tech_stack'),
      description: formData.get('description'),
      demo_url: formData.get('demo_url') || '#',
      github_url: formData.get('github_url') || '#'
    };

    const projects = JSON.parse(localStorage.getItem('custom_projects') || '[]');
    projects.push(newProject);
    localStorage.setItem('custom_projects', JSON.stringify(projects));

    showToast('🚀 Project added successfully!');
    addProjectForm.reset();
    const modal = document.getElementById('add-project-modal');
    if (modal) modal.classList.remove('active');

    setTimeout(() => location.reload(), 800);
  });
}

/* --- Smooth Scrolling --- */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        targetElement.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
}

/* --- Toast System --- */
function showToast(message) {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.innerHTML = `<span>💬</span> <div>${escapeHtml(message)}</div>`;

  container.appendChild(toast);

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    toast.style.transition = 'all 0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}

function escapeHtml(str) {
  return String(str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
