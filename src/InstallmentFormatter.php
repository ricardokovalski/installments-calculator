<?php

namespace RicardoKovalski\InstallmentsCalculator;

use InvalidArgumentException;
use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterContract;
use RicardoKovalski\InstallmentsCalculator\Enums\Patterns;
use RicardoKovalski\InstallmentsCalculator\Exceptions\InvalidMonetaryFormatterException;

/**
 * Class InstallmentFormatter
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
final class InstallmentFormatter
{
    /**
     * @var MonetaryFormatterContract
     */
    private $monetaryFormatter;

    /**
     * @var string
     */
    private $pattern;

    /**
     * InstallmentFormatter constructor.
     *
     * @param MonetaryFormatterContract $monetaryFormatter
     */
    public function __construct(MonetaryFormatterContract $monetaryFormatter)
    {
        $this->monetaryFormatter = $monetaryFormatter;
        $this->pattern = Patterns::PATTERN_A;
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
        if (! $pattern or ! is_string($pattern)) {
            throw new InvalidArgumentException('Invalid type pattern.');
        }

        if (! in_array($pattern, Patterns::all())) {
            throw new InvalidArgumentException('Invalid type pattern.');
        }

        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @param Installment $installment
     * @return string
     */
    public function format(Installment $installment)
    {
        if ($this->getPattern() == Patterns::PATTERN_A) {
            return sprintf($this->getPattern(), $installment->getNumberInstallment(), $this->monetaryFormatter->format($installment->getValueInstallment()));
        }

        return sprintf($this->getPattern(), $installment->getNumberInstallment(), $this->monetaryFormatter->format($installment->getValueInstallment()), $this->monetaryFormatter->format($installment->getInterestValue()));
    }
}
