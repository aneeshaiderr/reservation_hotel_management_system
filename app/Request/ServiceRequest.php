<?php 
namespace App\Request;



class ServiceRequest
{
    protected $data;
    protected $errors = [];

    public function __construct($request)
    {
        $this->data = $request;
    }

    public function validate()
    {
        //  Service Name Required
        if (empty($this->data['service_name'])) {
            $this->errors['service_name'] = "Service name is required.";
        } 
        // Service Name Cannot Be Numeric
        elseif (is_numeric($this->data['service_name'])) {
            $this->errors['service_name'] = "Service name cannot be numeric.";
        }

        //  Price Required and Must Be Numeric
        if (empty($this->data['price'])) {
            $this->errors['price'] = "Price is required.";
        } elseif (!is_numeric($this->data['price'])) {
            $this->errors['price'] = "Price must be numeric.";
        }

        //  Status Required
        if (empty($this->data['status'])) {
            $this->errors['status'] = "Status is required.";
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function all()
    {
        return [
            'service_name' => trim($this->data['service_name']),
            'price'        => trim($this->data['price']),
            'status'       => trim($this->data['status']),
        ];
    }
}

