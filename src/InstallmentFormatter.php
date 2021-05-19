<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterContract;

/**
 * Class InstallmentFormatter
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
class InstallmentFormatter
{
    const PATTERN_A = '%s x %s';
    const PATTERN_B = '%s x %s (%s)';

    private $pattern;

    /**
     * @var MonetaryFormatterContract
     */
    private $monetaryFormatter;

    /**
     * InstallmentFormatter constructor.
     *
     * @param MonetaryFormatterContract $monetaryFormatter
     */
    public function __construct(MonetaryFormatterContract $monetaryFormatter)
    {
        $this->monetaryFormatter = $monetaryFormatter;
        $this->pattern = self::PATTERN_A;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function resetPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return MonetaryFormatterContract
     */
    public function getMonetaryFormatter()
    {
        return $this->monetaryFormatter;
    }

    /**
     * @param MonetaryFormatterContract $monetaryFormatter
     * @return $this
     */
    public function resetMonetaryFormatter(MonetaryFormatterContract $monetaryFormatter)
    {
        $this->monetaryFormatter = $monetaryFormatter;
        return $this;
    }
}
