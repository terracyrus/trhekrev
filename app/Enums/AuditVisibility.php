<?php

namespace App\Enums;

enum AuditVisibility: string
{
    case ADMIN = 'admin';
    case OPERATOR = 'operator';
    case USER = 'user';
}
