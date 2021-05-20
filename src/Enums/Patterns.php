<?php

namespace RicardoKovalski\InstallmentsCalculator\Enums;

/**
 * Class Patterns
 *
 * @package RicardoKovalski\InstallmentsCalculator\Enums
 */
class Patterns
{
    /**
     * numberInstallment x valueInstallment
     */
    const PATTERN_A = '%s x %s';

    /**
     * numberInstallment x valueInstallment (interestValue)
     */
    const PATTERN_B = '%s x %s (%s)';

    /**
     * @return string[]
     */
    public static function all()
    {
        return [
            self::PATTERN_A => self::PATTERN_A,
            self::PATTERN_B => self::PATTERN_B,
        ];
    }
}
