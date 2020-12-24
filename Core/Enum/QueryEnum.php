<?php

namespace Core\Enum;

/**
 * Class QueryEnum
 * @package Core\Enum
 * @author citizenzet <exgamer@live.ru>
 */
class QueryEnum extends Enum
{
    const JOIN = 'JOIN';
    const LEFT_JOIN = 'LEFT JOIN';
    const RIGHT_JOIN = 'RIGHT JOIN';
    const INNER_JOIN = 'INNER JOIN';
    const OUTER_JOIN = 'OUTER JOIN';

    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';
}
