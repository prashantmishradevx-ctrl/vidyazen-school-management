<?php
require_once '../includes/Auth.php';

$auth = new Auth();
$auth->requireRole(['parent']);

// Get user info
$userId = $auth->getUserId();
$userName = $_SESSION['full_name'] ?? 'Parent User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - VIDYAZEN</title>
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
                        <a href="children.php" class="nav-link">
                            <i class="fas fa-child"></i>
                            <span class="nav-text">My Children</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="grades.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">Academic Progress</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="attendance.php" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span class="nav-text">Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="fees.php" class="nav-link">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="nav-text">Fee Payments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="meetings.php" class="nav-link">
                            <i class="fas fa-video"></i>
                            <span class="nav-text">Parent-Teacher Meetings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="announcements.php" class="nav-link">
                            <i class="fas fa-bullhorn"></i>
                            <span class="nav-text">School Announcements</span>
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
                    <h1 class="page-title">Parent Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="header-actions">
                        <button class="header-btn notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-count">1</span>
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
                            <i class="fas fa-child"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">2</h3>
                            <p class="stat-label">Children Enrolled</p>
                            <span class="stat-change neutral">Active students</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">8.7</h3>
                            <p class="stat-label">Average GPA</p>
                            <span class="stat-change positive">Above class average</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">96%</h3>
                            <p class="stat-label">Attendance Rate</p>
                            <span class="stat-change positive">Excellent</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">₹0</h3>
                            <p class="stat-label">Pending Fees</p>
                            <span class="stat-change positive">All paid up</span>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Children Overview -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2 class="card-title">Children Overview</h2>
                            <button class="card-action">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Sarah Johnson</strong> - Grade 10A</p>
                                        <span class="activity-time">GPA: 9.1 | Attendance: 97%</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Michael Johnson</strong> - Grade 8B</p>
                                        <span class="activity-time">GPA: 8.3 | Attendance: 95%</span>
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
                                    <i class="fas fa-video"></i>
                                    <span>Schedule Meeting</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-file-download"></i>
                                    <span>Download Report</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Pay Fees</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-envelope"></i>
                                    <span>Message Teacher</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="content-card full-width">
                        <div class="card-header">
                            <h2 class="card-title">Recent Updates</h2>
                            <div class="card-filters">
                                <select class="filter-select">
                                    <option>All Children</option>
                                    <option>Sarah Johnson</option>
                                    <option>Michael Johnson</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Sarah</strong> received an A+ in Mathematics exam</p>
                                        <span class="activity-time">2 days ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Michael</strong> was absent on Monday - Sick leave</p>
                                        <span class="activity-time">3 days ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">School announcement: Parent-Teacher meeting scheduled</p>
                                        <span class="activity-time">1 week ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text">Fee payment successful for both children</p>
                                        <span class="activity-time">2 weeks ago</span>
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