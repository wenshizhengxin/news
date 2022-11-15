<?php

namespace wenshizhengxin\news\libs;

class Article
{
    public static function getStatusMap()
    {
        return [
            Constant::STATUS_ACTIVE => '启用',
            Constant::STATUS_INACTIVE => '禁用',
        ];
    }

    public static function getStatusOptions($unshiftArray = null)
    {
        $options = [];
        foreach (self::getStatusMap() as $key => $value) {
            $options[] = ['id' => $key, 'name' => $value];
        }

        if ($unshiftArray !== null) {
            array_unshift($options, $unshiftArray);
        }

        return $options;
    }

    public static function getStatusDesc($key)
    {
        return self::getStatusMap()[$key] ?? null;
    }

    public static function getTopMap()
    {
        return [
            Constant::TOP_Y => '是',
            Constant::TOP_N => '否',
        ];
    }

    public static function getTopOptions($unshiftArray = null)
    {
        $options = [];
        foreach (self::getTopMap() as $key => $value) {
            $options[] = ['id' => $key, 'name' => $value];
        }

        if ($unshiftArray !== null) {
            array_unshift($options, $unshiftArray);
        }

        return $options;
    }

    public static function getTopDesc($key)
    {
        return self::getTopMap()[$key] ?? null;
    }
}
