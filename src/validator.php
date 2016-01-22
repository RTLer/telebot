<?php
namespace RTLer\Telebot;

class validator
{

    public function isMatch($type, $object, $checkValue = false)
    {
        foreach ($type as $fields => $details) {
            if (!isset($object[$fields])
                && !$details['optional']
                && !($checkValue && $this->checkValues($object[$fields], $details['type']))
            ) {
                return false;
            }
        }

        return true;
    }

    public function checkValues($value, $format)
    {
        switch ($format) {
            case 'int':
            case 'float':
                return !is_nan($value);
            case 'string':
                return is_string($value);
            case 'boolean':
                return is_bool($value);
            case 'array':
                return is_array($value);
        }

        preg_match('/^array:(?P<type>.+)/', $format, $matches);

        return true;

    }

}