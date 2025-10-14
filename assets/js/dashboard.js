/**
 * VIDYAZEN Dashboard JavaScript
 * Handles dashboard interactions and GSAP animations
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAnimations();
    initializeSidebar();
    initializeComponents();
    initializeInteractions();
});

// GSAP Animations
function initializeAnimations() {
    // Check if GSAP is loaded
    if (typeof gsap === 'undefined') {
        console.warn('GSAP not loaded, using fallback animations');
        return;
    }

    // Set initial state
    gsap.set('.stat-card', { y: 50, opacity: 0, scale: 0.9 });
    gsap.set('.content-card', { y: 30, opacity: 0 });
    gsap.set('.activity-item', { x: -50, opacity: 0 });
    gsap.set('.action-btn', { scale: 0, rotation: -10 });

    // Create main timeline
    const mainTL = gsap.timeline();

    // Animate stat cards with stagger
    mainTL.to('.stat-card', {
        duration: 0.8,
        y: 0,
        opacity: 1,
        scale: 1,
        stagger: 0.1,
        ease: 'back.out(1.7)'
    });

    // Animate content cards
    mainTL.to('.content-card', {
        duration: 0.6,
        y: 0,
        opacity: 1,
        stagger: 0.15,
        ease: 'power3.out'
    }, '-=0.4');

    // Animate activity items
    mainTL.to('.activity-item', {
        duration: 0.5,
        x: 0,
        opacity: 1,
        stagger: 0.1,
        ease: 'power2.out'
    }, '-=0.3');

    // Animate action buttons
    mainTL.to('.action-btn', {
        duration: 0.6,
        scale: 1,
        rotation: 0,
        stagger: 0.1,
        ease: 'back.out(1.7)'
    }, '-=0.4');

    // Animate attendance circles
    animateAttendanceCircles();
}

function animateAttendanceCircles() {
    if (typeof gsap === 'undefined') return;

    gsap.set('.attendance-circle', { rotation: 0 });
    
    gsap.to('.attendance-circle.present', {
        rotation: 331.2,
        duration: 2,
        ease: 'power2.out',
        delay: 1
    });
    
    gsap.to('.attendance-circle.absent', {
        rotation: 18,
        duration: 1.5,
        ease: 'power2.out',
        delay: 1.2
    });
    
    gsap.to('.attendance-circle.late', {
        rotation: 10.8,
        duration: 1.3,
        ease: 'power2.out',
        delay: 1.4
    });
}

// Sidebar functionality
function initializeSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
    const mainContent = document.querySelector('.main-content');

    // Desktop sidebar toggle
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Animate with GSAP if available
            if (typeof gsap !== 'undefined') {
                if (sidebar.classList.contains('collapsed')) {
                    gsap.to('.nav-text, .logo-text', {
                        duration: 0.2,
                        opacity: 0,
                        onComplete: () => {
                            document.querySelectorAll('.nav-text, .logo-text').forEach(el => {
                                el.style.visibility = 'hidden';
                            });
                        }
                    });
                } else {
                    document.querySelectorAll('.nav-text, .logo-text').forEach(el => {
                        el.style.visibility = 'visible';
                    });
                    gsap.to('.nav-text, .logo-text', {
                        duration: 0.3,
                        opacity: 1,
                        delay: 0.1
                    });
                }
            }
        });
    }

    // Mobile sidebar toggle
    if (mobileSidebarToggle) {
        mobileSidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('mobile-open');
            
            // Animate with GSAP if available
            if (typeof gsap !== 'undefined') {
                if (sidebar.classList.contains('mobile-open')) {
                    gsap.fromTo(sidebar, {
                        x: '-100%'
                    }, {
                        duration: 0.3,
                        x: '0%',
                        ease: 'power2.out'
                    });
                }
            }
        });
    }

    // Close mobile sidebar when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024) {
            if (!sidebar.contains(e.target) && !mobileSidebarToggle.contains(e.target)) {
                if (sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                    
                    if (typeof gsap !== 'undefined') {
                        gsap.to(sidebar, {
                            duration: 0.3,
                            x: '-100%',
                            ease: 'power2.in'
                        });
                    }
                }
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('mobile-open');
            if (typeof gsap !== 'undefined') {
                gsap.set(sidebar, { x: '0%' });
            }
        }
    });
}

// Initialize components
function initializeComponents() {
    // Animated counters for stat cards
    initializeCounters();
    
    // Interactive hover effects
    initializeHoverEffects();
    
    // Initialize tooltips
    initializeTooltips();
}

function initializeCounters() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(element => {
        const target = parseFloat(element.textContent.replace(/[^\d.]/g, ''));
        const prefix = element.textContent.replace(/[\d.]/g, '');
        const suffix = element.textContent.slice(-1).match(/[^\d]/) ? element.textContent.slice(-1) : '';
        
        if (typeof gsap !== 'undefined') {
            gsap.fromTo(element, {
                textContent: 0
            }, {
                duration: 2,
                textContent: target,
                delay: 0.5,
                ease: 'power2.out',
                snap: { textContent: 1 },
                onUpdate: function() {
                    element.textContent = prefix + Math.round(this.targets()[0].textContent) + suffix;
                }
            });
        }
    });
}

function initializeHoverEffects() {
    // Stat card hover effects
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            if (typeof gsap !== 'undefined') {
                gsap.to(this.querySelector('.stat-icon'), {
                    duration: 0.3,
                    scale: 1.1,
                    rotation: 5,
                    ease: 'back.out(1.7)'
                });
            }
        });

        card.addEventListener('mouseleave', function() {
            if (typeof gsap !== 'undefined') {
                gsap.to(this.querySelector('.stat-icon'), {
                    duration: 0.3,
                    scale: 1,
                    rotation: 0,
                    ease: 'power2.out'
                });
            }
        });
    });

    // Action button hover effects
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            if (typeof gsap !== 'undefined') {
                gsap.to(this.querySelector('i'), {
                    duration: 0.3,
                    scale: 1.2,
                    rotation: 10,
                    ease: 'back.out(1.7)'
                });
            }
        });

        btn.addEventListener('mouseleave', function() {
            if (typeof gsap !== 'undefined') {
                gsap.to(this.querySelector('i'), {
                    duration: 0.3,
                    scale: 1,
                    rotation: 0,
                    ease: 'power2.out'
                });
            }
        });
    });
}

function initializeTooltips() {
    // Simple tooltip implementation
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', showTooltip);
        element.addEventListener('mouseleave', hideTooltip);
    });
}

function showTooltip(e) {
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = e.target.getAttribute('data-tooltip');
    
    Object.assign(tooltip.style, {
        position: 'absolute',
        background: 'var(--gray-800)',
        color: 'var(--white)',
        padding: '0.5rem 0.75rem',
        borderRadius: 'var(--radius-md)',
        fontSize: '0.875rem',
        fontWeight: '500',
        zIndex: '9999',
        pointerEvents: 'none',
        opacity: '0',
        transition: 'opacity 0.2s ease'
    });
    
    document.body.appendChild(tooltip);
    
    // Position tooltip
    const rect = e.target.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
    
    // Animate in
    setTimeout(() => tooltip.style.opacity = '1', 10);
    
    e.target._tooltip = tooltip;
}

function hideTooltip(e) {
    if (e.target._tooltip) {
        e.target._tooltip.style.opacity = '0';
        setTimeout(() => {
            if (e.target._tooltip && e.target._tooltip.parentNode) {
                e.target._tooltip.parentNode.removeChild(e.target._tooltip);
            }
        }, 200);
    }
}

// Initialize interactions
function initializeInteractions() {
    // Notification button
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', showNotifications);
    }

    // User menu
    const userBtn = document.querySelector('.user-btn');
    if (userBtn) {
        userBtn.addEventListener('click', toggleUserMenu);
    }

    // Card actions
    document.querySelectorAll('.card-action').forEach(btn => {
        btn.addEventListener('click', handleCardAction);
    });

    // Quick actions
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', handleQuickAction);
    });

    // Filter changes
    document.querySelectorAll('.filter-select').forEach(select => {
        select.addEventListener('change', handleFilterChange);
    });
}

function showNotifications() {
    // Create notification dropdown
    const dropdown = document.createElement('div');
    dropdown.className = 'notification-dropdown';
    dropdown.innerHTML = `
        <div class="notification-header">
            <h3>Notifications</h3>
            <button class="mark-all-read">Mark all as read</button>
        </div>
        <div class="notification-list">
            <div class="notification-item unread">
                <div class="notification-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="notification-content">
                    <p>New student registration</p>
                    <span class="notification-time">2 minutes ago</span>
                </div>
            </div>
            <div class="notification-item unread">
                <div class="notification-icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="notification-content">
                    <p>Fee payment received</p>
                    <span class="notification-time">1 hour ago</span>
                </div>
            </div>
            <div class="notification-item">
                <div class="notification-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="notification-content">
                    <p>Meeting scheduled</p>
                    <span class="notification-time">2 hours ago</span>
                </div>
            </div>
        </div>
    `;

    // Style the dropdown
    Object.assign(dropdown.style, {
        position: 'absolute',
        top: '100%',
        right: '0',
        width: '320px',
        background: 'var(--white)',
        borderRadius: 'var(--radius-lg)',
        boxShadow: 'var(--shadow-xl)',
        border: '1px solid var(--gray-200)',
        zIndex: '1000',
        maxHeight: '400px',
        overflowY: 'auto'
    });

    // Position relative to notification button
    const notificationBtn = document.querySelector('.notification-btn');
    notificationBtn.style.position = 'relative';
    notificationBtn.appendChild(dropdown);

    // Animate in
    if (typeof gsap !== 'undefined') {
        gsap.fromTo(dropdown, {
            opacity: 0,
            y: -20
        }, {
            duration: 0.3,
            opacity: 1,
            y: 0,
            ease: 'power2.out'
        });
    }

    // Close dropdown when clicking outside
    setTimeout(() => {
        document.addEventListener('click', function closeDropdown(e) {
            if (!notificationBtn.contains(e.target)) {
                if (dropdown.parentNode) {
                    dropdown.parentNode.removeChild(dropdown);
                }
                document.removeEventListener('click', closeDropdown);
            }
        });
    }, 100);
}

function toggleUserMenu() {
    showMessage('User menu functionality to be implemented', 'info');
}

function handleCardAction(e) {
    const card = e.target.closest('.content-card');
    const cardTitle = card.querySelector('.card-title').textContent;
    showMessage(`${cardTitle} actions menu`, 'info');
}

function handleQuickAction(e) {
    const actionText = e.currentTarget.querySelector('span').textContent;
    
    // Add click animation
    if (typeof gsap !== 'undefined') {
        gsap.to(e.currentTarget, {
            duration: 0.1,
            scale: 0.95,
            yoyo: true,
            repeat: 1,
            ease: 'power2.inOut'
        });
    }
    
    showMessage(`${actionText} functionality to be implemented`, 'info');
}

function handleFilterChange(e) {
    const filterValue = e.target.value;
    showMessage(`Filter changed to: ${filterValue}`, 'info');
    
    // Here you would typically reload data based on filter
    // For demo purposes, we'll just animate the content
    if (typeof gsap !== 'undefined') {
        const content = e.target.closest('.content-card').querySelector('.card-content');
        gsap.fromTo(content, {
            opacity: 0.5,
            scale: 0.98
        }, {
            duration: 0.4,
            opacity: 1,
            scale: 1,
            ease: 'power2.out'
        });
    }
}

// Utility function to show messages
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `toast toast-${type}`;
    
    const icons = {
        info: 'fa-info-circle',
        success: 'fa-check-circle',
        warning: 'fa-exclamation-triangle',
        error: 'fa-exclamation-circle'
    };
    
    const colors = {
        info: '#3B82F6',
        success: '#10B981',
        warning: '#F59E0B',
        error: '#EF4444'
    };
    
    messageDiv.innerHTML = `
        <div class="toast-content">
            <i class="fas ${icons[type]}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    Object.assign(messageDiv.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        background: colors[type],
        color: 'white',
        padding: '1rem',
        borderRadius: 'var(--radius-lg)',
        boxShadow: 'var(--shadow-xl)',
        zIndex: '9999',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        gap: '1rem',
        minWidth: '300px',
        maxWidth: '400px',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease'
    });
    
    document.body.appendChild(messageDiv);
    
    // Animate in
    setTimeout(() => {
        messageDiv.style.transform = 'translateX(0)';
    }, 10);
    
    // Close button functionality
    messageDiv.querySelector('.toast-close').addEventListener('click', () => {
        messageDiv.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.parentNode.removeChild(messageDiv);
            }
        }, 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.parentNode.removeChild(messageDiv);
                }
            }, 300);
        }
    }, 5000);
}

// Real-time updates simulation
function simulateRealTimeUpdates() {
    setInterval(() => {
        // Update notification count randomly
        const notificationCount = document.querySelector('.notification-count');
        if (notificationCount) {
            const currentCount = parseInt(notificationCount.textContent);
            const newCount = Math.max(0, currentCount + Math.floor(Math.random() * 3) - 1);
            notificationCount.textContent = newCount;
            
            if (newCount === 0) {
                notificationCount.style.display = 'none';
            } else {
                notificationCount.style.display = 'block';
            }
        }
    }, 30000); // Update every 30 seconds
}

// Initialize real-time updates
setTimeout(simulateRealTimeUpdates, 5000);

// Add CSS for dynamic elements
const dynamicStyles = `
    .notification-dropdown {
        animation: slideDown 0.3s ease-out;
    }
    
    .notification-header {
        padding: 1rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .notification-header h3 {
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
    }
    
    .mark-all-read {
        background: none;
        border: none;
        color: var(--primary-blue);
        font-size: 0.875rem;
        cursor: pointer;
    }
    
    .notification-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .notification-item {
        display: flex;
        gap: 0.75rem;
        padding: 1rem;
        border-bottom: 1px solid var(--gray-100);
        transition: background-color 0.2s ease;
    }
    
    .notification-item:hover {
        background: var(--gray-50);
    }
    
    .notification-item.unread {
        background: rgba(0, 102, 255, 0.05);
    }
    
    .notification-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary-blue);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        flex-shrink: 0;
    }
    
    .notification-content p {
        font-weight: 500;
        margin: 0 0 0.25rem 0;
        font-size: 0.875rem;
    }
    
    .notification-time {
        font-size: 0.75rem;
        color: var(--gray-500);
    }
    
    .toast-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .toast-close {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 50%;
        transition: background-color 0.2s ease;
    }
    
    .toast-close:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;

// Inject dynamic styles
const styleSheet = document.createElement('style');
styleSheet.textContent = dynamicStyles;
document.head.appendChild(styleSheet);