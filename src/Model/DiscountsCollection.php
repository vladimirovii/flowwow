<?php

declare(strict_types=1);

namespace App\Model;

final class DiscountsCollection
{
    /**
     * @var Discount[]
     */
    private array $discounts = [];

    public function addDiscount(Discount $discount): void
    {
        $this->discounts[] = $discount;
    }

    public function getDiscount(float $amount): ?Discount
    {
        return \array_reduce(
            $this->discounts,
            function (?Discount $c, Discount $v) use ($amount) {
                if (null === $c) {
                    return $v;
                }

                return $c->applyDiscount($amount) > $v->applyDiscount($amount) ? $v : $c;
            },
        );
    }
}
