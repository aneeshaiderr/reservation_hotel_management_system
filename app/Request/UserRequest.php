<?php

namespace App\Request;

class UserRequest
{
    protected array $data;
    protected array $errors = [];
    protected bool $isUpdate;

    /**
     * @param array $request
     * @param bool $isUpdate Set true if this is an update request
     */
    public function __construct(array $request, bool $isUpdate = false)
    {
        $this->isUpdate = $isUpdate;

        $this->data = [
            'first_name' => trim($request['first_name'] ?? ''),
            'last_name'  => trim($request['last_name'] ?? ''),
            'user_email' => trim($request['user_email'] ?? ''),
            'contact_no' => trim($request['contact_no'] ?? ''),
            // For update, password can be null
            'password'   => $request['password'] ?? null,
        ];
    }

    public function validate(): bool
    {
        /* FIRST NAME */
        if ($this->data['first_name'] === '') {
            $this->errors['first_name'] = 'First name is required.';
        } elseif (!preg_match('/^[A-Za-z ]+$/', $this->data['first_name'])) {
            $this->errors['first_name'] = 'First name must contain only letters.';
        }

        /* LAST NAME */
        if ($this->data['last_name'] === '') {
            $this->errors['last_name'] = 'Last name is required.';
        } elseif (!preg_match('/^[A-Za-z ]+$/', $this->data['last_name'])) {
            $this->errors['last_name'] = 'Last name must contain only letters.';
        }

        /* EMAIL */
        if ($this->data['user_email'] === '') {
            $this->errors['user_email'] = 'Email is required.';
        } elseif (!filter_var($this->data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['user_email'] = 'Please enter a valid email address.';
        } elseif (!preg_match(
            "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/",
            $this->data['user_email']
        )) {
            $this->errors['user_email'] = 'Email format is incorrect.';
        }

        /* CONTACT NUMBER (10–15 digits) */
        if ($this->data['contact_no'] === '') {
            $this->errors['contact_no'] = 'Contact number is required.';
        } elseif (!preg_match('/^[0-9]{10,15}$/', $this->data['contact_no'])) {
            $this->errors['contact_no'] = 'Contact number must be 10–15 digits.';
        }

        /* PASSWORD */
        if (!$this->isUpdate) {
            // On create, password is required
            if ($this->data['password'] === null || $this->data['password'] === '') {
                $this->errors['password'] = 'Password is required.';
            } elseif (strlen($this->data['password']) < 6) {
                $this->errors['password'] = 'Password must be at least 6 characters.';
            }
        } else {
            // On update, password is optional
            if ($this->data['password'] !== null && $this->data['password'] !== '' && strlen($this->data['password']) < 6) {
                $this->errors['password'] = 'Password must be at least 6 characters.';
            }
        }

        return empty($this->errors);
    }

    /**
     * Return validation errors
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Return all validated data
     */
    public function all(): array
    {
        return $this->data;
    }
}
