<?php

namespace Moguzz;

/**
 * Class Installment
 * @package Moguzz
 */
final class Installment
{
    /**
     * @var float $amount
     */
    private $amount;

    /**
     * @var integer $installment
     */
    private $installment;

    /**
     * @var float $addedValue
     */
    private $addedValue;

    /**
     * Installment constructor.
     * @param $amount
     * @param $installment
     * @param $addedValue
     */
    public function __construct($amount, $installment, $addedValue)
    {
        $this->amount = $amount ?: 0.00;
        $this->installment = $installment;
        $this->addedValue = $addedValue;
    }
}