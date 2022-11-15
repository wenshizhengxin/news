<div class="content" style="width:100%;padding:2rem">
    <?php if ($news['top']) : ?>
        <a href="javascript:void(0)" class="badge bg-primary" style="float: right;">置顶</a>
    <?php endif; ?>
    <div class="content-header" style="text-align: center;">
        <h2>{$news['title']}</h2>
        <h4>{$news['sub_title']}</h4>
    </div>
    <div class="content-body" style="font-size:1.2rem">
        <div style="font-style:italic;margin-bottom:2rem; font-size:1rem;text-indent:2rem;">{$news['desc']}</div>
        <div style="text-indent: 2rem;"><?php echo $news['content']; ?></div>
    </div>
    <div>
        <div style="text-align: right;">——发布于<?php echo date('Y-m-d H:i', $news['publish_time']) ?></div>
    </div>
</div>