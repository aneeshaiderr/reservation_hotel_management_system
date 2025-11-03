<?php

namespace App\Request;

class UserRequest
{
    protected $data;
    protected $errors = [];

    public function __construct(array $request)
    {
        $this->data = $request;
    }

    public function validate(): bool
    {
        // First Name Required
        if (empty($this->data['first_name'])) {
            $this->errors['first_name'] = "First name is required.";
        }

        // Last Name Required
        if (empty($this->data['last_name'])) {
            $this->errors['last_name'] = "Last name is required.";
        }

        // Email Required + Valid Email
        if (empty($this->data['user_email'])) {
            $this->errors['user_email'] = "Email is required.";
        } elseif (!filter_var($this->data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['user_email'] = "Invalid email format.";
        }

        // Contact Required + Numeric
        if (empty($this->data['contact_no'])) {
            $this->errors['contact_no'] = "Contact number is required.";
        } elseif (!is_numeric($this->data['contact_no'])) {
            $this->errors['contact_no'] = "Contact number must be numeric.";
        }

        // Password Required + Min length
        if (empty($this->data['password'])) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($this->data['password']) < 6) {
            $this->errors['password'] = "Password must be at least 6 characters.";
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function all(): array
    {
        return [
            'first_name' => trim($this->data['first_name']),
            'last_name'  => trim($this->data['last_name']),
            'user_email' => trim($this->data['user_email']),
            'contact_no' => trim($this->data['contact_no']),
            'password'   => $this->data['password'],
        ];
    }
}

