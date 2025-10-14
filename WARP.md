# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

VIDYAZEN is a comprehensive PHP-based school management system that handles student enrollment, teacher management, fee tracking, grades, meetings, and parent-teacher communications. The system uses MySQL for data persistence and features a modern web interface with GSAP animations.

## Database Setup

The system requires MySQL/MariaDB. Database schema is located in `database/schema.sql`.

### Database Initialization
```bash
# Create database and import schema
mysql -u root -p < database/schema.sql

# Or using PowerShell with MySQL client
mysql -u root -p -e "source database/schema.sql"
```

### Default Credentials
- **Admin**: username `admin` / password `password`
- **Database**: host `localhost`, database `vidyazen_db`, user `root` (no password by default)

## Development Server

### Local Development
```bash
# Using PHP built-in server
php -S localhost:8000

# Or with XAMPP/WAMP on Windows
# Place project in htdocs/www folder and access via localhost/vidyazen
```

### File Structure Verification
```bash
# Check if all required directories exist
Get-ChildItem -Name -Directory
# Should show: admin, assets, config, database, includes, pages, parent, student
```

## Authentication System

The authentication system is built around the `Auth` class (`includes/Auth.php`) with role-based access:

- **Admin**: Full system access
- **Student**: Student dashboard and personal data
- **Parent**: Child's academic information and fee details
- **Teacher**: Class management and grade entry

### Session Management
- Sessions are tracked in `user_sessions` table
- Session data includes IP address, user agent, and expiry
- Automatic role-based redirect after login

## Database Architecture

The system uses a normalized MySQL schema with the following key tables:

- `users`: Core authentication and user data
- `students`: Student-specific information linked to users
- `institutes`: School/institution management
- `classes`: Class organization and teacher assignments
- `subjects`: Subject management with credits
- `grades`: Academic performance tracking
- `fee_structure` & `fee_payments`: Financial management
- `meetings`: Parent-teacher and staff meetings
- `lectures` & `lecture_attendance`: Class scheduling and attendance
- `doubts`: Student Q&A system
- `announcements`: School-wide communications

### Key Relationships
- Users can have multiple roles via type enum
- Students link to users and have parent relationships
- Classes belong to institutes and have assigned teachers
- Attendance and grades track by student/class/subject

## Frontend Architecture

### CSS & JavaScript Structure
- **CSS**: Located in `assets/css/` with modular stylesheets
  - `auth.css`: Authentication forms styling
  - `dashboard.css`: Dashboard and administrative interface
- **JavaScript**: Located in `assets/js/` with GSAP animations
  - `auth.js`: Login/register form interactions and animations
  - `dashboard.js`: Dashboard functionality and sidebar management

### Animation System
Uses GSAP (GreenSock Animation Platform) for:
- Page load transitions
- Form interactions
- Dashboard component animations
- Sidebar collapse/expand
- Statistical counter animations

### External Dependencies
- **GSAP**: `https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js`
- **Google Fonts**: Inter font family
- **Font Awesome**: `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css`

## Testing User Access

### Demo Credentials Available
The login page displays demo credentials:
- **Admin**: `admin` / `password`
- **Student**: `student@demo.com` / `student123`
- **Parent**: `parent@demo.com` / `parent123`

### User Role Testing
```php
# Add test users via PHP or database
require_once 'includes/Auth.php';
$auth = new Auth();
$userData = [
    'username' => 'testuser',
    'email' => 'test@example.com',
    'password' => 'testpass',
    'user_type' => 'student',
    'first_name' => 'Test',
    'last_name' => 'User'
];
$result = $auth->register($userData);
```

## Security Considerations

- Passwords are hashed using `PASSWORD_BCRYPT`
- SQL injection protection via PDO prepared statements
- Session-based authentication with role verification
- Input sanitization with `htmlspecialchars()`
- Database credentials in `config/database.php` (should be environment variables in production)

## Multi-Role Dashboard System

The system redirects users to role-specific dashboards:
- `/admin/dashboard.php` - Administrative interface
- `/student/dashboard.php` - Student portal
- `/parent/dashboard.php` - Parent access
- `/teacher/dashboard.php` - Teacher tools

Each dashboard has distinct navigation and functionality based on user permissions.

## Common Development Tasks

### Adding New User Roles
1. Update `user_type` ENUM in `users` table schema
2. Add role check in `Auth::requireRole()` method
3. Create corresponding dashboard directory and files
4. Update login redirect logic in `login.php`

### Database Schema Changes
1. Create migration script in `database/` folder
2. Update `schema.sql` for new installations
3. Test with existing demo data

### Adding New Dashboard Features
1. Create PHP files in appropriate role directory
2. Add navigation items in dashboard template
3. Implement proper role-based access controls
4. Add corresponding CSS/JS if needed

## Error Handling

The system includes database error handling in the `Auth` class. For development:
- Check PHP error logs for database connection issues
- Verify MySQL service is running
- Ensure database credentials match in `config/database.php`
- Default database expects no password for root user