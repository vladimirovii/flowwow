<?php

declare(strict_types=1);

namespace App\Model;

final class SelectionTour
{
    private ?float $amount;
    private ?\DateTimeImmutable $birthdate;
    private \DateTimeImmutable $tourdate;
    private ?\DateTimeImmutable $paymentdate;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeImmutable $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getTourdate(): \DateTimeImmutable
    {
        return $this->tourdate ?? $this->tourdate = new \DateTimeImmutable();
    }

    public function setTourdate(?\DateTimeImmutable $tourdate): self
    {
        $this->tourdate = $tourdate;

        return $this;
    }

    public function getPaymentdate(): ?\DateTimeImmutable
    {
        return $this->paymentdate;
    }

    public function setPaymentdate(?\DateTimeImmutable $paymentdate): self
    {
        $this->paymentdate = $paymentdate;

        return $this;
    }

    public function getAgeOnDateTour(): ?int
    {
        return $this->getBirthdate()?->diff($this->getTourdate())->y;
    }
}
