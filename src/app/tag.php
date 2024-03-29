<?php

namespace wenshizhengxin\news\app;

use epii\server\Args;
use think\Db;
use wenshizhengxin\news\libs\Constant;

class tag extends base
{
    public function index()
    {
        try {
            $this->assign('mode', Args::params('mode/d'));

            $this->adminUiDisplay();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function ajax_data()
    {
        try {
            $alias = 't';
            $where = [];

            if (Args::params('mode/d')) {
                $where[] = [$alias . '.status', '=', Constant::STATUS_ACTIVE];
            }

            if ($tag_name = Args::params('tag_name/s')) {
                $where[] = [
                    $alias . '.' . 'tag_name', 'like', '%' . $tag_name . '%'
                ];
            }

            $query = Db::name(Constant::TABLE_TAG)->alias($alias)->order($alias . '.id', 'DESC');
            return $this->tableJsonData($query, $where, function ($row) {
                $row['create_time'] = date('Y-m-d H:i:s', $row['create_time']);
                return $row;
            });
        } catch (\Exception $e) {
        }
    }

    public function add()
    {
        try {
            $id = Args::params('id/d', 0);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $insertData = [

                    'tag_name' => Args::params('tag_name/s/1'),
                    'status' => Args::params('status/d'),
                    'sort' => Args::params('sort/d', 1000),
                ];

                $timestamp = time();

                /************事务开始************/
                Db::startTrans();
                if ($id === 0) { // 新增
                    $insertData['create_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_TAG)->insert($insertData, false, true);
                    if (!$res) {
                        throw new \Exception('添加失败');
                    }
                } else { // 修改
                    $insertData['update_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_TAG)->where('id', $id)->update($insertData);
                    if (!$res) {
                        throw new \Exception('修改失败');
                    }
                }
                Db::commit();
                /************事务结束************/

                $this->success();
            } else {
                if ($id > 0) {
                    $tag = Db::name(Constant::TABLE_TAG)->where('id', $id)->find();
                    $this->assign('tag', $tag);
                }

                $this->assign('statusOptions', \wenshizhengxin\news\libs\Article::getStatusOptions());

                $this->adminUiDisplay();
            }
        } catch (\Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
    }

    public function del()
    {
        try {
            $id = Args::params('id/1');
            $res = Db::name(Constant::TABLE_TAG)->where('id', $id)->delete();
            if (!$res) {
                throw new \Exception('删除失败');
            }

            $this->success();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
