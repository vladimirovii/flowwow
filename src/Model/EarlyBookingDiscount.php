<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class EarlyBookingDiscount extends Discount
{
    private const EARLY_BOOKING_MAX_DISCOUNT = 1500;

    public function __construct(
        private ?\DateTimeImmutable $startDate,
        private \DateTimeImmutable $endDate,
        #[Assert\Range(min: 0, max: 100)] int $percent,
        float $maxDiscountAmount = self::EARLY_BOOKING_MAX_DISCOUNT
    ) {
        parent::__construct($percent, $maxDiscountAmount);
    }

    public function inRange(\DateTimeImmutable $date): bool
    {
        return (!$this->startDate || $date >= $this->startDate) && ($date <= $this->endDate);
    }
}
