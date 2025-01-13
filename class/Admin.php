<?php 
require_once '../config/connection.php';
require_once __DIR__ . '/Users.php';

class Admin extends Users {

    public function getAllUsers() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE role = 'student' OR role = 'teacher'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function activateUser() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE users SET status = 'active' WHERE id = $_GET[id]");
        $stmt->execute();
    }

    public function deactivateUser() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE users SET status = 'pending' WHERE id = $_GET[id]");
        $stmt->execute();
    }

    public function suspendUser() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE users SET status = 'suspended' WHERE id = $_GET[id]");
        $stmt->execute();
    }

    public function totalUsers() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function totalActiveUsers() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE status = 'active' AND role = 'student' OR 'teacher';");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function totalCourses() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM courses;");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>