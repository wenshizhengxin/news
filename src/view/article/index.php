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
                                <input type="text" class="form-control" name="classify_ids" placeholder="请输入分类">
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
        <a class="btn btn-outline-primary btn-table-tool btn-dialog" data-intop="1" data-area="50%,70%" title="新增" href="?app=news@add"><i class="fa fa-plus"></i>新增</a>
    </div>
    <div class="card-body table-responsive" style="padding-top: 0">
        <table data-table="1" data-url="?app=news@ajax_data" id="table1" class="table table-hover">
            <thead>
                <tr>

                    <th data-field="title">标题</th>
                    <th data-field="author">作者</th>
                    <th data-field="classify_ids">分类</th>
                    <th data-field="tag_ids">标签</th>
                    <th data-field="status">状态</th>
                    <th data-field="top">是否置顶</th>
                    <th data-field="sort">排序</th>
                    <th data-formatter="epiiFormatter.btns" data-intop="1" data-area="50%,70%" data-btns="edit,del" data-edit-url="?app=news@add&id={id}" data-edit-title="编辑" data-del-url="?app=news@del&id={id}" data-del-title="删除">操作
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    function example(field_value, row, index, field_name) {
        return '<a class="btn btn-outline-primary btn-sm btn-dialog" data-intop="1" data-area="50%,70%" title="编辑" href="?app=news@add&id=' + row.id + '"><i class="fa fa-pencil"></i>编辑</a>';
    }
</script>