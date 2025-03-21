<?php

namespace App\Enums;

enum UserRole: string
{
    case VIEWER = 'viewer';
    case ADMIN = 'admin';
    case OPERATOR = 'operator';
    case USER = 'user';

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isOperator(): bool
    {
        return $this === self::OPERATOR;
    }

    public function isUser(): bool
    {
        return $this === self::USER;
    }

    public function isViewer(): bool
    {
        return $this === self::VIEWER;
    }
}
