<?php
require_once 'includes/Auth.php';

$auth = new Auth();
$error = '';
$success = '';

// Redirect if already logged in
if ($auth->isLoggedIn()) {
    $userType = $auth->getUserType();
    switch ($userType) {
        case 'admin':
            header('Location: admin/dashboard.php');
            break;
        case 'student':
            header('Location: student/dashboard.php');
            break;
        case 'parent':
            header('Location: parent/dashboard.php');
            break;
        case 'teacher':
            header('Location: teacher/dashboard.php');
            break;
        default:
            header('Location: index.php');
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $userType = $_POST['user_type'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    
    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || 
        empty($firstName) || empty($lastName) || empty($userType)) {
        $error = 'Please fill in all required fields';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        // Prepare user data
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'user_type' => $userType,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => $phone,
            'address' => $address
        ];
        
        $result = $auth->register($userData);
        
        if ($result['success']) {
            $success = 'Registration successful! You can now login with your credentials.';
            // Clear form data on success
            $_POST = [];
        } else {
            $error = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VIDYAZEN</title>
    <link rel="stylesheet" href="assets/css/auth.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-background">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </div>
        
        <div class="auth-card register-card">
            <div class="auth-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <h1>VIDYAZEN</h1>
                </div>
                <p class="subtitle">Join our educational community</p>
            </div>
            
            <form method="POST" class="auth-form" id="registerForm">
                <?php if ($error): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <div class="form-row">
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input 
                                type="text" 
                                name="first_name" 
                                placeholder="First Name"
                                value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>"
                                required
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input 
                                type="text" 
                                name="last_name" 
                                placeholder="Last Name"
                                value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>"
                                required
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-at input-icon"></i>
                        <input 
                            type="text" 
                            name="username" 
                            placeholder="Username"
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Email Address"
                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-users input-icon"></i>
                        <select name="user_type" required>
                            <option value="">Select Your Role</option>
                            <option value="student" <?php echo (($_POST['user_type'] ?? '') === 'student') ? 'selected' : ''; ?>>Student</option>
                            <option value="parent" <?php echo (($_POST['user_type'] ?? '') === 'parent') ? 'selected' : ''; ?>>Parent</option>
                            <option value="teacher" <?php echo (($_POST['user_type'] ?? '') === 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                placeholder="Password"
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePasswordField('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input 
                                type="password" 
                                name="confirm_password" 
                                id="confirm_password"
                                placeholder="Confirm Password"
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePasswordField('confirm_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-phone input-icon"></i>
                        <input 
                            type="tel" 
                            name="phone" 
                            placeholder="Phone Number (Optional)"
                            value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <textarea 
                            name="address" 
                            placeholder="Address (Optional)"
                            rows="2"
                        ><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <button type="submit" class="auth-btn register-btn">
                    <span class="btn-text">Create Account</span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="login.php" class="switch-link">Login Here</a></p>
                    <p><a href="index.php" class="switch-link">← Back to Dashboard Selector</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script src="assets/js/auth.js"></script>
    
    <script>
    function togglePasswordField(fieldId) {
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
    }
    </script>
    
    <style>
    .register-card {
        max-width: 650px !important;
        width: 95% !important;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .form-group select {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 0.875rem;
        color: #374151;
        background: #FFFFFF;
        transition: all 0.2s ease;
        outline: none;
    }
    
    .form-group select:focus {
        border-color: #0066FF;
        box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
    }
    
    .form-group textarea {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 0.875rem;
        color: #374151;
        background: #FFFFFF;
        transition: all 0.2s ease;
        outline: none;
        resize: vertical;
        font-family: 'Inter', sans-serif;
    }
    
    .form-group textarea:focus {
        border-color: #0066FF;
        box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
    }
    
    .success-message {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        padding: 0.875rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .success-message i {
        color: #10b981;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .register-card {
            max-width: 95% !important;
        }
    }
    </style>
</body>
</html>