<?php

namespace App\Enums;

enum Roles: string
{
    case SuperAdmin = 'SuperAdmin';
    case StoreOwner = 'StoreOwner';
}