<?php
/**
 * Created by PhpStorm.
 * User: https://github.com/guyueyingmu
 * Date: 2019/5/3
 * Time: 9:08
 */

namespace App\Console\Tools;

use Medoo\Medoo;

class MedooEx extends Medoo
{
    public function __construct(array $options)
    {
        parent::__construct($options);
    }

    public function insert($table, $datas)
    {
        $stack = [];
        $columns = [];
        $fields = [];
        $map = [];

        if (!isset($datas[ 0 ]))
        {
            $datas = [$datas];
        }
        foreach ($datas as $data)
        {
            foreach ($data as $key => $value)
            {
                $columns[] = $key;
            }
        }

        $columns = array_unique($columns);

        foreach ($datas as $data)
        {
            $values = [];

            foreach ($columns as $key)
            {
                if ($raw = $this->buildRaw($data[ $key ], $map))
                {
                    $values[] = $raw;
                    continue;
                }

                $map_key =$this->mapKey();

                $values[] = $map_key;

                if (!isset($data[ $key ]))
                {
                    $map[ $map_key ] = [null, PDO::PARAM_NULL];
                }
                else
                {
                    $value = $data[ $key ];

                    $type = gettype($value);

                    switch ($type)
                    {
                        case 'array':
                            $map[ $map_key ] = [
                                strpos($key, '[JSON]') === strlen($key) - 6 ?
                                    json_encode($value) :
                                    serialize($value),
                                PDO::PARAM_STR
                            ];
                            break;

                        case 'object':
                            $value = serialize($value);

                        case 'NULL':
                        case 'resource':
                        case 'boolean':
                        case 'integer':
                        case 'double':
                        case 'string':
                            $map[ $map_key ] = $this->typeMap($value, $type);
                            break;
                    }
                }
            }

            $stack[] = '(' . implode($values, ', ') . ')';
        }

        foreach ($columns as $key)
        {
            $fields[] = $this->columnQuote(preg_replace("/(\s*\[JSON\]$)/i", '', $key));
        }
        return $this->exec('INSERT IGNORE INTO ' . $this->tableQuote($table) . ' (' . implode(', ', $fields) . ') VALUES ' . implode(', ', $stack), $map);
    }

}