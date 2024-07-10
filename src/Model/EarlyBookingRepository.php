<?php

declare(strict_types=1);

namespace App\Model;

class EarlyBookingRepository
{
    /**
     * @return EarlyBookingDate[]
     */
    public function getAll(): iterable
    {
        yield new EarlyBookingDate(
            new \DateTimeImmutable('1 april next year'),
            new \DateTimeImmutable('30 september next year'),
            [
                new EarlyBookingDiscount(
                    null,
                    new \DateTimeImmutable('last day of november'),
                    7,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of december'),
                    new \DateTimeImmutable('last day of december'),
                    5,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of january next year'),
                    new \DateTimeImmutable('last day of january next year'),
                    3
                ),
            ]
        );
        yield new EarlyBookingDate(
            new \DateTimeImmutable('1 october'),
            new \DateTimeImmutable('14 january next year'),
            [
                new EarlyBookingDiscount(
                    null,
                    new \DateTimeImmutable('last day of march'),
                    7,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of april'),
                    new \DateTimeImmutable('last day of april'),
                    5,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of may'),
                    new \DateTimeImmutable('last day of may'),
                    3
                ),
            ]
        );
        yield new EarlyBookingDate(
            new \DateTimeImmutable('15 january next year'),
            earlyBookingDiscounts: [
                new EarlyBookingDiscount(
                    null,
                    new \DateTimeImmutable('last day of august'),
                    7,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of september'),
                    new \DateTimeImmutable('last day of september'),
                    5,
                ),
                new EarlyBookingDiscount(
                    new \DateTimeImmutable('first day of october'),
                    new \DateTimeImmutable('last day of october'),
                    3
                ),
            ]
        );
    }
}
