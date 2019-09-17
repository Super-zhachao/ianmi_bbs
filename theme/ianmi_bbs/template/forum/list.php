<?php useComp('/components/common/header?title=' . $class_info['title'] . "-论坛中心"); ?>
<?php useComp('/components/common/header_nav', [
    'title' => $class_info['title']
]); ?>
<div class="bbas_action">
    <div class="create_time">发帖 <?=$list->total()?> 篇</div>
    <div class="create_time reply">有<?=$reply_count?>人评论</div>
    <!-- <a class="btn" href="/forum/add_page?class_id=<?=$class_info['id']?>" style="display:inline-block;">发帖</a> -->
</div>

<div class="bbs_order border-b">
    <div class="bbs_order_title">最近回复</div>
    <div>·</div>
</div>
<?php if ($list->total() == 0) { ?>
    <div class="bbs_empty">这个地方空空如也！</div>
<?php } else { ?>
    <div class="list bbs_list">
<?php foreach($list as $item) { ?>
    <?php useComp('/components/forum/list_img_text', ['item' => $item]); ?>
<?php } ?>
</div>

<!-- 分页 -->
<?=$list->render()?>
</div>
<?php } ?>
<?php self::load('common/footer'); ?>
