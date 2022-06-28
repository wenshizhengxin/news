<?php

namespace wenshizhengxin\news\app;

use epii\server\Args;
use think\Db;
use think\db\Expression;

class article extends base
{
    public function index()
    {
        try {
            $this->adminUiDisplay();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function ajax_data()
    {
        try {
            $alias = 'n';
            $where = [];

            if ($title = Args::params('title/s')) {
                $where[] = [
                    $alias . '.' . 'title', 'like', '%' . $title . '%'
                ];
            }
            if ($classify_ids = Args::params('classify_ids/d')) {
                $where[] = ['', 'exp', new Expression('FIND_IN_SET("' . $classify_ids . '", "classify_ids")')];
            }

            $query = Db::name('news')->alias($alias);
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

                    'title' => Args::params('title/s/1'),
                    'sub_title' => Args::params('sub_title/s'),
                    'desc' => Args::params('desc/s'),
                    'content' => Args::params('content/s/1'),
                    'images' => Args::params('images/s'),
                    'author' => Args::params('author/s'),
                    'classify_ids' => Args::params('classify_ids/s'),
                    'tag_ids' => Args::params('tag_ids/s'),
                    'status' => Args::params('status/d'),
                    'top' => Args::params('top/d'),
                    'sort' => Args::params('sort/d'),
                ];

                $timestamp = time();

                /************事务开始************/
                Db::startTrans();
                if ($id === 0) { // 新增
                    $insertData['create_time'] = $timestamp;
                    $res = Db::name('news')->insert($insertData, false, true);
                    if (!$res) {
                        throw new \Exception('添加失败');
                    }
                } else { // 修改
                    $insertData['update_time'] = $timestamp;
                    $res = Db::name('news')->where('id', $id)->update($insertData);
                    if (!$res) {
                        throw new \Exception('修改失败');
                    }
                }
                Db::commit();
                /************事务结束************/

                $this->success();
            } else {
                if ($id > 0) {
                    $news = Db::name('news')->where('id', $id)->find();
                    $this->assign('news', $news);
                }

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
            $res = Db::name('news')->where('id', $id)->delete();
            if (!$res) {
                throw new \Exception('删除失败');
            }

            $this->success();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
