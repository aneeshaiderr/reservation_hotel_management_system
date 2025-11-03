<?php

namespace App\Request;

class SignupRequest
{
    public static function validate(array $data, string $redirectPath = '/signup'): array
    {
        $errors = [];

        if (empty($data['first_name'])) {
            $errors['first_name'] = 'First name is required';
        }

        // Check Gmail format only
        if (
            empty($data['user_email']) ||
            ! filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) ||
            ! str_ends_with(strtolower($data['user_email']), '@gmail.com')
        ) {
            $errors['user_email'] = 'A valid Gmail address is required.';
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            $errors['password'] = 'Password must be at least 6 characters.';
        }

        // If any errors exist → redirect back to the appropriate page
        if (! empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: '.BASE_URL.$redirectPath);
            exit;
        }

        // Return sanitized data
        return [
            'first_name' => trim($data['first_name']),
            'last_name' => trim($data['last_name']),
            'user_email' => trim($data['user_email']),
            'contact_no' => trim($data['contact_no']),
            'password' => $data['password'],
        ];
    }
}
