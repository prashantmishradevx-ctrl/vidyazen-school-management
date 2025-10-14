<?php
/**
 * VIDYAZEN - School Management System
 * Database Configuration
 */

// Database Configuration - Auto-detects production vs local
if (getenv('RAILWAY_ENVIRONMENT') || getenv('RENDER') || getenv('PORT')) {
    // Production environment
    define('DB_HOST', getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'localhost');
    define('DB_USER', getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: getenv('MYSQLPASSWORD') ?: '');
    define('DB_NAME', getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'vidyazen_db');
} else {
    // Local development environment
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'vidyazen_db');
}

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
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instanace
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
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