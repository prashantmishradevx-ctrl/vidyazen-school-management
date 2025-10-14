<?php
require_once '../includes/Auth.php';

$auth = new Auth();
$auth->requireRole(['student']);

// Get user info
$userId = $auth->getUserId();
$userName = $_SESSION['full_name'] ?? 'Student User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - VIDYAZEN</title>
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
                        <a href="grades.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-text">My Grades</span>
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
                        <a href="schedule.php" class="nav-link">
                            <i class="fas fa-clock"></i>
                            <span class="nav-text">Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="doubts.php" class="nav-link">
                            <i class="fas fa-question-circle"></i>
                            <span class="nav-text">Ask Doubts</span>
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
                    <h1 class="page-title">Student Dashboard</h1>
                </div>
                <div class="header-right">
                    <div class="header-actions">
                        <button class="header-btn notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-count">2</span>
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
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">8.5</h3>
                            <p class="stat-label">Overall GPA</p>
                            <span class="stat-change positive">+0.2 this term</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">95%</h3>
                            <p class="stat-label">Attendance</p>
                            <span class="stat-change positive">Above average</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">12</h3>
                            <p class="stat-label">Assignments</p>
                            <span class="stat-change neutral">3 pending</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number">3rd</h3>
                            <p class="stat-label">Class Rank</p>
                            <span class="stat-change positive">Improved</span>
                        </div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Recent Grades -->
                    <div class="content-card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Grades</h2>
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
                                        <p class="activity-text"><strong>Mathematics</strong> - Test Score: 92/100</p>
                                        <span class="activity-time">2 days ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-flask"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>Science</strong> - Lab Report: A-</p>
                                        <span class="activity-time">1 week ago</span>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="activity-info">
                                        <p class="activity-text"><strong>English</strong> - Essay: B+</p>
                                        <span class="activity-time">1 week ago</span>
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
                                    <i class="fas fa-question-circle"></i>
                                    <span>Ask Question</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-file-download"></i>
                                    <span>Download Notes</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>View Schedule</span>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-chart-bar"></i>
                                    <span>View Report Card</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Classes -->
                    <div class="content-card full-width">
                        <div class="card-header">
                            <h2 class="card-title">Today's Schedule</h2>
                            <div class="card-filters">
                                <select class="filter-select">
                                    <option>Today</option>
                                    <option>Tomorrow</option>
                                    <option>This Week</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="schedule-list">
                                <div class="schedule-item">
                                    <div class="schedule-time">09:00 AM</div>
                                    <div class="schedule-info">
                                        <h4>Mathematics</h4>
                                        <p>Room 201 - Mr. Johnson</p>
                                    </div>
                                    <div class="schedule-status ongoing">Ongoing</div>
                                </div>
                                <div class="schedule-item">
                                    <div class="schedule-time">10:30 AM</div>
                                    <div class="schedule-info">
                                        <h4>Science</h4>
                                        <p>Lab 1 - Mrs. Davis</p>
                                    </div>
                                    <div class="schedule-status upcoming">Upcoming</div>
                                </div>
                                <div class="schedule-item">
                                    <div class="schedule-time">01:00 PM</div>
                                    <div class="schedule-info">
                                        <h4>English Literature</h4>
                                        <p>Room 105 - Ms. Wilson</p>
                                    </div>
                                    <div class="schedule-status upcoming">Upcoming</div>
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