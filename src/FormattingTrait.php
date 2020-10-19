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

            $iterator->current()->valueCalculated = $iterator->current()->getValueCalculated()->formatter();
            $iterator->current()->addedValue = $iterator->current()->getAddedValue()->formatter();
            $iterator->current()->originalValue = $iterator->current()->getOriginalValue()->formatter();

            return true;

        }, array($iterator));

        return $this;
    }
}