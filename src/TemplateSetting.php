<?php

namespace Moguzz;

use InvalidArgumentException;

/**
 * Class TemplateSetting
 * @package Moguzz
 */
class TemplateSetting
{
    /**
     * @var integer $numberMaxInstallments
     */
    private $numberMaxInstallments;

    /**
     * @var boolean $limitInstallments
     */
    private $limitInstallments;

    /**
     * @var float $limitValueInstallment
     */
    private $limitValueInstallment;

    /**
     * TemplateSetting constructor.
     */
    public function __construct()
    {
        $this->numberMaxInstallments = 12;
        $this->limitInstallments = true;
        $this->limitValueInstallment = 5.00;
    }

    /**
     * @return int
     */
    public function getNumberMaxInstallments()
    {
        return $this->numberMaxInstallments;
    }

    /**
     * @param $numberMaxInstallments
     * @return $this
     */
    public function setNumberMaxInstallments($numberMaxInstallments)
    {
        $this->verifyNumberInstallments($numberMaxInstallments);

        $this->numberMaxInstallments = $numberMaxInstallments;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLimitInstallments()
    {
        return $this->limitInstallments;
    }

    /**
     * @param $limitInstallments
     * @return $this
     */
    public function setLimitInstallments($limitInstallments)
    {
        $this->limitInstallments = $limitInstallments;
        return $this;
    }

    /**
     * @return float
     */
    public function getLimitValueInstallment()
    {
        return $this->limitValueInstallment;
    }

    /**
     * @param $limitValueInstallment
     * @return $this
     */
    public function setLimitValueInstallment($limitValueInstallment)
    {
        $this->limitValueInstallment = $limitValueInstallment;
        return $this;
    }

    /**
     * @param $number
     * @return bool
     */
    private function verifyNumberInstallments($number)
    {
        if ($number < 1) {
            throw new InvalidArgumentException('The minimum number of installments cannot be less than zero.');
        }

        if ($number > 12) {
            throw new InvalidArgumentException('The maximum number of installments cannot be greater than twelve.');
        }

        return true;
    }

}