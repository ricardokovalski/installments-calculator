<?php

namespace Moguzz;

use Moguzz\Entities\Installment;

/**
 * Class InstallmentCollection
 *
 * @package Moguzz
 */
class InstallmentCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var array $installments
     */
    private $installments = [];

    /**
     * @param $installment
     * @return mixed|null
     */
    public function getInstallment($installment)
    {
        if ((int) $installment <= $this->count()) {
            return $this->installments[$installment];
        }

        return null;
    }

    /**
     * @param Installment $installment
     * @return $this
     */
    public function appendInstallment(Installment $installment)
    {
        array_push($this->installments, $installment);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->installments);
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new InstallmentCollectionIterator($this);
    }
}