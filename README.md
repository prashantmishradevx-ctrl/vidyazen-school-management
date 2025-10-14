# VIDYAZEN - School Management System

A complete school management system built with PHP and MySQL, featuring role-based dashboards for administrators, teachers, students, and parents.

## 🚀 Live Demo

**Live Website**: [Coming Soon]

**Demo Credentials**:
- **Admin**: admin@vidyazen.com / admin123
- **Teacher**: teacher@vidyazen.com / teacher123  
- **Student**: student@vidyazen.com / student123
- **Parent**: parent@vidyazen.com / parent123

## ✨ Features

- 🔐 **Secure Authentication** - Login/Registration with role-based access
- 👥 **Multi-Role Support** - Admin, Teacher, Student, Parent dashboards
- 🎨 **Modern UI** - Responsive design with GSAP animations
- 📊 **Dashboard Analytics** - Role-specific information display
- 🛡️ **Security** - Session management and SQL injection protection
- 📱 **Mobile Friendly** - Works on all device sizes

## 🛠️ Technology Stack

- **Backend**: PHP 8.1+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Animation**: GSAP (GreenSock)
- **Icons**: Font Awesome

## 🚀 One-Click Deployment

### Deploy to Railway (Recommended)

1. Click the button below to deploy:

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/1-click-deploy?template=https://github.com/prashantmishradevx-ctrl/vidyazen-school-management)

2. Connect your GitHub account
3. The app will automatically deploy with a MySQL database
4. Visit the generated URL to access your school management system

### Deploy to Render

1. Fork this repository
2. Visit [Render.com](https://render.com) and create a free account
3. Create a new Web Service from your forked repository
4. Use these settings:
   - **Build Command**: `composer install --no-dev --optimize-autoloader`
   - **Start Command**: `php -S 0.0.0.0:$PORT`
5. Add environment variables for your database

## 💻 Local Development

### Prerequisites

- PHP 8.1 or higher
- MySQL or MariaDB
- Web server (Apache/Nginx) or PHP built-in server

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/prashantmishradevx-ctrl/vidyazen-school-management.git
   cd vidyazen-school-management
   ```

2. **Create database**:
   ```sql
   CREATE DATABASE vidyazen_db;
   ```

3. **Import database schema**:
   ```bash
   mysql -u root -p vidyazen_db < vidyazen_database.sql
   ```

4. **Configure database** (if needed):
   - Edit `config/database.php` for custom database settings

5. **Start the server**:
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   
   # Or use XAMPP/WAMP and access via http://localhost/vidyazen
   ```

6. **Access the application**:
   - Open: `http://localhost:8000`

## 📁 Project Structure

```
vidyazen-school-management/
├── admin/              # Admin dashboard
├── teacher/            # Teacher dashboard  
├── student/            # Student dashboard
├── parent/             # Parent dashboard
├── config/             # Database configuration
├── includes/           # Authentication & utilities
├── assets/             # CSS, JS, images
├── database/           # SQL schema files
├── .htaccess           # Apache configuration
├── composer.json       # PHP dependencies
└── README.md           # This file
```

## 🔧 Configuration

### Environment Variables (Production)

The application automatically detects production environment and uses these variables:

- `DB_HOST` - Database host
- `DB_NAME` - Database name  
- `DB_USER` - Database username
- `DB_PASS` - Database password
- `DB_PORT` - Database port (default: 3306)

### Local Development

For local development, edit `config/database.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); 
define('DB_PASS', '');
define('DB_NAME', 'vidyazen_db');
```

## 👥 User Roles & Permissions

| Role | Permissions |
|------|-------------|
| **Admin** | Full system access, user management, reports |
| **Teacher** | Class management, student grades, attendance |
| **Student** | View grades, assignments, class schedule |
| **Parent** | View child's progress, communicate with teachers |

## 🔒 Security Features

- ✅ Password hashing with PHP `password_hash()`
- ✅ SQL injection prevention with prepared statements
- ✅ Session management with timeout
- ✅ Role-based access control
- ✅ CSRF protection ready
- ✅ XSS prevention with input sanitization

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support

If you encounter any issues:

1. Check the [Issues](https://github.com/prashantmishradevx-ctrl/vidyazen-school-management/issues) page
2. Create a new issue with detailed information
3. Include error messages and steps to reproduce

## 📞 Contact

- **Repository**: [GitHub](https://github.com/prashantmishradevx-ctrl/vidyazen-school-management)
- **Issues**: [Bug Reports & Feature Requests](https://github.com/prashantmishradevx-ctrl/vidyazen-school-management/issues)

---

**Made with ❤️ for Education Management**