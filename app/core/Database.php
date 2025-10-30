<?php 

namespace App\Core;

use PDO;
use PDOException;

// Feedback-- Need proper indentation as per PSR-12 standards
class Database
{
    protected $pdo;
    public $statement;
public $connection;

    public function __construct($config)
    {
        if (isset($config['database'])) {
            $config = $config['database'];
        }

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    

    // General query with parameters
    public function query($query, $params = [])
    {
        $this->statement = $this->pdo->prepare($query);
        $this->statement->execute($params);
        return $this;
    }
public function getPdo()
{
    return $this->connection; 
}

    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->statement->fetchAll(PDO::FETCH_ASSOC);
    }
public function getAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function allUsers() {
        $stmt = $this->pdo->query("SELECT id, first_name, last_name, email FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (!$result) {
            abort(); 
        }
        return $result;
    }

    public function get()
    {
        return $this->statement->fetch();
    }
    public function fetchColumn($sql, $params = [])
{
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
}
