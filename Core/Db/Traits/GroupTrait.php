<?php
namespace Core\Db\Traits;

/**
 * Trait GroupTrait
 * @package Core\Db\Traits
 */
trait GroupTrait
{
    protected $group = "";

    /**
     * @return string
     */
    public function getGroup() : string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function group(string $group)
    {
        $this->group = $group;
    }
}

