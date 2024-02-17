<?php

namespace App\Enums;


enum UserStatus: string
{
    case Admin = "admin";
    case Writer = 'writer';

    public function color(): string
    {
        return match ($this) {
            self::Admin => 'bg-success',
            self::Writer => 'bg-warning',
            default => 'bg-primary'
        };
    }
}
