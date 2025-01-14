<?php 
require_once '../config/connection.php';

class Users {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $status;

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $status = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function register($name, $email, $password, $role) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            session_start();
            
            $_SESSION['already'] = true;
            
            header('Location: ./index.php');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $role]);
    }

    public function logIn($email, $password) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            if($user['role'] == "admin") {
                $_SESSION['logged_in'] = true;
                header("Location: ../dashboard/index.php");
            } else if($user['role'] == "teacher") {
                if($user['status'] == "suspended") {
                    $_SESSION['noPerm'] = true;
                } else if($user['status'] == "pending") {
                    $_SESSION['pending'] = true;
                    header('Location: ../pending.php');
                } else {
                    $_SESSION['logged_in'] = true;
                    header("Location: ../platform/index.php");
                }
            } else if($user['role'] == "student") {
                if($user['status'] == "suspended") {
                    $_SESSION['noPerm'] = true;
                } else if($user['status'] == "pending") {
                    $_SESSION['pending'] = true;
                    header('Location: ../pending.php');
                } else {
                    $_SESSION['logged_in'] = true;
                    header('Location: ../courses.php');
                }
            }
        } else {
            $_SESSION['false'] = true;
        }
    }

}

?>