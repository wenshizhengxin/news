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
        <textarea rows="10" class="form-control" name="content" id="content" placeholder="请输入正文">{$news['content'] ? ''}</textarea>
    </div>
    <!-- <div class="form-group" id="logo" style="text-align: center; ">
        <label for="class">配图：</label>
        <div data-upload-preview="1" data-input-id="img" data-multiple="0" data-mimetype="pdf,jpg,png,jpeg,gif" data-maxcount="1" style="width: 70%; margin: 0 0"></div>
        <input type="hidden" name="img" id="img" value="{? $template['img']}" data-src="{? $template['img_url']}">
    </div> -->
    <div class="form-group" id="group-author">
        <label>作者：</label>
        <input type="text" class="form-control" name="author" id="author" placeholder="请输入作者" value="{$news['author'] ? ''}">
    </div>
    <div class="form-group" id="group-classify_ids">
        <label>分类：</label>
        <a class="btn btn-primary btn-sm btn-dialog" title="选择分类" href="?app=classify@index&mode=1&__addons={$addons}" data-area="70%,50%">添加分类</a>
        <input type="hidden" name="classify_ids" value="">
        <input type="hidden" name="classify_names" value="">
        <div id="classify_html"></div>
    </div>
    <div class="form-group" id="group-tag_ids">
        <label>标签：</label>
        <a class="btn btn-primary btn-sm btn-dialog" title="选择标签" href="?app=tag@index&mode=1&__addons={$addons}" data-area="70%,50%">添加标签</a>
        <input type="hidden" name="tag_ids" value="">
        <input type="hidden" name="tag_names" value="">
        <div id="tag_html"></div>
    </div>
    <!-- <div class="form-group" id="group-status">
        <label>状态：</label>
        <select name="status" class="selectpicker">{:options,$statusOptions,$news['status']?''}</select>
    </div> -->
    <!-- <div class="form-group" id="group-top">
        <label>是否置顶：</label>
        <select name="top" class="selectpicker">{:options,$topOptions,$news['top']?'0'}</select>
    </div> -->
    <div class="form-group" id="group-sort">
        <label>排序：</label>
        <input type="text" class="form-control" name="sort" id="sort" placeholder="请输入排序" value="{$news['sort'] ? '1000'}">
    </div>
    <div class="form-footer">
        <input type="hidden" name="id" value="{$news['id'] ? 0}">
        <button type="button" class="btn btn-primary" onclick="commit()">提交</button>
    </div>
</form>
<style>
    #classify_html a {
        color: red;
    }

    #tag_html a {
        color: red;
    }
</style>
<script>
    var classifies = null;
    var tags = null;

    window.onEpiiInit(function() {
        commit = function() {
            let classify_ids = [];
            let classify_names = [];
            let tag_ids = [];
            let tag_names = [];
            classifies.data.forEach(function(row, i) {
                classify_ids.push(row.id);
                classify_names.push(row.classify_name);
            });
            // console.log(author_ids);
            // console.log(author_names);
            $("input[name='classify_ids']").val(classify_ids.join(","));
            $("input[name='classify_names']").val(classify_names.join(","));

            tags.data.forEach(function(row, i) {
                tag_ids.push(row.id);
                tag_names.push(row.tag_name);
            });
            // console.log(author_ids);
            // console.log(author_names);
            $("input[name='tag_ids']").val(tag_ids.join(","));
            $("input[name='tag_names']").val(tag_names.join(","));

            $("form").submit();
        }

        classifies = {
            data: [],
            add: function(item) {
                let isNew = 1;
                this.data.forEach(function(row, i) {
                    if (row.id == item.id) {
                        isNew = 0;
                    }
                });
                if (isNew) {
                    this.data.push(item);
                }
                // console.log(this.data);
                this.render();
            },
            del: function(id) {
                for (let i = 0; i < this.data.length; i++) {
                    if (this.data[i].id == id) {
                        this.data.splice(i, 1);
                        break;
                    }
                }

                this.render();
            },
            render: function() {
                let html = '';
                if (this.data.length > 0) {

                    this.data.forEach(function(row, i) {
                        let temp = '<span>' + row.classify_name + '<a href="javascript:classifies.del(' + row.id + ')">删除</a></span>';
                        html += temp;
                    });

                }

                $("#classify_html").html(html);
            },
            init: function() {
                let d = <?php echo json_encode($classifies ?? [], JSON_UNESCAPED_UNICODE); ?>;
                if (d.length > 0) {
                    this.data = d;
                    this.render();
                }
            }
        };
        classifies.init();

        tags = {
            data: [],
            add: function(item) {
                let isNew = 1;
                this.data.forEach(function(row, i) {
                    if (row.id == item.id) {
                        isNew = 0;
                    }
                });
                if (isNew) {
                    this.data.push(item);
                }
                // console.log(this.data);
                this.render();
            },
            del: function(id) {
                for (let i = 0; i < this.data.length; i++) {
                    if (this.data[i].id == id) {
                        this.data.splice(i, 1);
                        break;
                    }
                }

                this.render();
            },
            render: function() {
                let html = '';
                if (this.data.length > 0) {

                    this.data.forEach(function(row, i) {
                        let temp = '<span>' + row.tag_name + '<a href="javascript:tags.del(' + row.id + ')">删除</a></span>';
                        html += temp;
                    });

                }

                $("#tag_html").html(html);
            },
            init: function() {
                let d = <?php echo json_encode($tags ?? [], JSON_UNESCAPED_UNICODE); ?>;
                if (d.length > 0) {
                    this.data = d;
                    this.render();
                }
            }
        };
        tags.init();
    });
</script>