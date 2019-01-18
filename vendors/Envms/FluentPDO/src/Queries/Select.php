<?php

namespace Envms\FluentPDO\Queries;

use Envms\FluentPDO\{Exception, Query, Utilities};

/**
 * SELECT query builder
 */
class Select extends Common implements \Countable
{

    /** @var mixed */
    private $fromTable;
    /** @var mixed */
    private $fromAlias;

    /**
     * SelectQuery constructor.
     *
     * @param Query     $fluent
     * @param           $from
     */
    function __construct(Query $fluent, $from)
    {
        $clauses = [
            'SELECT'   => ', ',
            'FROM'     => null,
            'JOIN'     => [$this, 'getClauseJoin'],
            'WHERE'    => [$this, 'getClauseWhere'],
            'GROUP BY' => ',',
            'HAVING'   => ' AND ',
            'ORDER BY' => ', ',
            'LIMIT'    => null,
            'OFFSET'   => null,
            "\n--"     => "\n--"
        ];
        parent::__construct($fluent, $clauses);

        // initialize statements
        $fromParts = explode(' ', $from);
        $this->fromTable = reset($fromParts);
        $this->fromAlias = end($fromParts);

        $this->statements['FROM'] = $from;
        $this->statements['SELECT'][] = $this->fromAlias . '.*';
        $this->joins[] = $this->fromAlias;
    }

    /**
     * @param mixed $columns
     * @param bool  $overrideDefault
     *
     * @return $this
     */
    public function select($columns, bool $overrideDefault = false)
    {
        if ($overrideDefault === true) {
            $this->resetClause('SELECT');
        } elseif ($columns === null) {
            return $this->resetClause('SELECT');
        }

        $this->addStatement('SELECT', $columns, []);

        return $this;
    }

    /**
     * Return table name from FROM clause
     */
    public function getFromTable()
    {
        return $this->fromTable;
    }

    /**
     * Return table alias from FROM clause
     */
    public function getFromAlias()
    {
        return $this->fromAlias;
    }

    /**
     * Returns a single column
     *
     * @param int $columnNumber
     *
     * @throws Exception
     *
     * @return string
     */
    public function fetchColumn($columnNumber = 0)
    {
        if (($s = $this->execute()) !== false) {
            return $s->fetchColumn($columnNumber);
        }

        return $s;
    }

    /**
     * Fetch first row or column
     *
     * @param string $column column name or empty string for the whole row
     *
     * @throws Exception
     *
     * @return mixed string, array or false if there is no row
     */
    public function fetch($column = '')
    {
        $result = $this->execute();

        if ($result === false) {
            return false;
        }

        $row = $result->fetch();

        if ($this->fluent->convertRead === true) {
            $row = Utilities::stringToNumeric($result, $row);
        }

        if ($row && $column != '') {
            if (is_object($row)) {
                return $row->{$column};
            } else {
                return $row[$column];
            }
        }

        return $row;
    }

    /**
     * Fetch pairs
     *
     * @param $key
     * @param $value
     * @param $object
     *
     * @throws Exception
     *
     * @return array|\PDOStatement
     */
    public function fetchPairs($key, $value, $object = false)
    {
        if (($s = $this->select("$key, $value", true)->asObject($object)->execute()) !== false) {
            return $s->fetchAll(\PDO::FETCH_KEY_PAIR);
        }

        return $s;
    }

    /** Fetch all row
     *
     * @param string $index      specify index column
     * @param string $selectOnly select columns which could be fetched
     *
     * @throws Exception
     *
     * @return \PDOStatement|array of fetched rows
     */
    public function fetchAll($index = '', $selectOnly = '')
    {
        // allows for data organization by field -> fetchAll('column[]')
        $indexAsArray = strpos($index, '[]');

        if ($indexAsArray !== false) {
            $index = str_replace('[]', '', $index);
        }

        if ($selectOnly) {
            $this->select($index . ', ' . $selectOnly, true);
        }

        if ($index) {
            $data = [];

            foreach ($this as $row) {
                if (is_object($row)) {
                    $key = $row->{$index};
                } else {
                    $key = $row[$index];
                }

                if ($indexAsArray) {
                    $data[$key][] = $row;
                } else {
                    $data[$key] = $row;
                }
            }

            return $data;
        } else {
            if (($result = $this->execute()) !== false) {
                if ($this->fluent->convertRead === true) {
                    return Utilities::stringToNumeric($result, $result->fetchAll());
                } else {
                    return $result->fetchAll();
                }
            }

            return $result;
        }
    }

    /**
     * \Countable interface doesn't break current select query
     *
     * @throws Exception
     *
     * @return int
     */
    public function count()
    {
        $fluent = clone $this;

        return (int)$fluent->select('COUNT(*)', true)->fetchColumn();
    }

    /**
     * @throws Exception
     *
     * @return \ArrayIterator|\PDOStatement
     */
    public function getIterator()
    {
        if ($this->fluent->convertRead === true) {
            return new \ArrayIterator($this->fetchAll());
        } else {
            return $this->execute();
        }
    }

}
