<?php

namespace App\Enums;

enum OrderStatuses: string
{
    case Paid = 'Paid';
    case Completed = 'Completed';
}
