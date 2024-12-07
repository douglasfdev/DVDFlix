<?php

namespace App\Enums;

enum RoleEnum: int
{
    case ADMIN = 1;
    case MANAGER = 2;
    case SELLER = 3;
    case CUSTOMER = 4;

    public function name(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::MANAGER => 'Manager',
            self::SELLER => 'Seller',
            self::CUSTOMER => 'Customer',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::MANAGER => 'Manager',
            self::SELLER => 'Seller',
            self::CUSTOMER => 'Customer',
        };
    }

    public function permissions(): array
    {
        return match ($this) {
            self::ADMIN => ['admin', 'manager', 'seller', 'customer'],
            self::MANAGER => ['manager', 'seller', 'customer'],
            self::SELLER => ['seller', 'customer'],
            self::CUSTOMER => ['customer'],
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::ADMIN => self::ADMIN->value,
            self::MANAGER => self::MANAGER->value,
            self::SELLER => self::SELLER->value,
            self::CUSTOMER => self::CUSTOMER->value,
        };
    }

    public static function values(): array
    {
        return array_map(fn(RoleEnum $role) => $role->value, self::cases());
    }

    public static function names(): array
    {
        return array_map(fn(RoleEnum $role) => $role->name, self::cases());
    }
}
