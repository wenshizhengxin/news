<?php

namespace wenshizhengxin\news\libs;

use think\Db;

class Classify
{
    public static function getOptions($where = [], $unshiftArray = null)
    {
        $options = Db::name(Constant::TABLE_CLASSIFY)->where($where)
            ->field('id,classify_name as name')->select();

        if ($unshiftArray !== null) {
            array_unshift($options, $unshiftArray);
        }

        return $options;
    }
}
