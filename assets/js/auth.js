/**
 * VIDYAZEN Authentication JavaScript
 * Handles form interactions and GSAP animations
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAnimations();
    initializeFormHandlers();
    initializeValidation();
});

// GSAP Animations
function initializeAnimations() {
    // Check if GSAP is loaded
    if (typeof gsap === 'undefined') {
        console.warn('GSAP not loaded, using fallback animations');
        fallbackAnimations();
        return;
    }

    // Set initial state
    gsap.set('.auth-card', { y: 50, opacity: 0, scale: 0.9 });
    gsap.set('.floating-shapes .shape', { scale: 0, rotation: 0 });
    gsap.set('.form-group', { y: 30, opacity: 0 });
    gsap.set('.auth-header', { y: -20, opacity: 0 });

    // Create timeline for page load animation
    const tl = gsap.timeline();

    // Animate auth header
    tl.to('.auth-header', {
        duration: 0.8,
        y: 0,
        opacity: 1,
        ease: 'power3.out'
    });

    // Animate auth card
    tl.to('.auth-card', {
        duration: 0.8,
        y: 0,
        opacity: 1,
        scale: 1,
        ease: 'power3.out'
    }, '-=0.4');

    // Animate form groups
    tl.to('.form-group', {
        duration: 0.6,
        y: 0,
        opacity: 1,
        stagger: 0.1,
        ease: 'power2.out'
    }, '-=0.4');

    // Animate floating shapes
    tl.to('.floating-shapes .shape', {
        duration: 1,
        scale: 1,
        rotation: 360,
        stagger: 0.2,
        ease: 'power2.out'
    }, '-=0.8');

    // Continuous floating animation for shapes
    gsap.to('.shape', {
        duration: 'random(10, 20)',
        y: 'random(-50, 50)',
        x: 'random(-30, 30)',
        rotation: 'random(-180, 180)',
        repeat: -1,
        yoyo: true,
        ease: 'power1.inOut',
        stagger: {
            amount: 2,
            from: 'random'
        }
    });
}

// Fallback animations for when GSAP is not available
function fallbackAnimations() {
    const authCard = document.querySelector('.auth-card');
    const formGroups = document.querySelectorAll('.form-group');
    const authHeader = document.querySelector('.auth-header');

    if (authCard) authCard.classList.add('fade-in');
    if (authHeader) authHeader.classList.add('slide-up');
    
    formGroups.forEach((group, index) => {
        setTimeout(() => {
            group.classList.add('slide-up');
        }, index * 100);
    });
}

// Form Handlers
function initializeFormHandlers() {
    // Password toggle functionality
    window.togglePassword = function(fieldId = 'password') {
        const field = document.getElementById(fieldId);
        const button = field.parentNode.querySelector('.toggle-password');
        const icon = button.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    };

    // Form submission with loading animation
    const forms = document.querySelectorAll('.auth-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('.auth-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoader = submitBtn.querySelector('.btn-loader');

            // Add loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            // Animate submission (remove if you want instant submission)
            setTimeout(() => {
                // Form will submit naturally after this timeout
                // You can remove this setTimeout for instant submission
            }, 500);
        });
    });

    // Input focus animations
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            animateInputFocus(this, true);
        });

        input.addEventListener('blur', function() {
            animateInputFocus(this, false);
        });
    });

    // Real-time validation feedback
    const emailInputs = document.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        input.addEventListener('input', validateEmail);
    });

    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        input.addEventListener('input', validatePassword);
    });
}

// Input focus animation
function animateInputFocus(input, isFocus) {
    const wrapper = input.closest('.input-wrapper');
    const icon = wrapper.querySelector('.input-icon');

    if (typeof gsap !== 'undefined') {
        if (isFocus) {
            gsap.to(wrapper, {
                duration: 0.3,
                y: -2,
                scale: 1.02,
                ease: 'power2.out'
            });
            gsap.to(icon, {
                duration: 0.2,
                scale: 1.1,
                color: '#0066FF',
                ease: 'power2.out'
            });
        } else {
            gsap.to(wrapper, {
                duration: 0.3,
                y: 0,
                scale: 1,
                ease: 'power2.out'
            });
            gsap.to(icon, {
                duration: 0.2,
                scale: 1,
                color: '#9CA3AF',
                ease: 'power2.out'
            });
        }
    }
}

// Form Validation
function initializeValidation() {
    // Real-time validation setup
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        setupRegisterValidation();
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        setupLoginValidation();
    }
}

function setupRegisterValidation() {
    const form = document.getElementById('registerForm');
    const password = form.querySelector('input[name="password"]');
    const confirmPassword = form.querySelector('input[name="confirm_password"]');

    // Password match validation
    function validatePasswordMatch() {
        if (password.value && confirmPassword.value) {
            if (password.value !== confirmPassword.value) {
                showFieldError(confirmPassword, 'Passwords do not match');
                return false;
            } else {
                clearFieldError(confirmPassword);
                return true;
            }
        }
        return true;
    }

    if (password && confirmPassword) {
        confirmPassword.addEventListener('input', validatePasswordMatch);
        password.addEventListener('input', validatePasswordMatch);
    }
}

function setupLoginValidation() {
    // Add any login-specific validation here
}

function validateEmail(event) {
    const input = event.target;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (input.value && !emailRegex.test(input.value)) {
        showFieldError(input, 'Please enter a valid email address');
    } else {
        clearFieldError(input);
    }
}

function validatePassword(event) {
    const input = event.target;
    const password = input.value;
    
    if (password && password.length < 6) {
        showFieldError(input, 'Password must be at least 6 characters');
    } else {
        clearFieldError(input);
    }
}

function showFieldError(input, message) {
    clearFieldError(input); // Clear any existing error
    
    const wrapper = input.closest('.input-wrapper');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
    
    wrapper.parentNode.insertBefore(errorDiv, wrapper.nextSibling);
    
    // Style the error message
    Object.assign(errorDiv.style, {
        color: '#EF4444',
        fontSize: '0.75rem',
        marginTop: '0.5rem',
        display: 'flex',
        alignItems: 'center',
        gap: '0.25rem'
    });
    
    // Add error styling to input
    input.style.borderColor = '#EF4444';
    input.style.background = 'rgba(239, 68, 68, 0.05)';
    
    // Animate error appearance
    if (typeof gsap !== 'undefined') {
        gsap.from(errorDiv, {
            duration: 0.3,
            opacity: 0,
            y: -10,
            ease: 'power2.out'
        });
    }
}

function clearFieldError(input) {
    const wrapper = input.closest('.input-wrapper');
    const existingError = wrapper.parentNode.querySelector('.field-error');
    
    if (existingError) {
        existingError.remove();
    }
    
    // Reset input styling
    input.style.borderColor = '';
    input.style.background = '';
}

// Utility Functions
function showMessage(message, type = 'info') {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.innerHTML = `
        <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
        ${message}
    `;
    
    // Style the message
    Object.assign(messageDiv.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '1rem 1.5rem',
        borderRadius: '0.75rem',
        color: type === 'error' ? '#EF4444' : '#10B981',
        background: type === 'error' ? 'rgba(239, 68, 68, 0.1)' : 'rgba(16, 185, 129, 0.1)',
        border: `1px solid ${type === 'error' ? 'rgba(239, 68, 68, 0.2)' : 'rgba(16, 185, 129, 0.2)'}`,
        boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
        zIndex: '9999',
        display: 'flex',
        alignItems: 'center',
        gap: '0.75rem',
        fontWeight: '500',
        fontSize: '0.875rem'
    });
    
    document.body.appendChild(messageDiv);
    
    // Animate in
    if (typeof gsap !== 'undefined') {
        gsap.from(messageDiv, {
            duration: 0.4,
            x: 100,
            opacity: 0,
            ease: 'power3.out'
        });
    }
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (typeof gsap !== 'undefined') {
            gsap.to(messageDiv, {
                duration: 0.3,
                x: 100,
                opacity: 0,
                ease: 'power2.in',
                onComplete: () => messageDiv.remove()
            });
        } else {
            messageDiv.remove();
        }
    }, 5000);
}

// Enhanced interactions
function addInteractiveEffects() {
    // Button ripple effect
    const buttons = document.querySelectorAll('.auth-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            createRipple(e, this);
        });
    });
}

function createRipple(event, button) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        transform: scale(0);
        pointer-events: none;
    `;
    
    button.appendChild(ripple);
    
    if (typeof gsap !== 'undefined') {
        gsap.to(ripple, {
            duration: 0.6,
            scale: 2,
            opacity: 0,
            ease: 'power2.out',
            onComplete: () => ripple.remove()
        });
    } else {
        setTimeout(() => ripple.remove(), 600);
    }
}

// Initialize enhanced interactions when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(addInteractiveEffects, 1000);
});