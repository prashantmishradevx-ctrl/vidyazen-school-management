<?php
require_once '../includes/Auth.php';

$auth = new Auth();
$auth->requireRole(['teacher']);

// Get user info
$userId = $auth->getUserId();
$userName = $_SESSION['full_name'] ?? 'Teacher User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - VIDYAZEN</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="logo-text">VIDYAZEN</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-menu">
                <ul class="nav-items">
                    <li class="nav-item active">
                        <a href="dashboard.php" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="classes.php" class="nav-link">
                            <i class="fas fa-school"></i>
                            <span class="nav-text">My Classes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="students.php" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                            <span class="nav-text">Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="grades.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">Grade Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="attendance.php" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span class="nav-text">Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="assignments.php" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <span class="nav-text">Assignments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="doubts.php" class="nav-link">
                            <i class="fas fa-question-circle"></i>
                            <span class="nav-text">Student Doubts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="meetings.php" class="nav-link">
                            <i class="fas fa-video"></i>
                            <span class="nav-text">Meetings</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-footer">
                    <a href="../logout.php" class="nav-link logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Teacher Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="header-actions">
                        <button class="header-btn notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-count">4</span>
                        </button>
                        <div class="user-menu">
                            <button class="user-btn">
                                <div class="user-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="user-name"><?php echo htmlspecialchars($userName); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">5</h3>
                            <p class="stat-label">Classes Assigned</p>
                            <span class="stat-change neutral">This semester</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">142</h3>
                            <p class="stat-label">Total Students</p>
                            <span class="stat-change positive">+8 new students</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">23</h3>
                            <p class="stat-label">Pending Assignments</p>
                            <span class="stat-change neutral">To be graded</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">7</h3>
                            <p class="stat-label">Unanswered Doubts</p>
                            <span class="stat-change positive">Response needed</span>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Today's Classes -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2 class="card-title">Today's Classes</h2>
                            <button class="card-action">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Mathematics</strong> - Grade 10A</p>
                                        <span class="activity-time">10:00 AM - Room 201</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Mathematics</strong> - Grade 9B</p>
                                        <span class="activity-time">02:00 PM - Room 205</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Algebra</strong> - Grade 11A</p>
                                        <span class="activity-time">03:30 PM - Room 201</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2 class="card-title">Quick Actions</h2>
                        </div>
                        <div class="card-content">
                            <div class="quick-actions">
                                <button class="action-btn">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Take Attendance</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Assignment</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Enter Grades</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-reply"></i>
                                    <span>Answer Doubts</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="content-card full-width">
                        <div class="card-header">
                            <h2 class="card-title">Recent Activities</h2>
                            <div class="card-filters">
                                <select class="filter-select">
                                    <option>All Classes</option>
                                    <option>Grade 10A</option>
                                    <option>Grade 9B</option>
                                    <option>Grade 11A</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-question-circle"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Sarah Johnson</strong> asked about quadratic equations</p>
                                        <span class="activity-time">2 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Graded 15 assignments from <strong>Grade 10A</strong></p>
                                        <span class="activity-time">4 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Attendance taken for <strong>Mathematics - Grade 9B</strong></p>
                                        <span class="activity-time">1 day ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Created new assignment: <strong>Trigonometry Practice</strong></p>
                                        <span class="activity-time">2 days ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../assets/js/dashboard.js"></script>
</body>
</html>