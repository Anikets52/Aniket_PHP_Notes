<?php

namespace Utils;

class StringUtility
{
    public function format(string $name): string
    {
        return "Hello, There.. " . htmlspecialchars(trim($name)) . " !";
    }

    public function toCamelCase(string $input, string $separator = '_'): string
    {
        return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
    }
    public function reverse(string $input): string
    {
        return strrev($input);
    }
}
