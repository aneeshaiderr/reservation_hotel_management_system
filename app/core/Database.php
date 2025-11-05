<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    protected PDO $pdo;

    protected $statement;

    public function __construct(array $config)
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
            exit('Database connection failed: '.$e->getMessage());
        }
    }

    /**
     * Prepare and execute a query
     */
    public function query(string $query, array $params = []): self
    {
        $this->statement = $this->pdo->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);

        return $stmt->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(): ?array
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findUserById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function allUsers(): array
    {
        $stmt = $this->pdo->query('SELECT id, first_name, last_name, email FROM users');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(): ?array
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findOrFail(): array
    {
        $result = $this->find();
        if (! $result) {
            abort();
        }

        return $result;
    }

    public function get(): ?array
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function fetchColumn(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
