<?php

namespace App\Enums;

enum AppointmentStatusEnum: int
{
    case Pending = 0;
    case Confirmed = 1;
    case Cancelled = 2;
    case Completed = 3;

    public function statusBadge(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-800',
            self::Confirmed => 'bg-green-100 text-green-800',
            self::Cancelled => 'bg-red-100 text-red-800',
            self::Completed => 'bg-blue-100 text-blue-800',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => __('Pending'),
            self::Confirmed => __('Confirmed'),
            self::Cancelled => __('Cancelled'),
            self::Completed => __('Completed'),
        };
    }
}
