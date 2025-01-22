<?php

namespace App\Enums;

enum AuctionStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Closed = 'closed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
