<?php

namespace App\Tests\UseCase\SelectionTour;

use App\Model\EarlyBookingDate;
use App\Model\EarlyBookingDiscount;
use App\Model\EarlyBookingRepository;
use App\Model\SelectionTour;
use App\UseCase\SelectionTour\SelectionTourHandler;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SelectionTourHandlerTest extends TestCase
{
    private EarlyBookingRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(EarlyBookingRepository::class);
    }

    public static function dataProvider(): array
    {
        return [
            [125, new \DateTimeImmutable('-2 years'), new \DateTimeImmutable('+1 month'), null, 0],
            [125, new \DateTimeImmutable('-4 years'), new \DateTimeImmutable('+1 month'), null, 25],
            [20000, new \DateTimeImmutable('-8 years'), new \DateTimeImmutable('1 april next year'), null, 15500],
            [20000, new \DateTimeImmutable('-18 years'), new \DateTimeImmutable('1 april next year'), new \DateTimeImmutable('first day of november'), 18600],
            [20000, new \DateTimeImmutable('-18 years'), new \DateTimeImmutable('1 april next year'), new \DateTimeImmutable('first day of december'), 19000],
            [20000, new \DateTimeImmutable('-18 years'), new \DateTimeImmutable('1 april next year'), new \DateTimeImmutable('first day of january next year'), 19400],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testCalculateTotalCost(
        float $amount,
        \DateTimeImmutable $birthdate,
        \DateTimeImmutable $tourdate,
        ?\DateTimeImmutable $paymentdate,
        float $expected,
    ): void {
        $this->repository
            ->method('getAll')
            ->willReturn([
                $this->createEarlyBookindDate(),
            ]);

        $selectionTourHandler = new SelectionTourHandler($this->repository);
        $totalAmount = $selectionTourHandler->calculateTotalAmount((new SelectionTour())
            ->setAmount($amount)
            ->setBirthdate($birthdate)
            ->setTourdate($tourdate)
            ->setPaymentdate($paymentdate)
        );

        $this->assertEquals($expected, $totalAmount);
    }

    private function createEarlyBookindDate(): EarlyBookingDate
    {
        return new EarlyBookingDate(
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
    }
}
