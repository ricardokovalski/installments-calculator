<?php

namespace Moguzz;

/**
 * Class InstallmentsIterator
 * @package Moguzz
 */
class InstallmentCollectionIterator implements \Iterator
{
    /**
     * @var InstallmentCollection
     */
    protected $installmentCollection;

    /**
     * @var int $position
     */
    protected $position = 0;

    /**
     * InstallmentCollectionIterator constructor.
     * @param InstallmentCollection $installmentCollection
     */
    public function __construct(InstallmentCollection $installmentCollection)
    {
        $this->installmentCollection = $installmentCollection;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->installmentCollection->getInstallment($this->position);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->position < $this->installmentCollection->count();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }
}