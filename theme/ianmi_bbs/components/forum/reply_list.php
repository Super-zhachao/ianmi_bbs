<?php if ($list->isEmpty()) { ?>
    <?php useComp('/components/common/nofind', ['desc' => "暂无评论！"]); ?>
<?php } else { ?>
<div class="list bbs_list">
    <?php foreach ($list as $item) { ?>
    <?php useComp('/components/forum/reply_item', ['item' => $item]); ?>
    <?php } ?>
</div>
<?php } ?>
