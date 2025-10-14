<?php
/**
 * VIDYAZEN - School Management System
 * Web Hosting Database Configuration
 * 
 * Instructions:
 * 1. Update these values with your web hosting database details
 * 2. Rename this file to database.php or update the require path in Auth.php
 */

// ============== UPDATE THESE VALUES FOR YOUR HOSTING ==============

// For most free hosting providers like 000webhost, InfinityFree, etc.
define('DB_HOST', 'localhost'); // Usually 'localhost' or provided by your host
define('DB_USER', 'your_db_username'); // Your database username from hosting panel
define('DB_PASS', 'your_db_password'); // Your database password from hosting panel
define('DB_NAME', 'your_db_name'); // Your database name from hosting panel

// ===================================================================

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $pdo;
    private $error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => false, // Changed to false for web hosting
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instance
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
            // Log error for debugging (in production, don't show database errors to users)
            error_log("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getError() {
        return $this->error;
    }
}
?>