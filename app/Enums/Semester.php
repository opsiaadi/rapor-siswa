<?php

namespace App\Enums;

enum Semester: string
{
    case Ganjil = '1';
    case Genap = '2';

    public function label(): string
    {
        return match ($this) {
            self::Ganjil => 'Ganjil',
            self::Genap => 'Genap',
        };
    }

    public static function labels(): array
    {
        return [
            self::Ganjil->value => self::Ganjil->label(),
            self::Genap->value => self::Genap->label(),
        ];
    }
}
