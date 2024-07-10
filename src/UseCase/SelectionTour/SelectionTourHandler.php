<?php

declare(strict_types=1);

namespace App\UseCase\SelectionTour;

use App\Model\Discount;
use App\Model\DiscountsCollection;
use App\Model\EarlyBookingRepository;
use App\Model\SelectionTour;

final class SelectionTourHandler
{
    public function __construct(
        private EarlyBookingRepository $earlyBookingRepository
    ) {
    }

    public function calculateTotalAmount(SelectionTour $selectionTour): ?float
    {
        $discountsCollection = new DiscountsCollection();

        if (null !== ($age = $selectionTour->getAgeOnDateTour())) {
            if ($age < 3) {
                $discountsCollection->addDiscount(new Discount(100));
            } elseif ($age < 6) {
                $discountsCollection->addDiscount(new Discount(80));
            } elseif ($age < 12) {
                $discountsCollection->addDiscount(new Discount(30, 4500));
            } elseif ($age < 18) {
                $discountsCollection->addDiscount(new Discount(10));
            }
        }

        if (null !== $selectionTour->getPaymentdate()) {
            foreach ($this->earlyBookingRepository->getAll() as $earlyBookindDate) {
                if ($earlyBookindDate->inRange($selectionTour->getTourdate())
                    && null !== ($earlyBookingDiscount = $earlyBookindDate->getEarlyBookingDiscount($selectionTour->getPaymentdate()))) {
                    $discountsCollection->addDiscount($earlyBookingDiscount);
                }
            }
        }

        $amount = $selectionTour->getAmount();
        if (null !== ($discount = $discountsCollection->getDiscount($amount))) {
            return $discount->applyDiscount($amount);
        }

        return $amount;
    }
}
