<?php
namespace App\Enums;

enum TitleEnum:string
{
case Mr = 'mr';
case Mrs = 'mrs';
case Miss = 'miss';
case Ms = 'ms';
case Dr = 'dr';
case Professor = 'professor';
case Lord = 'lord';
case Lady = 'lady';
case Reverend = 'reverend';
case Other = 'other';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

