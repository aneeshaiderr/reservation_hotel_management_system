<?php
require_once __DIR__ . '/../faker.php';

class UserFactory
{
    protected $conn;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create($role_id = 4)
    {
        $firstName = explode(' ', Faker::name())[0];
        $lastName = explode(' ', Faker::name())[1];
        $email = Faker::email();
        $password = password_hash('12345678', PASSWORD_BCRYPT);
        $contact = Faker::phone();
        $address = Faker::text(100);
        $status = Faker::enum(['active', 'inactive']);

        $sql = "INSERT INTO users
            (role_id, first_name, last_name, user_email, password, contact_no, address, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$role_id, $firstName, $lastName, $email, $password, $contact, $address, $status]);

        return $this->conn->lastInsertId();
    }
}
