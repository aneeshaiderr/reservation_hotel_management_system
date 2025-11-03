<?php
namespace App\Request;




class RoomRequest
{
    protected $data;
    protected $errors = [];

    public function __construct($request)
    {
        $this->data = $request;
    }

    public function validate()
    {
        // Required fields check
        $required = ['room_number', 'floor', 'room_bed', 'Max_guests', 'hotel_id', 'status'];

        foreach ($required as $field) {
            if (empty($this->data[$field])) {
                $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
            }
        }

        //Floor must be numeric
        if (!empty($this->data['floor']) && !is_numeric($this->data['floor'])) {
            $this->errors['floor'] = "Floor must be a number";
        }

        // Max guests must be numeric
        if (!empty($this->data['Max_guests']) && !is_numeric($this->data['Max_guests'])) {
            $this->errors['Max_guests'] = "Guests must be a number";
        }

        //Hotel ID must be numeric & valid
       
      if (empty($data['hotel_id'])) { $errors['hotel_id'] = "Select hotel"; }

        // Status allowed values check
        $allowedStatus = ['available', 'occupied', 'maintenance'];

        if (!empty($this->data['status']) && !in_array($this->data['status'], $allowedStatus)) {
            $this->errors['status'] = "Invalid status value";
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function all()
    {
        return $this->data;
    }
}

