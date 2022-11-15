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
                                <label>名称：</label>
                                <input type="text" class="form-control" name="classify_name" placeholder="请输入名称">
                            </div>
                            <!-- <div class="form-group">
                                <label>父分类：</label>
                                <input type="text" class="form-control" name="pid" placeholder="请输入父分类">
                            </div> -->
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
        <a class="btn btn-outline-primary btn-table-tool btn-dialog" data-intop="1" data-area="50%,70%" title="新增" href="?app=classify@add&__addons={$addons}"><i class="fa fa-plus"></i>新增</a>
    </div>
    <div class="card-body table-responsive" style="padding-top: 0">
        <table data-table="1" data-url="?app=classify@ajax_data&mode={$mode ? ''}&__addons={$addons}" id="table1" class="table table-hover">
            <thead>
                <tr>

                    <th data-field="id">ID</th>
                    <th data-field="classify_name">名称</th>
                    <th data-field="sort">排序</th>
                    <!-- <th data-field="pid">父分类</th>
                    <th data-field="icon">大图标</th>
                    <th data-field="badge">徽章样式</th>
                    <th data-field="badge_class">徽章实现类</th> -->
                    <th data-field="status" data-formatter="epiiFormatter.switch">状态</th>
                    <?php if (($mode ?? '') == 1) { ?>
                        <th data-formatter="epiiFormatter.btns" data-btns="my_select">操作</th>
                    <?php } else { ?>
                        <th data-formatter="epiiFormatter.btns" data-intop="1" data-area="50%,70%" data-btns="edit,del" data-edit-url="?app=classify@add&id={id}&__addons={$addons}" data-edit-title="编辑" data-del-url="?app=classify@del&id={id}&__addons={$addons}" data-del-title="删除">操作</th>
                    <?php } ?>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script type="text/javascript">
    let classifies = [];
    let select = null;

    function example(field_value, row, index, field_name) {
        return '<a class="btn btn-outline-primary btn-sm btn-dialog" data-intop="1" data-area="50%,70%" title="编辑" href="?app=classify@add&id=' + row.id + '"><i class="fa fa-pencil"></i>编辑</a>';
    }

    function my_select(field_value, row, index, field_name) {
        classifies.push(row);
        return '<a class="btn btn-outline-primary btn-sm" title="选择" href="javascript:select(' + row.id + ')">选择</a>';
    }



    window.onEpiiInit(function() {
        select = function(id) {
            let x_row = null;
            classifies.forEach(function(row, i) {
                if (row.id == id) {
                    x_row = row;
                }
            });

            // console.log(x_row);
            if (x_row) {
                parent.classifies.add(x_row);
            }

            parent.layer.closeAll();
        }
    });
</script>