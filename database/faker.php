<?php

class Faker
{
    public static function name()
    {
        $first = ['Ali', 'Ahmed', 'Anees', 'Sara', 'Fatima', 'Zain'];
        $last = ['Khan', 'Haider', 'Rashid', 'Qureshi', 'Malik'];
        return $first[array_rand($first)] . ' ' . $last[array_rand($last)];
    }

    public static function email()
    {
        $domains = ['example.com', 'mail.com', 'test.com'];
        $name = strtolower(str_replace(' ', '.', self::name()));
        return $name . '@' . $domains[array_rand($domains)];
    }

    public static function phone()
    {
        return '03' . rand(0,9) . rand(10000000,99999999);
    }

    public static function text($length = 50)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz ';
        $str = '';
        for ($i=0; $i<$length; $i++) {
            $str .= $chars[rand(0,strlen($chars)-1)];
        }
        return ucfirst($str);
    }

    public static function number($min=1, $max=100)
    {
        return rand($min,$max);
    }

    public static function date($start = '2025-01-01', $end = '2025-12-31')
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $rand_ts = rand($start_ts, $end_ts);
        return date('Y-m-d', $rand_ts);
    }

    public static function enum(array $values)
    {
        return $values[array_rand($values)];
    }
}

