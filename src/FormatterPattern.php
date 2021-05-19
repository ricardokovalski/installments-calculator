<?php

namespace RicardoKovalski\InstallmentsCalculator;

use RicardoKovalski\InstallmentsCalculator\Contracts\MonetaryFormatterContract;

/**
 * Class FormatterPattern
 *
 * @package RicardoKovalski\InstallmentsCalculator
 */
class FormatterPattern
{
    private $pattern = '%s x %s';

    /**
     * @var MonetaryFormatterContract
     */
    private $monetaryFormatter;

    /**
     * FormatterPattern constructor.
     *
     * @param MonetaryFormatterContract $monetaryFormatter
     */
    public function __construct(MonetaryFormatterContract $monetaryFormatter)
    {
        $this->monetaryFormatter = $monetaryFormatter;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return MonetaryFormatterContract
     */
    public function getMonetaryFormatter()
    {
        return $this->monetaryFormatter;
    }
}
