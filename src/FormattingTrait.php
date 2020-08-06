<?php

namespace Moguzz;

trait FormattingTrait
{
    /**
     * @return $this
     */
    public function formattingInstallments()
    {
        array_map(function (Installment $installment) {
            $installment->valueCalculated = $this->currency->formatter($installment->getValueCalculated());
            $installment->addedValue = $this->currency->formatter($installment->getAddedValue());
            $installment->originalValue = $this->currency->formatter($installment->getOriginalValue());
        }, $this->installments);

        return $this;
    }
}