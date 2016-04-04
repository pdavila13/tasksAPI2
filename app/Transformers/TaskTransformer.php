<?php
/**
 * Created by PhpStorm.
 * User: pdavila
 * Date: 11/01/16
 * Time: 18:25
 */

namespace App\Transformers;


class TaskTransformer extends Transformer {
    public function transform($item){
        return [
            'name' => $item['name'],
            'tran' => (boolean) $item['tran']
            //'created_at' => $tag['created_at'],
            //'updated_at' => $tag['updated_at']
        ];
    }
}