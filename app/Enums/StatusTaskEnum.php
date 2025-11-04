<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class StatusTaskEnum extends Enum
{
    const CHUA_LAM = 'Chưa làm';
    const DANG_LAM = 'Đang làm';
    const HOAN_THANH = 'Hoàn thành';

    public static function values(): array
    {
        return [
            self::CHUA_LAM,
            self::DANG_LAM,
            self::HOAN_THANH,
        ];
    }
}
