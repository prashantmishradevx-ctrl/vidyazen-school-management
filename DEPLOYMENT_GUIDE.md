# 🚀 VIDYAZEN Deployment Guide

This guide will help you deploy VIDYAZEN School Management System to a free web hosting platform.

## 📋 Quick Deployment Options

### Option 1: 000webhost (Recommended - Free)
- **URL**: https://000webhost.com
- **Features**: Free PHP hosting, MySQL database, 1GB storage
- **Setup Time**: 5-10 minutes

### Option 2: InfinityFree
- **URL**: https://infinityfree.net
- **Features**: Unlimited storage, MySQL, no ads
- **Setup Time**: 10-15 minutes

### Option 3: Heroku (Advanced)
- **URL**: https://heroku.com
- **Features**: Git deployment, add-ons
- **Setup Time**: 15-20 minutes

## 🎯 Step-by-Step Deployment (000webhost)

### Step 1: Create Account
1. Go to https://000webhost.com
2. Click "Sign Up Free"
3. Create account with email
4. Verify email address

### Step 2: Create Website
1. Click "Build Website"
2. Choose "Upload Your Website"
3. Enter website name (e.g., "your-name-vidyazen")
4. Your URL will be: `https://your-name-vidyazen.000webhostapp.com`

### Step 3: Upload Files
1. Go to "Manage Website" → "File Manager"
2. Delete default files in `public_html` folder
3. Upload ALL VIDYAZEN files to `public_html` folder:
   - All `.php` files
   - `assets/` folder
   - `admin/`, `student/`, `parent/`, `teacher/` folders
   - `includes/` folder
   - `config/` folder
   - `.htaccess` file

### Step 4: Create Database
1. Go to "Manage Website" → "Database"
2. Click "New Database"
3. Create database (remember the name, username, password)
4. Open "phpMyAdmin"
5. Select your database
6. Click "Import" tab
7. Upload `vidyazen_database.sql` file
8. Click "Go" to import

### Step 5: Configure Database Connection
1. In File Manager, go to `config/` folder
2. Edit `database.php` file
3. Update these values:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_000webhost_db_username');
   define('DB_PASS', 'your_000webhost_db_password');
   define('DB_NAME', 'your_000webhost_db_name');
   ```

### Step 6: Test Your Website
1. Visit your URL: `https://your-name-vidyazen.000webhostapp.com`
2. You should see the VIDYAZEN login page
3. Test login with demo credentials:
   - Admin: `admin` / `password`
   - Student: `student@demo.com` / `password`
   - Parent: `parent@demo.com` / `password`
   - Teacher: `teacher@demo.com` / `password`

## 🔧 Alternative: Heroku Deployment

### Requirements
- Git installed on your computer
- Heroku CLI installed

### Step 1: Prepare for Heroku
1. Create `composer.json` in root folder:
   ```json
   {
       "require": {
           "php": "^7.4"
       }
   }
   ```

2. Create `Procfile` in root folder:
   ```
   web: vendor/bin/heroku-php-apache2
   ```

### Step 2: Deploy to Heroku
1. Install Heroku CLI: https://devcenter.heroku.com/articles/heroku-cli
2. Login: `heroku login`
3. Create app: `heroku create your-vidyazen-app`
4. Add database: `heroku addons:create cleardb:ignite`
5. Get database URL: `heroku config:get CLEARDB_DATABASE_URL`
6. Update config/database.php with Heroku database details
7. Push to Heroku:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git push heroku main
   ```

## 🗄️ Database Setup Files Included

- **`vidyazen_database.sql`**: Complete database export with all tables and demo data
- **`config/web_database.php`**: Template for web hosting database configuration

## 🔐 Demo Credentials

After deployment, your website will have these demo accounts:

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | password |
| Student | student@demo.com | password |
| Parent | parent@demo.com | password |
| Teacher | teacher@demo.com | password |

## 📁 Files to Upload

Upload ALL these files and folders:
```
├── admin/
├── assets/
├── config/
├── includes/
├── parent/
├── student/
├── teacher/
├── .htaccess
├── index.php
├── login.php
├── logout.php
├── register.php
└── vidyazen_database.sql
```

## 🔍 Troubleshooting

### Database Connection Error
1. Check database credentials in `config/database.php`
2. Ensure database is created and imported
3. Check if hosting supports PHP and MySQL

### 404 Errors
1. Ensure `.htaccess` file is uploaded
2. Check if mod_rewrite is enabled on hosting
3. Verify all files are in correct directories

### Permission Errors
1. Set folder permissions to 755
2. Set file permissions to 644
3. Some hosts auto-set permissions

## 🎉 Post-Deployment

### Secure Your Admin Account
1. Login as admin
2. Change default password
3. Create your own admin account
4. Delete or disable default demo accounts

### Customize Your School
1. Update school name and information
2. Add your school logo
3. Configure system settings
4. Add real student/teacher data

## 📞 Support

If you encounter issues during deployment:
1. Check hosting provider documentation
2. Verify PHP version compatibility (PHP 7.4+ recommended)
3. Ensure MySQL version is 5.7+
4. Check error logs in hosting control panel

---

**🎓 VIDYAZEN School Management System**  
*Your complete school management solution*