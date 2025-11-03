<?php

namespace App\Request;

class DiscountRequest
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['discount_type'])) {
            $errors['discount_type'] = 'Discount type is required.';
        }

        if (empty($data['discount_name'])) {
            $errors['discount_name'] = 'Discount name is required.';
        }

        if (! is_numeric($data['value'] ?? '')) {
            $errors['value'] = 'Discount value must be a number.';
        }

        if (! empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: '.BASE_URL.'/discount/create');
            exit;
        }

        return [
            'discount_type' => trim($data['discount_type']),
            'discount_name' => trim($data['discount_name']),
            'value' => (float) $data['value'],
            'start_date' => trim($data['start_date']),
            'end_date' => trim($data['end_date']),
            'status' => trim($data['status']),
        ];
    }
}
