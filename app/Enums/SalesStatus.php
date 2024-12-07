<?php

namespace App\Enums;

enum SalesStatus: string
{
    case PENDING = 'P';
    case APPROVED = 'A';
    case CANCELED = 'C';
}
