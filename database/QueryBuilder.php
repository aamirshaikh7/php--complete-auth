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
            if(isset($_POST['name']) && isset($_POST['designation']) && isset($_POST['email'])) {
                $name = $_POST['name'];
                $designation = $_POST['designation'];
                $email = $_POST['email'];
    
                $sql = "INSERT INTO ${table}(name, designation, email) VALUES(:name, :designation, :email)";
    
                $statement = $this->pdo->prepare($sql);
    
                $isInserted = $statement->execute([':name' => $name, ':designation' => $designation, ':email' => $email]);
    
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
            if(isset($_POST['name']) && isset($_POST['designation']) && isset($_POST['email'])) {
                $name = $_POST['name'];
                $designation = $_POST['designation'];
                $email = $_POST['email'];
    
                $sql = "UPDATE ${table} SET name=:name, designation=:designation, email=:email WHERE id=:id";
    
                $statement = $this->pdo->prepare($sql);
    
                $isInserted = $statement->execute([':name' => $name, ':designation' => $designation, ':email' => $email, ':id' => $id]);
    
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
            header('Location: index.php#get-started');
        }
    }
}