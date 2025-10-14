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
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        $result = $auth->login($username, $password);
        
        if ($result['success']) {
            // Redirect based on user type
            switch ($result['user_type']) {
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
    <title>Login - VIDYAZEN</title>
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
        
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <h1>VIDYAZEN</h1>
                </div>
                <p class="subtitle">Welcome back to your educational journey</p>
            </div>
            
            <form method="POST" class="auth-form" id="loginForm">
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
                
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            placeholder="Username or Email"
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                            required
                        >
                    </div>
                </div>
                
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
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="forgot-password.php" class="forgot-link">Forgot Password?</a>
                </div>
                
                <button type="submit" class="auth-btn login-btn">
                    <span class="btn-text">Sign In</span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php" class="switch-link">Register Here</a></p>
                    <p><a href="index.php" class="switch-link">← Back to Dashboard Selector</a></p>
                </div>
            </form>
            
            <div class="demo-credentials">
                <h4>Demo Credentials:</h4>
                <div class="demo-grid">
                    <div class="demo-item">
                        <strong>Admin:</strong> admin / password
                    </div>
                    <div class="demo-item">
                        <strong>Student:</strong> student@demo.com / password
                    </div>
                    <div class="demo-item">
                        <strong>Parent:</strong> parent@demo.com / password
                    </div>
                    <div class="demo-item">
                        <strong>Teacher:</strong> teacher@demo.com / password
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/auth.js"></script>
    
    <style>
    .demo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .demo-item {
        font-size: 0.75rem;
        padding: 0.5rem;
        background: rgba(0, 102, 255, 0.05);
        border-radius: 4px;
        border-left: 3px solid #0066FF;
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
    </style>
</body>
</html>
