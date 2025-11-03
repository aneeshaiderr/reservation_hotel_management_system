<?php

namespace App\Request;

class HotelRequest
{
    public static function validate(array $data): array
    {
        $errors = [];

        // Hotel Name Required
        if (empty($data['hotel_name'])) {
            $errors['hotel_name'] = 'Hotel name is required.';
        } elseif (!preg_match('/^[A-Za-z\s]+$/', $data['hotel_name'])) {
            $errors['hotel_name'] = 'Hotel name must contain only letters.';
        }

        // Address Required
if (empty($data['address'])) {
    $errors['address'] = 'Address is required.';
}

//  Allow letters, numbers, spaces, comma, hyphen, slash
elseif (!preg_match('/^[A-Za-z0-9\s,\-\/]+$/', $data['address'])) {
    $errors['address'] = 'Address can contain letters, numbers, comma, hyphen, or slash.';
}

//  Address should NOT be only numbers
elseif (preg_match('/^\d+$/', $data['address'])) {
    $errors['address'] = 'Please enter a full valid address, not just numbers.';
}

        // Contact Required
        if (empty($data['contact_no'])) {
            $errors['contact_no'] = 'Contact number is required.';
        } elseif (!is_numeric($data['contact_no'])) {
            $errors['contact_no'] = 'Contact number must be numeric.';
        }

        // If any errors → redirect back
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ' . BASE_URL . '/hotel/create');
            exit;
        }

        // Return clean data
        return [
            'hotel_name' => trim($data['hotel_name']),
            'address'    => trim($data['address']),
            'contact_no' => trim($data['contact_no']),
        ];
    }
}
