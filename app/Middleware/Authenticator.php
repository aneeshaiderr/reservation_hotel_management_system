<?php
namespace App\Middleware;


use App\Core\Database;
// use Core\Session;

class Authenticator
{
   
    public function attempt(string $email, string $password): bool
    {
        // DB se user fetch karo
        $user = App::resolve(Database::class)->query(
            'SELECT * FROM users WHERE email = :email',
            [
                ':email' => $email
            ]
        )->find();

        if ($user && password_verify($password, $user['password'])) {
            $this->login($user);
            return true;
        }

       
        return false;
    }


    //  Log in the user
    
    public function login(array $user): void
    {
        session_start();

        // Session me user info store karo
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'email' => $user['email'],
            'name'  => $user['first_name'] . ' ' . $user['last_name'],
            'role_id' => $user['role_id'] ?? null
        ];
// after successful login
// $_SESSION['user_id'] = $user['id'];
// $_SESSION['role_id'] = $user['role_id']; 
// // optional: cache permissions
// $_SESSION['permissions'] = $permissionsArray; 

        // Session ID regenerate karo for security
        session_regenerate_id(true);
    }

    
    // public function logout(): void
    // {
    //     session_start();
    //     $_SESSION = [];
    //     session_destroy();
    // }

    // /**
    //  * Check if user is logged in
    //  */
    // public function check(): bool
    // {
    //     session_start();
    //     return isset($_SESSION['user']);
    // }

    
    // public function user(): ?array
    // {
    //     session_start();
    //     return $_SESSION['user'] ?? null;
    // }
}

