<form role="form" class="epii" method="post" data-form="1" action="">

    <div class="form-group" id="group-title">
        <label>标题：</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="请输入标题" value="{$news['title'] ? ''}">
    </div>
    <div class="form-group" id="group-sub_title">
        <label>副标题：</label>
        <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="请输入副标题" value="{$news['sub_title'] ? ''}">
    </div>
    <div class="form-group" id="group-desc">
        <label>描述：</label>
        <input type="text" class="form-control" name="desc" id="desc" placeholder="请输入描述" value="{$news['desc'] ? ''}">
    </div>
    <div class="form-group" id="group-content">
        <label>正文：</label>
        <textarea rows="5" class="form-control" name="content" id="content" placeholder="请输入正文">{$news['content'] ? ''}</textarea>
    </div>
    <div class="form-group" id="group-images">
        <label>配图：</label>
        <input type="text" class="form-control" name="images" id="images" placeholder="请输入配图" value="{$news['images'] ? ''}">
    </div>
    <div class="form-group" id="group-author">
        <label>作者：</label>
        <input type="text" class="form-control" name="author" id="author" placeholder="请输入作者" value="{$news['author'] ? ''}">
    </div>
    <div class="form-group" id="group-classify_ids">
        <label>分类：</label>
        <input type="text" class="form-control" name="classify_ids" id="classify_ids" placeholder="请输入分类" value="{$news['classify_ids'] ? ''}">
    </div>
    <div class="form-group" id="group-tag_ids">
        <label>标签：</label>
        <input type="text" class="form-control" name="tag_ids" id="tag_ids" placeholder="请输入标签" value="{$news['tag_ids'] ? ''}">
    </div>
    <div class="form-group" id="group-status">
        <label>状态：</label>
        <input type="text" class="form-control" name="status" id="status" placeholder="请输入状态" value="{$news['status'] ? ''}">
    </div>
    <div class="form-group" id="group-top">
        <label>是否置顶：</label>
        <input type="text" class="form-control" name="top" id="top" placeholder="请输入是否置顶" value="{$news['top'] ? ''}">
    </div>
    <div class="form-group" id="group-sort">
        <label>排序：</label>
        <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入排序" value="{$news['sort'] ? ''}">
    </div>
    <div class="form-footer">
        <input type="hidden" name="id" value="{$news['id'] ? 0}">
        <button type="submit" class="btn btn-primary">提交</button>
    </div>
</form>