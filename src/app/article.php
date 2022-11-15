<?php

namespace wenshizhengxin\news\app;

use epii\server\Args;
use think\Db;
use think\db\Expression;
use wenshizhengxin\news\libs\Constant;

class article extends base
{
    public function index()
    {
        try {
            $this->assign('classifyOptions', \wenshizhengxin\news\libs\Classify::getOptions([], ['id' => '', 'name' => '————请选择————']));

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
            if ($classify_id = Args::params('classify_id/d')) {
                $where[] = new Expression('FIND_IN_SET("' . $classify_id . '", `' . $alias . '`.`classify_ids`)');
            }

            $query = Db::name(Constant::TABLE_ARTICLE)->alias($alias)->order([$alias . '.sort' => 'ASC', $alias . '.id' => 'DESC']);
            // echo $query->where($where)->fetchSql(true)->select();exit;
            return $this->tableJsonData($query, $where, function ($row) {
                $row['create_time'] = date('Y-m-d H:i:s', $row['create_time']);
                $row['status_desc'] = \wenshizhengxin\news\libs\Article::getStatusDesc($row['status']);
                $row['top_desc'] = \wenshizhengxin\news\libs\Article::getTopDesc($row['top']);
                $row['title_desc'] = $row['title'];
                if ($row['tag_names']) {
                    $styles = ['success', 'danger', 'primary', 'warning'];
                    $row['title_desc'] .= '<br>';
                    $tagNames = explode(',', $row['tag_names']);
                    foreach ($tagNames as $i => $tagName) {
                        if ($i) {
                            $row['title_desc'] .= '&nbsp;';
                        }
                        $row['title_desc'] .= '<a class="btn btn-outline-' . $styles[$i % count($styles)] .
                            ' btn-sm" href="javascript:void(0)">' . $tagName . '</a>';
                    }
                }
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

                    'title' => Args::params('title/s/1', '标题不能为空'),
                    'sub_title' => Args::params('sub_title/s', ''),
                    'desc' => Args::params('desc/s', ''),
                    'content' => Args::params('content/s/1', '内容不能为空'),
                    'images' => Args::params('images/s', ''),
                    'author' => Args::params('author/s/1', '作者不能为空'),
                    'classify_ids' => Args::params('classify_ids/s'),
                    'classify_names' => Args::params('classify_names/s'),
                    'tag_ids' => Args::params('tag_ids/s'),
                    'tag_names' => Args::params('tag_names/s'),
                    // 'status' => Args::params('status/d'),
                    // 'top' => Args::params('top/d'),
                    'sort' => Args::params('sort/d', 1000),
                ];

                $timestamp = time();

                /************事务开始************/
                Db::startTrans();
                if ($id === 0) { // 新增
                    $insertData['create_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_ARTICLE)->insert($insertData, false, true);
                    if (!$res) {
                        throw new \Exception('添加失败');
                    }
                } else { // 修改
                    $insertData['update_time'] = $timestamp;
                    $res = Db::name(Constant::TABLE_ARTICLE)->where('id', $id)->update($insertData);
                    if (!$res) {
                        throw new \Exception('修改失败');
                    }
                }
                Db::commit();
                /************事务结束************/

                $this->success();
            } else {
                if ($id > 0) {
                    $news = Db::name(Constant::TABLE_ARTICLE)->where('id', $id)->find();
                    $this->assign('news', $news);

                    $this->assign('classifies', Db::name(Constant::TABLE_CLASSIFY)->where('id', 'in', explode(',', $news['classify_ids']))->select());
                    $this->assign('tags', Db::name(Constant::TABLE_TAG)->where('id', 'in', explode(',', $news['classify_ids']))->select());
                }

                $this->assign('statusOptions', \wenshizhengxin\news\libs\Article::getStatusOptions());
                $this->assign('topOptions', \wenshizhengxin\news\libs\Article::getTopOptions());

                if ($news['status'] ?? 0) { // 已经发布了，只能查看
                    $news['content'] = nl2br(str_replace(' ', '&nbsp;', htmlspecialchars($news['content'])));
                    $this->assign('news', $news);

                    $this->adminUiDisplay('article/detail');
                } else {
                    $this->adminUiDisplay();
                }
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
            $res = Db::name(Constant::TABLE_ARTICLE)->where('id', $id)->delete();
            if (!$res) {
                throw new \Exception('删除失败');
            }

            $this->success('删除成功', 'refresh');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function publish()
    {
        try {
            $id = Args::params('id/1');
            $timestamp = time();
            $res = Db::name(Constant::TABLE_ARTICLE)->where('id', $id)->update([
                'status' => Constant::STATUS_ACTIVE,
                'update_time' => $timestamp,
                'publish_time' => $timestamp,
            ]);
            if (!$res) {
                throw new \Exception('发布失败');
            }

            $this->success('发布成功', 'refresh');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function withdraw()
    {
        try {
            $id = Args::params('id/1');
            $timestamp = time();
            $res = Db::name(Constant::TABLE_ARTICLE)->where('id', $id)->update([
                'status' => Constant::STATUS_INACTIVE,
                'update_time' => $timestamp,
            ]);
            if (!$res) {
                throw new \Exception('撤回失败');
            }

            $this->success('撤回成功', 'refresh');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
