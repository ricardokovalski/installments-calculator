<?php

namespace Moguzz;

trait FormattingTrait
{
    /**
     * @return $this
     */
    public function formattingInstallments()
    {
        $iterator = $this->installmentCollection->getIterator();

        iterator_apply($iterator, function(\Iterator $iterator) {
            $iterator->current()->valueCalculated = $this->currency->formatter($iterator->current()->getValueCalculated());
            $iterator->current()->addedValue = $this->currency->formatter($iterator->current()->getAddedValue());
            $iterator->current()->originalValue = $this->currency->formatter($iterator->current()->getOriginalValue());
            return true;
        }, array($iterator));

        return $this;
    }
}