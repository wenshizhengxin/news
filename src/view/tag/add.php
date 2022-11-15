<form role="form" class="epii" method="post" data-form="1" action="">

    <div class="form-group" id="group-tag_name">
        <label>名称：</label>
        <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="请输入名称" value="{$tag['tag_name'] ? ''}">
    </div>
    <div class="form-group" id="group-status">
        <label>状态：</label>
        <select class="selectpicker" name="status" id="status">{:options,$statusOptions,$tag['status']?'1'}</select>
    </div>
    <div class="form-group" id="group-sort">
        <label>排序：</label>
        <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入排序" value="{$tag['sort'] ? '1000'}">
    </div>
    <div class="form-footer">
        <input type="hidden" name="id" value="{$tag['id'] ? 0}">
        <button type="submit" class="btn btn-primary">提交</button>
    </div>
</form>