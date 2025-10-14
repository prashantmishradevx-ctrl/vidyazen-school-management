<?php
require_once '../includes/Auth.php';

$auth = new Auth();
$auth->requireRole(['admin']);

// Get user info
$userId = $auth->getUserId();
$userName = $_SESSION['full_name'] ?? 'Admin User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - VIDYAZEN</title>
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
                        <a href="students.php" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                            <span class="nav-text">Students</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="parents.php" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Parents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="teachers.php" class="nav-link">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span class="nav-text">Teachers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="classes.php" class="nav-link">
                            <i class="fas fa-school"></i>
                            <span class="nav-text">Classes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="fees.php" class="nav-link">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="nav-text">Fee Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="grades.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">Grades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="meetings.php" class="nav-link">
                            <i class="fas fa-video"></i>
                            <span class="nav-text">Meetings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="announcements.php" class="nav-link">
                            <i class="fas fa-bullhorn"></i>
                            <span class="nav-text">Announcements</span>
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
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="header-actions">
                        <button class="header-btn notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-count">3</span>
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
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">1,234</h3>
                            <p class="stat-label">Total Students</p>
                            <span class="stat-change positive">+12 this month</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">89</h3>
                            <p class="stat-label">Teachers</p>
                            <span class="stat-change positive">+5 this month</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">45</h3>
                            <p class="stat-label">Classes</p>
                            <span class="stat-change neutral">No change</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">₹12.5L</h3>
                            <p class="stat-label">Revenue</p>
                            <span class="stat-change positive">+8.2% this month</span>
                        </div>
                    </div>
                </div>

                <!-- Charts and Tables Section -->
                <div class="content-grid">
                    <!-- Recent Activities -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Activities</h2>
                            <button class="card-action">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">New student <strong>John Doe</strong> registered</p>
                                        <span class="activity-time">2 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-money-bill"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Fee payment received from <strong>Alice Smith</strong></p>
                                        <span class="activity-time">4 hours ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Parent-teacher meeting scheduled</p>
                                        <span class="activity-time">1 day ago</span>
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
                                    <i class="fas fa-user-plus"></i>
                                    <span>Add Student</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Add Teacher</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-calendar-plus"></i>
                                    <span>Schedule Meeting</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-bullhorn"></i>
                                    <span>Send Announcement</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-file-invoice"></i>
                                    <span>Generate Report</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-cog"></i>
                                    <span>Settings</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Overview -->
                    <div class="content-card full-width">
                        <div class="card-header">
                            <h2 class="card-title">Today's Attendance Overview</h2>
                            <div class="card-filters">
                                <select class="filter-select">
                                    <option>All Classes</option>
                                    <option>Class 10A</option>
                                    <option>Class 10B</option>
                                    <option>Class 9A</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="attendance-stats">
                                <div class="attendance-item">
                                    <div class="attendance-circle present">
                                        <span class="percentage">92%</span>
                                    </div>
                                    <div class="attendance-label">Present</div>
                                </div>
                                <div class="attendance-item">
                                    <div class="attendance-circle absent">
                                        <span class="percentage">5%</span>
                                    </div>
                                    <div class="attendance-label">Absent</div>
                                </div>
                                <div class="attendance-item">
                                    <div class="attendance-circle late">
                                        <span class="percentage">3%</span>
                                    </div>
                                    <div class="attendance-label">Late</div>
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