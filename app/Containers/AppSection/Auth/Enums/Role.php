<?php

namespace App\Containers\AppSection\Auth\Enums;

enum Role: string
{
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';

    public function label(): string
    {
        return match ($this) {
            self::MANAGER => 'Manager',
            self::EMPLOYEE => 'Employee',
        };
    }
} 