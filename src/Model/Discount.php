<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Discount
{
    public function __construct(
        #[Assert\Range(min: 0, max: 100)] private int $percent,
        private ?float $maxDiscountAmount = null,
    ) {
    }

    public function applyDiscount(float $amount): float
    {
        $discountAmount = (($amount * $this->percent) / 100);
        if (null !== $this->maxDiscountAmount && $discountAmount > $this->maxDiscountAmount) {
            $discountAmount = $this->maxDiscountAmount;
        }

        return $amount - $discountAmount;
    }
}
