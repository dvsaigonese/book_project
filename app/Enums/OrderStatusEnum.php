<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case PENDING      = 0;
    case PROCESSES_AND_READY_TO_SHIP    = 1;
    case OUT_FOR_DELIVERY   = 2;
    case DELIVERED   = 3;
    case CANCELLED   = 4;

    public function labels(): string
    {
        return match ($this) {
            self::PENDING         => "Pending",
            self::PROCESSES_AND_READY_TO_SHIP       => "Processed and ready to ship",
            self::OUT_FOR_DELIVERY      => "Out for delivery",
            self::DELIVERED       => "Delivered",
            self::CANCELLED      => "Cancelled",
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
