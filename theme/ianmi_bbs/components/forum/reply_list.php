<?php if ($list->isEmpty()) { ?>
    <div class="bbs_empty replay_empty">暂无评论！</div>
<?php } else { ?>
<div class="list bbs_list">
    <?php foreach ($list as $item) { ?>
    <?php useComp('/components/forum/reply_item', ['item' => $item]); ?>
    <?php } ?>
</div>
<?php } ?>
