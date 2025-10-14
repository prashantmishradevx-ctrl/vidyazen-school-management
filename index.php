<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIDYAZEN - School Management System</title>
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
                <p class="subtitle">School Management System</p>
                <p class="subtitle" style="font-size: 0.9rem; margin-top: 0.5rem; color: #6B7280;">Select a dashboard to explore the system</p>
            </div>
            
            <div class="dashboard-selector">
                <h3 style="text-align: center; margin-bottom: 1.5rem; color: #374151;">Choose Dashboard</h3>
                
                <div class="dashboard-grid">
                    <a href="admin/dashboard.php" class="dashboard-card">
                        <div class="dashboard-icon admin">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>Admin Dashboard</h4>
                        <p>Complete system administration, user management, and analytics</p>
                    </a>
                    
                    <a href="student/dashboard.php" class="dashboard-card">
                        <div class="dashboard-icon student">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4>Student Dashboard</h4>
                        <p>View grades, attendance, assignments, and class schedules</p>
                    </a>
                    
                    <a href="parent/dashboard.php" class="dashboard-card">
                        <div class="dashboard-icon parent">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Parent Dashboard</h4>
                        <p>Monitor children's progress, fees, and school communications</p>
                    </a>
                    
                    <a href="teacher/dashboard.php" class="dashboard-card">
                        <div class="dashboard-icon teacher">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4>Teacher Dashboard</h4>
                        <p>Manage classes, grades, attendance, and student interactions</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/auth.js"></script>
    
    <style>
    .dashboard-selector {
        margin-top: 2rem;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .dashboard-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: center;
    }
    
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #e2e8f0;
    }
    
    .dashboard-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: white;
    }
    
    .dashboard-icon.admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .dashboard-icon.student {
        background: linear-gradient(135deg, #0066FF 0%, #4c9aff 100%);
    }
    
    .dashboard-icon.parent {
        background: linear-gradient(135deg, #10B981 0%, #34d399 100%);
    }
    
    .dashboard-icon.teacher {
        background: linear-gradient(135deg, #F59E0B 0%, #fbbf24 100%);
    }
    
    .dashboard-card h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .dashboard-card p {
        margin: 0;
        font-size: 0.8rem;
        color: #6b7280;
        line-height: 1.4;
    }
    
    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .dashboard-card {
            padding: 1.25rem;
        }
    }
    
    /* Make auth-card wider for dashboard grid */
    .auth-card {
        max-width: 600px !important;
        width: 90% !important;
    }
    </style>
</body>
</html>