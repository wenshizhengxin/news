<form role="form" class="epii" method="post" data-form="1" action="">

    <div class="form-group" id="group-classify_name">
        <label>名称：</label>
        <input type="text" class="form-control" name="classify_name" id="classify_name" placeholder="请输入名称" value="{$classify['classify_name'] ? ''}">
    </div>
    <div class="form-group" id="group-note">
        <label>备注：</label>
        <input type="text" class="form-control" name="note" id="note" placeholder="请输入备注" value="{$classify['note'] ? ''}">
    </div>
    <div class="form-group" id="group-sort">
        <label>排序：</label>
        <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入排序" value="{$classify['sort'] ? '1000'}">
    </div>
    <!-- <div class="form-group" id="group-pid">
        <label>父分类：</label>
        <input type="text" class="form-control" name="pid" id="pid" placeholder="请输入父分类" value="{$classify['pid'] ? ''}">
    </div>
    <div class="form-group" id="group-icon">
        <label>大图标：</label>
        <input type="text" class="form-control" name="icon" id="icon" placeholder="请输入大图标" value="{$classify['icon'] ? ''}">
    </div>
    <div class="form-group" id="group-icon2">
        <label>小图标：</label>
        <input type="text" class="form-control" name="icon2" id="icon2" placeholder="请输入小图标" value="{$classify['icon2'] ? ''}">
    </div>
    <div class="form-group" id="group-badge">
        <label>徽章样式：</label>
        <input type="text" class="form-control" name="badge" id="badge" placeholder="请输入徽章样式" value="{$classify['badge'] ? ''}">
    </div>
    <div class="form-group" id="group-badge_class">
        <label>徽章实现类：</label>
        <input type="text" class="form-control" name="badge_class" id="badge_class" placeholder="请输入徽章实现类" value="{$classify['badge_class'] ? ''}">
    </div> -->
    <div class="form-group" id="group-status">
        <label>状态：</label>
        <select class="selectpicker" name="status" id="status">{:options,$statusOptions,$classify['status']?'1'}</select>
    </div>
    <div class="form-footer">
        <input type="hidden" name="id" value="{$classify['id'] ? 0}">
        <button type="submit" class="btn btn-primary">提交</button>
    </div>
</form>