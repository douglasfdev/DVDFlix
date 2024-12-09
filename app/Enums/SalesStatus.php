<?php

namespace App\Enums;

enum SalesStatus: string
{
    case PENDING = 'P';
    case APPROVED = 'A';
    case CANCELED = 'C';

    public function label(): string
    {
        return match ($this) {
            SalesStatus::PENDING => 'Pendente',
            SalesStatus::APPROVED => 'Aprovada',
            SalesStatus::CANCELED => 'Cancelada',
        };
    }

    public function value(): string
    {
        return match ($this) {
            SalesStatus::PENDING => SalesStatus::PENDING->value,
            SalesStatus::APPROVED => SalesStatus::APPROVED->value,
            SalesStatus::CANCELED => SalesStatus::CANCELED->value,
        };
    }
}
