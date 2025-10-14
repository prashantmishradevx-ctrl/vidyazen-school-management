<?php
/**
 * VIDYAZEN - School Management System
 * Authentication Class
 */

require_once __DIR__ . '/../config/database.php';

class Auth {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT user_id, username, email, password_hash, user_type, first_name, last_name, is_active FROM users WHERE (username = ? OR email = ?) AND is_active = 1");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password_hash'])) {
                // Create session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['logged_in'] = true;
                
                // Log the session
                $this->logSession($user['user_id']);
                
                return [
                    'success' => true,
                    'user_type' => $user['user_type'],
                    'message' => 'Login successful'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid username/email or password'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    }
    
    public function register($userData) {
        try {
            // Check if username or email already exists
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$userData['username'], $userData['email']]);
            
            if ($stmt->fetchColumn() > 0) {
                return [
                    'success' => false,
                    'message' => 'Username or email already exists'
                ];
            }
            
            // Hash password
            $passwordHash = password_hash($userData['password'], PASSWORD_BCRYPT);
            
            // Insert new user
            $stmt = $this->db->prepare("
                INSERT INTO users (username, email, password_hash, user_type, first_name, last_name, phone, address) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $result = $stmt->execute([
                $userData['username'],
                $userData['email'],
                $passwordHash,
                $userData['user_type'],
                $userData['first_name'],
                $userData['last_name'],
                $userData['phone'] ?? null,
                $userData['address'] ?? null
            ]);
            
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Registration successful'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Registration failed'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }
    }
    
    public function logout() {
        // Destroy session
        session_destroy();
        return true;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    public function getUserType() {
        return $_SESSION['user_type'] ?? null;
    }
    
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public function requireAuth() {
        if (!$this->isLoggedIn()) {
            // Check if we're in a subdirectory
            $loginUrl = (basename(dirname($_SERVER['PHP_SELF'])) === 'vidyazen') ? 'login.php' : '../login.php';
            header('Location: ' . $loginUrl);
            exit();
        }
    }
    
    public function requireRole($allowedRoles) {
        $this->requireAuth();
        
        if (!in_array($this->getUserType(), $allowedRoles)) {
            // Check if we're in a subdirectory
            $unauthorizedUrl = (basename(dirname($_SERVER['PHP_SELF'])) === 'vidyazen') ? 'unauthorized.php' : '../unauthorized.php';
            header('Location: ' . $unauthorizedUrl);
            exit();
        }
    }
    
    private function logSession($userId) {
        try {
            $sessionId = session_id();
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $expiresAt = date('Y-m-d H:i:s', time() + 3600); // 1 hour
            
            $stmt = $this->db->prepare("
                INSERT INTO user_sessions (session_id, user_id, ip_address, user_agent, expires_at) 
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                expires_at = ?, is_active = 1
            ");
            
            $stmt->execute([$sessionId, $userId, $ipAddress, $userAgent, $expiresAt, $expiresAt]);
        } catch (PDOException $e) {
            // Log error but don't fail login
            error_log('Session logging failed: ' . $e->getMessage());
        }
    }
}
?>