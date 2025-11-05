<?php

namespace App\Request;

class ReservationRequest
{
    public static function validate(array $data, bool $isUpdate = false): array
    {
        $errors = [];

        if (!$isUpdate && empty($data['user_id'])) {
            $errors['user_id'] = 'User is required.';
        }

        if (empty($data['hotel_id'])) {
            $errors['hotel_id'] = 'Hotel is required.';
        }

        if (empty($data['hotel_code'])) {
            $errors['hotel_code'] = 'Hotel code is required.';
        }

        if (empty($data['check_in'])) {
            $errors['check_in'] = 'Check-in date is required.';
        }

        if (empty($data['check_out'])) {
            $errors['check_out'] = 'Check-out date is required.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['error'] = 'Please fix the highlighted errors.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return [
            'user_id'     => $data['user_id'] ?? null,
            'hotel_id'    => trim($data['hotel_id']),
            'hotel_code'  => trim($data['hotel_code']),
            'room_id'     => $data['room_id'] ?? null,
            'discount_id' => $data['discount_id'] ?? null,
            'check_in'    => trim($data['check_in']),
            'check_out'   => trim($data['check_out']),
            'status'      => $data['status'] ?? 'pending',
        ];
    }
}
