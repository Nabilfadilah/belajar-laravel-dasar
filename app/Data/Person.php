<?php

namespace App\Data;

// class person
class Person
{
    // Mengubah cara membuat dependency
    public function __construct(
        public string $firstName,
        public string $lastName
    ) {}
}
