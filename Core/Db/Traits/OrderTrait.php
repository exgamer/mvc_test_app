<?php
namespace Core\Db\Traits;

/**
 * Trait OrderTrait
 * @package Core\Db\Traits
 */
trait OrderTrait
{
    protected $order = "";

    /**
     * @param $order
     * @return $this
     */
    public function order($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder() : string
    {
        return $this->order;
    }
}

