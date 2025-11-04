<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class PriorityTaskEnum extends Enum
{
    const THAP = 'Thấp';
    const TRUNG_BINH = 'Trung bình';
    const CAO = 'Cao';

    public static function values(): array
    {
        return [
            self::THAP,
            self::TRUNG_BINH,
            self::CAO,
        ];
    }
}
