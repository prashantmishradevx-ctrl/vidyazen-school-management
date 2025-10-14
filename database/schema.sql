-- VIDYAZEN School Management System Database Schema
-- Created: 2025

-- Create Database
CREATE DATABASE IF NOT EXISTS vidyazen_db;
USE vidyazen_db;

-- Users Table (Main authentication table)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'student', 'parent', 'teacher') NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    profile_image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Schools/Institutes Table
CREATE TABLE institutes (
    institute_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(15),
    email VARCHAR(100),
    website VARCHAR(100),
    logo VARCHAR(255),
    established_year YEAR,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Classes Table
CREATE TABLE classes (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    class_name VARCHAR(50) NOT NULL,
    section VARCHAR(10),
    academic_year VARCHAR(10) NOT NULL,
    class_teacher_id INT,
    max_students INT DEFAULT 50,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (class_teacher_id) REFERENCES users(user_id)
);

-- Students Table
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    institute_id INT NOT NULL,
    class_id INT,
    student_roll VARCHAR(20) UNIQUE NOT NULL,
    admission_date DATE NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    blood_group VARCHAR(5),
    parent_id INT,
    emergency_contact VARCHAR(15),
    medical_info TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (class_id) REFERENCES classes(class_id),
    FOREIGN KEY (parent_id) REFERENCES users(user_id)
);

-- Subjects Table
CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    subject_name VARCHAR(100) NOT NULL,
    subject_code VARCHAR(20) UNIQUE NOT NULL,
    description TEXT,
    credits INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id)
);

-- Grades/Marks Table
CREATE TABLE grades (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    class_id INT NOT NULL,
    exam_type ENUM('quiz', 'midterm', 'final', 'assignment', 'project') NOT NULL,
    marks_obtained DECIMAL(5,2) NOT NULL,
    max_marks DECIMAL(5,2) NOT NULL,
    grade_letter VARCHAR(2),
    exam_date DATE NOT NULL,
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id),
    FOREIGN KEY (class_id) REFERENCES classes(class_id)
);

-- Fee Structure Table
CREATE TABLE fee_structure (
    fee_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    class_id INT,
    fee_type VARCHAR(50) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    due_date DATE NOT NULL,
    academic_year VARCHAR(10) NOT NULL,
    is_mandatory BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (class_id) REFERENCES classes(class_id)
);

-- Fee Payments Table
CREATE TABLE fee_payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    fee_id INT NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    payment_date DATE NOT NULL,
    payment_method ENUM('cash', 'cheque', 'online', 'card') NOT NULL,
    transaction_id VARCHAR(100),
    receipt_number VARCHAR(50) UNIQUE NOT NULL,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'completed',
    late_fee DECIMAL(10,2) DEFAULT 0,
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (fee_id) REFERENCES fee_structure(fee_id)
);

-- Meetings/Events Table
CREATE TABLE meetings (
    meeting_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    meeting_type ENUM('parent_teacher', 'staff', 'student', 'general') NOT NULL,
    meeting_date DATETIME NOT NULL,
    duration INT NOT NULL, -- in minutes
    location VARCHAR(200),
    organizer_id INT NOT NULL,
    max_participants INT,
    meeting_link VARCHAR(500), -- for online meetings
    status ENUM('scheduled', 'ongoing', 'completed', 'cancelled') DEFAULT 'scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (organizer_id) REFERENCES users(user_id)
);

-- Meeting Participants Table
CREATE TABLE meeting_participants (
    participant_id INT AUTO_INCREMENT PRIMARY KEY,
    meeting_id INT NOT NULL,
    user_id INT NOT NULL,
    attendance_status ENUM('invited', 'attending', 'absent') DEFAULT 'invited',
    joined_at TIMESTAMP NULL,
    left_at TIMESTAMP NULL,
    FOREIGN KEY (meeting_id) REFERENCES meetings(meeting_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Lectures/Classes Schedule Table
CREATE TABLE lectures (
    lecture_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    class_id INT NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT NOT NULL,
    lecture_title VARCHAR(200) NOT NULL,
    lecture_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    room_number VARCHAR(20),
    lecture_type ENUM('regular', 'extra', 'remedial') DEFAULT 'regular',
    status ENUM('scheduled', 'ongoing', 'completed', 'cancelled') DEFAULT 'scheduled',
    attendance_marked BOOLEAN DEFAULT FALSE,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (class_id) REFERENCES classes(class_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id),
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

-- Lecture Attendance Table
CREATE TABLE lecture_attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    lecture_id INT NOT NULL,
    student_id INT NOT NULL,
    attendance_status ENUM('present', 'absent', 'late', 'excused') NOT NULL,
    marked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    remarks TEXT,
    FOREIGN KEY (lecture_id) REFERENCES lectures(lecture_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- Doubts/Questions Table
CREATE TABLE doubts (
    doubt_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT,
    question TEXT NOT NULL,
    answer TEXT,
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    status ENUM('open', 'answered', 'closed') DEFAULT 'open',
    is_public BOOLEAN DEFAULT FALSE,
    asked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    answered_at TIMESTAMP NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id),
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

-- Announcements Table
CREATE TABLE announcements (
    announcement_id INT AUTO_INCREMENT PRIMARY KEY,
    institute_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    target_audience ENUM('all', 'students', 'parents', 'teachers') DEFAULT 'all',
    class_id INT NULL, -- for class-specific announcements
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    is_active BOOLEAN DEFAULT TRUE,
    published_by INT NOT NULL,
    publish_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    expiry_date DATETIME NULL,
    FOREIGN KEY (institute_id) REFERENCES institutes(institute_id),
    FOREIGN KEY (class_id) REFERENCES classes(class_id),
    FOREIGN KEY (published_by) REFERENCES users(user_id)
);

-- Session Management Table
CREATE TABLE user_sessions (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert default admin user
INSERT INTO users (username, email, password_hash, user_type, first_name, last_name) 
VALUES ('admin', 'admin@vidyazen.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'System', 'Administrator');

-- Insert sample institute
INSERT INTO institutes (name, address, phone, email, website) 
VALUES ('VIDYAZEN Demo School', '123 Education Street, Knowledge City', '+1234567890', 'info@vidyazen.com', 'www.vidyazen.com');