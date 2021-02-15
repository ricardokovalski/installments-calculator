<?php

namespace RicardoKovalski\InstallmentsCalculator\Contracts;

/**
 * Interface Calculator
 *
 * @package RicardoKovalski\InstallmentsCalculator\Contracts
 */
interface Calculator
{
    public function resetTemplateConfig(Template $template);

    public function resetAdapterInterest(Adapter $interestAdapter);

    public function calculate();

    public function getCollection();
}
