<?php

namespace wenshizhengxin\news\app;

use epii\server\Args;
use think\Db;
use wenshizhengxin\news\libs\Constant;

class classify extends base
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
            $alias = 'c';
            $where = [];

            if (Args::params('mode/d')) {
                $where[] = [$alias . '.status', '=', Constant::STATUS_ACTIVE];
            }

            if ($classify_name = Args::params('classify_name/s')) {
                $where[] = [
                    $alias . '.classify_name', 'like', '%' . $classify_name . '%'
                ];
            }
            if ($pid = Args::params('pid/d')) {
                $where[] = [
                    $alias . '.pid', '=',  $pid
                ];
            }

            $query = Db::name(Constant::TABLE_CLASSIFY)->alias($alias)->order($alias . '.id', 'DESC');
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

                    'classify_name' => Args::params('classify_name/s/1'),
                    'note' => Args::params('note/s'),
                    'sort' => Args::params('sort/d', 1000),
                    // 'pid' => Args::params('pid/d'),
                    // 'icon' => Args::params('icon/s'),
                    // 'icon2' => Args::params('icon2/s'),
                    // 'badge' => Args::params('badge/s'),
                    // 'badge_class' => Args::params('badge_class/s'),
                    'status' => Args::params('status/d'),
                ];

                $timestamp = time();

                /************事务开始************/
                Db::startTrans();
                if ($id === 0) { // 新增
                    $insertData['create_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_CLASSIFY)->insert($insertData, false, true);
                    if (!$res) {
                        throw new \Exception('添加失败');
                    }
                } else { // 修改
                    $insertData['update_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_CLASSIFY)->where('id', $id)->update($insertData);
                    if (!$res) {
                        throw new \Exception('修改失败');
                    }
                }
                Db::commit();
                /************事务结束************/

                $this->success();
            } else {
                if ($id > 0) {
                    $classify = Db::name(Constant::TABLE_CLASSIFY)->where('id', $id)->find();
                    $this->assign('classify', $classify);
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
            $res = Db::name(Constant::TABLE_CLASSIFY)->where('id', $id)->delete();
            if (!$res) {
                throw new \Exception('删除失败');
            }

            $this->success();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
