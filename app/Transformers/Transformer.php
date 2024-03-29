<?php

namespace App\Transformers;

/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 11/01/16
 * Time: 18:20
 */
abstract class Transformer {

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'],
            $items->toArray()
        );
    }

    public abstract function transform($item);
}

