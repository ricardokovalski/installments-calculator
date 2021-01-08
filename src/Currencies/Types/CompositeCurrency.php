<?php

namespace RicardoKovalski\InstallmentsCalculator\Currencies\Types;

use RicardoKovalski\InstallmentsCalculator\Contracts\Currency;

abstract class CompositeCurrency implements Currency
{
    /**
     * @var string $prefix
     */
    private $prefix = "$";

    /**
     * @var int $decimals
     */
    private $decimals;

    /**
     * @var string $decPoint
     */
    private $decPoint;

    /**
     * @var string $thousandsSep
     */
    private $thousandsSep;

    /**
     * Dollar constructor.
     *
     * @param int $decimals
     */
    public function __construct($decimals = 2)
    {
        $this->decimals = $decimals;
        $this->makePrefix();
        $this->makeDecPoint();
        $this->makeThousandsSep();
    }

    /**
     * @return mixed
     */
    abstract protected function prefix();

    /**
     * @return mixed
     */
    abstract protected function decPoint();

    /**
     * @return mixed
     */
    abstract protected function thousandsSep();

    /**
     * @return mixed
     */
    protected function makePrefix()
    {
        return $this->prefix = $this->prefix();
    }

    /**
     * @return mixed
     */
    protected function makeDecPoint()
    {
        return $this->decPoint = $this->decPoint();
    }

    /**
     * @return mixed
     */
    protected function makeThousandsSep()
    {
        return $this->thousandsSep = $this->thousandsSep();
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return int
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * @return string
     */
    public function getDecPoint()
    {
        return $this->decPoint;
    }

    /**
     * @return string
     */
    public function getThousandsSep()
    {
        return $this->thousandsSep;
    }
}