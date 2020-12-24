<?php
namespace Core\Db;

use Core\Base\BaseObject;
use Core\Db\Traits\GroupTrait;
use Core\Db\Traits\JoinTrait;
use Core\Db\Traits\LimitOffsetTrait;
use Core\Db\Traits\OrderTrait;
use Core\Db\Traits\SelectionTrait;
use Core\Db\Traits\WhereTrait;

/**
 * Class ReadCondition
 * @package concepture\php\data\core\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class ReadCondition extends BaseObject implements ReadConditionInterface
{
    protected $params = [];

    use WhereTrait;
    use JoinTrait;
    use SelectionTrait;
    use OrderTrait;
    use LimitOffsetTrait;
    use GroupTrait;

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}