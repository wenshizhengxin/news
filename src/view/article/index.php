<section class="content" style="padding: 10px">
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">搜索</h3>
                </div>
                <div class="card-body">
                    <form role="form" data-form="1" data-search-table-id="1" data-title="自定义标题">
                        <div class="form-inline">

                            <div class="form-group">
                                <label>标题：</label>
                                <input type="text" class="form-control" name="title" placeholder="请输入标题">
                            </div>
                            <div class="form-group">
                                <label>分类：</label>
                                <select name="classify_id" class="selectpicker">{:options,$classifyOptions}</select>
                            </div>
                            <div class="form-group" style="margin-left: 10px">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="content">
    <div class="card-body table-responsive" style="padding-top: 0">
        <a class="btn btn-outline-primary btn-table-tool btn-dialog" data-intop="1" data-area="50%,70%" title="新增" href="?app=article@add&__addons={$addons}"><i class="fa fa-plus"></i>新增</a>
    </div>
    <div class="card-body table-responsive" style="padding-top: 0">
        <table data-table="1" data-url="?app=article@ajax_data&__addons={$addons}" id="table1" class="table table-hover">
            <thead>
                <tr>

                    <th data-field="id">ID</th>
                    <th data-field="title_desc">标题</th>
                    <th data-field="author">作者</th>
                    <th data-field="classify_names">分类</th>
                    <!-- <th data-field="tag_names">标签</th> -->
                    <th data-field="status" data-formatter="epiiFormatter.switch">状态</th>
                    <!-- <th data-field="top_desc">是否置顶</th> -->
                    <th data-field="sort">排序</th>
                    <th data-field="views">浏览量</th>
                    <th data-formatter="epiiFormatter.btns" data-intop="1" data-area="50%,70%" data-btns="my_edit,my_publish,my_withdraw,my_del">操作
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    function example(field_value, row, index, field_name) {
        return '<a class="btn btn-outline-primary btn-sm btn-dialog" data-intop="1" data-area="50%,70%" title="编辑" href="?app=article@add&id=' + row.id + '"><i class="fa fa-pencil"></i>编辑</a>';
    }

    function my_edit(field_value, row, index, field_name) {
        if (row.status == <?php echo \wenshizhengxin\news\libs\Constant::STATUS_ACTIVE; ?>) {
            return '<a class="btn btn-outline-primary btn-sm btn-dialog" data-area="90%,90%" title="预览：' + row.title +
                '" href="?app=article@add&id=' + row.id + '&__addons={$addons}"><i class="fa fa-pencil"></i>预览</a>';
        }
        return '<a class="btn btn-outline-primary btn-sm btn-dialog" data-area="90%,90%" title="编辑：' + row.title +
            '" href="?app=article@add&id=' + row.id + '&__addons={$addons}"><i class="fa fa-pencil"></i>编辑</a>';
    }

    function my_publish(field_value, row, index, field_name) {
        if (row.status == <?php echo \wenshizhengxin\news\libs\Constant::STATUS_ACTIVE; ?>) {
            return '';
        }
        return '<a class="btn btn-outline-success btn-sm btn-confirm" data-ajax="1" data-area="50%,70%" title="发布：' + row.title +
            '" href="?app=article@publish&id=' + row.id + '&__addons={$addons}"><i class="fa fa-pencil"></i>发布</a>';
    }

    function my_withdraw(field_value, row, index, field_name) {
        if (row.status != <?php echo \wenshizhengxin\news\libs\Constant::STATUS_ACTIVE; ?>) {
            return '';
        }
        return '<a class="btn btn-outline-warning btn-sm btn-confirm" data-ajax="1" data-area="50%,70%" title="撤回：' + row.title +
            '" href="?app=article@withdraw&id=' + row.id + '&__addons={$addons}"><i class="fa fa-pencil"></i>撤回</a>';
    }

    function my_del(field_value, row, index, field_name) {
        return '<a class="btn btn-outline-danger btn-sm btn-confirm" data-ajax="1" data-area="50%,70%" title="删除：' + row.title +
            '" href="?app=article@del&id=' + row.id + '&__addons={$addons}"><i class="fa fa-trash"></i>删除</a>';
    }
</script>