<?php

declare(strict_types=1);

namespace App\Model;

final class EarlyBookingDate
{
    public function __construct(
        private \DateTimeImmutable $startDate,
        private ?\DateTimeImmutable $endDate = null,
        /**
         * @var EarlyBookingDiscount[]
         */
        private array $earlyBookingDiscounts = [],
    ) {
    }

    public function inRange(\DateTimeImmutable $date): bool
    {
        return ($date >= $this->startDate) && (!$this->endDate || $date <= $this->endDate);
    }

    public function getEarlyBookingDiscount(\DateTimeImmutable $paymentDate): ?EarlyBookingDiscount
    {
        foreach ($this->earlyBookingDiscounts as $earlyBookingDiscount) {
            if ($earlyBookingDiscount->inRange($paymentDate)) {
                return $earlyBookingDiscount;
            }
        }

        return null;
    }
}
