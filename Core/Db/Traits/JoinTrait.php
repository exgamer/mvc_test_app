<?php
namespace Core\Db\Traits;

use Core\Enum\QueryEnum;

/**
 * Trait JoinTrait
 * @package concepture\php\query\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait JoinTrait
{
    protected $join = [];

    public function join($table, $on, $params = [])
    {
        $this->setJoin($table, $on, QueryEnum::JOIN, $params);

        return $this;
    }

    public function outerJoin($table, $on, $params = [])
    {
        $this->setJoin($table, $on, QueryEnum::OUTER_JOIN, $params);

        return $this;
    }

    public function innerJoin($table, $on, $params = [])
    {
        $this->setJoin($table, $on, QueryEnum::INNER_JOIN, $params);

        return $this;
    }

    public function rightJoin($table, $on, $params = [])
    {
        $this->setJoin($table, $on, QueryEnum::RIGHT_JOIN, $params);

        return $this;
    }

    public function leftJoin($table, $on, $params = [])
    {
        $this->setJoin($table, $on, QueryEnum::LEFT_JOIN, $params);

        return $this;
    }

    protected function setJoin($table, $on, $type = QueryEnum::LEFT_JOIN, $params = [])
    {
        $this->join[] = [
            $type,
            $table,
            $on
        ];
        foreach ($params as $key=>$value){
            $this->params[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getJoin(): array
    {
        return $this->join;
    }

    public function makeJoinSql()
    {
        $sql = "";
        if (! empty($this->join)){
            $joinArray = [];
            foreach ($this->join as $join){
                $joinArray[] = $join[0]. " " . $join[1] . " ON " . $join[2];
            }
            $sql .= implode(" ", $joinArray);
        }

        return $sql;
    }
}

