<?php
namespace Core\Db\Mysql\Read;

use Core\Db\ReadQueryBuilderInterface;
use Core\Db\QueryBuilder as Base;
use Core\Db\Traits\GroupTrait;
use Core\Db\Traits\JoinTrait;
use Core\Db\Traits\LimitOffsetTrait;
use Core\Db\Traits\OrderTrait;
use Core\Db\Traits\SelectionTrait;
use Core\Db\Traits\WhereTrait;

/**
 * Class QueryBuilder
 * @package Core\Db\Mysql\Modify
 * @author citizenzet <exgamer@live.ru>
 */
class QueryBuilder extends Base implements ReadQueryBuilderInterface
{
    use WhereTrait;
    use JoinTrait;
    use SelectionTrait;
    use OrderTrait;
    use LimitOffsetTrait;
    use GroupTrait;

    protected $calcRows = false;

    /**
     * Добавить в запрос SQL_CALC_FOUND_ROWS
     */
    public function calculateRowsCount()
    {
        $this->calcRows = true;
    }

    /**
     * @return $this
     */
    public function makeSelectSql()
    {
        $sql = "SELECT ";
        if ($this->calcRows){
            $sql .= " SQL_CALC_FOUND_ROWS ";
        }
        if (empty($this->select)){
            $sql .= "*";
        }else{
            $sql .= implode(",", $this->select);
        }
        $sql .= " FROM " . $this->table;
        if ($this->tableAlias){
            $sql .= " " . $this->tableAlias;
        }
        $sql .= " ". $this->makeJoinSql();
        $sql .= " ".$this->makeWhereSql();
        if ($this->group){
            $sql .= " GROUP BY ". $this->group;
        }
        if ($this->order){
            $sql .= " ORDER BY ". $this->order;
        }
        if ($this->limit){
            $sql .= " LIMIT ". $this->limit;
        }
        if ($this->offset){
            $sql .= " OFFSET ". $this->offset;
        }
        $this->sql = $sql;

        return $this;
    }

    /**
     * @todo do refactor
     *
     * apply ReadCondition to Builder
     *
     * @param ReadCondition $readCondition
     */
    public function applyReadQuery(ReadCondition $readCondition)
    {
        if (! empty($readCondition->getSelect())){
            $this->select = $readCondition->getSelect();
        }
        if (! empty($readCondition->getJoin())){
            $this->join = $readCondition->getJoin();
        }
        if (! empty($readCondition->getOrder())){
            $this->order = $readCondition->getOrder();
        }
        if (! empty($readCondition->getTable())){
            $this->table = $readCondition->getTable();
        }
        if (! empty($readCondition->getTableAlias())){
            $this->tableAlias = $readCondition->getTableAlias();
        }
        if (! empty($readCondition->getWhere())){
            $this->where = $readCondition->getWhere();
        }
        if (! empty($readCondition->getLimit())){
            $this->limit = $readCondition->getLimit();
        }
        if (! empty($readCondition->getOffset())){
            $this->offset = $readCondition->getOffset();
        }
        if (! empty($readCondition->getOrder())){
            $this->order = $readCondition->getOrder();
        }
        if (! empty($readCondition->getGroup())){
            $this->group = $readCondition->getGroup();
        }
        if (! empty($readCondition->getParams())){
            $this->params = $readCondition->getParams();
        }
    }
}
