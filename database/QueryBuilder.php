<?php

class QueryBuilder {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function fetch($table) {
        $sql = "SELECT * FROM ${table}";
        
        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function post($table) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['name']) && isset($_POST['email'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
    
                $sql = "INSERT INTO ${table}(name, email) VALUES(:name, :email)";
    
                $statement = $this->pdo->prepare($sql);
    
                $isInserted = $statement->execute([':name' => $name, ':email' => $email]);
    
                if($isInserted) {
                    header('Location: index.php');
                }
            }
        }  
    }

    public function put($id, $table) {
        $sql = "SELECT * FROM ${table} WHERE id=:id";
        
        $statement = $this->pdo->prepare($sql);

        $statement->execute([':id' => $id]);

        $user = $statement->fetch(PDO::FETCH_OBJ);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['name']) && isset($_POST['email'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
    
                $sql = "UPDATE ${table} SET name=:name, email=:email WHERE id=:id";
    
                $statement = $this->pdo->prepare($sql);
    
                $isInserted = $statement->execute([':name' => $name, ':email' => $email, ':id' => $id]);
    
                if($isInserted) {
                    header('Location: index.php');
                }
            }
        }  

        return $user;
    }

    public function delete($id, $table) {
        $sql = "DELETE FROM ${table} WHERE id=:id";

        $statement = $this->pdo->prepare($sql);

        $isDeleted = $statement->execute([':id' => $id]);

        if($isDeleted) {
            header('Location: index.php');
        }
    }
    
    public function signup($table) {
        if(isset($_POST['submit'])) {
            $message = '';
            
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $repeat = htmlspecialchars($_POST['repeat']);
            
            $fieldsValid = $passwordValid = $passwordMatch = $emailvalid = false;

            if(empty($name) || empty($email) || empty($password) || empty($repeat)) {
                $message .= 'Please fill-in all the fields ';
                
            } else {
                $fieldsValid = true;
            }
            
            if(strlen($password) < 6) {
                $message .= 'Password must be > 6 ';
                
            } else {
                $passwordValid = true;
            }
            
            if($password !== $repeat) {
                $message .= 'Password did not match ';
                
            } else {
                $passwordMatch = true;
            }
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message .= 'Email is not valid ';
                
            } else {
                $emailvalid = true;
            }
            
            
            if($fieldsValid && $passwordValid && $passwordMatch && $emailvalid) {
                $password = password_hash($password, PASSWORD_BCRYPT);
                
                $sql = "INSERT INTO ${table}(name, email, password) VALUES (:name, :email, :password)";
            
                $statement = $this->pdo->prepare($sql);

                $isInserted = $statement->execute([':name' => $name, ':email' => $email, ':password' => $password]);
            
                if($isInserted) {
                    header('Location: signin.view.php');
                }
            } else {
                header('Location: signup.view.php?message=' . $message);
            }
        }
    }

    public function signin($table) {
        session_start();

        if(isset($_POST['submit'])) {
            $message = '';

            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $fieldsValid = $passwordValid = $emailValid = false;

            if(empty($email) || empty($password)) {
                $message .= 'Please fill-in all the fields ';

            } else {
                $fieldsValid = true;
            }

            if(strlen($password) < 6) {
                $message .= 'Password must be > 6 ';
                
            } else {
                $passwordValid = true;
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message .= 'Email is not valid ';
                
            } else {
                $emailValid = true;
            }

            if($fieldsValid && $passwordValid && $emailValid) {
                $sql = "SELECT * FROM ${table} WHERE email=:email";
            
                $statement = $this->pdo->prepare($sql);

                $statement->execute([':email' => $email]);
            
                $count = $statement->rowCount();

                if($count > 0) {
                    $assoc = $statement->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['email'] = $assoc['email'];

                    $encryptedPass = $assoc['password'];

                    $verifyPass = password_verify($password, $encryptedPass);

                    if($verifyPass) {
                        $message = 'Login success';

                        header('Location: index.php?message=' . $message);

                    } else {
                        $message = 'Invalid Password';

                        header('Location: signin.view.php?message=' . $message);
                    }

                } else {
                    $message = 'Invalid Email';

                    header('Location: signin.view.php?message=' . $message);
                }
            } else {
                header('Location: signin.view.php?message=' . $message);
            }
        }
    }
}