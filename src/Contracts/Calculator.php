<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Calculator
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface Calculator
{
    public function applySetting(Template $template);

    public function applyInterest(Adapter $interestAdapter);

    public function calculate();

    public function getCollection();
}
