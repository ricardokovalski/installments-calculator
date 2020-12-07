<?php

namespace Moguzz\Contracts;

/**
 * Interface Calculator
 *
 * @package Moguzz\Contracts
 */
interface Calculator
{
    public function applySetting(Template $template);

    public function applyInterest(Interest $interest);

    public function calculateInstallments();

    public function getCollectionInstallments();
}