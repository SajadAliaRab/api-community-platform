<?php
namespace App\Enums;

enum TitleEnum:string
{
case mr = 'mr';
case mrs = 'mrs';
case miss = 'miss';
case ms = 'ms';
case dr = 'dr';
case professor = 'professor';
case lord = 'lord';
case lady = 'lady';
case reverend = 'reverend';
case other = 'other';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

