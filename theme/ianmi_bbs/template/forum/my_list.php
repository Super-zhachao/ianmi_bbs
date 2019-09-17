<?php useComp('/components/common/header', ['title' => '我的发布']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/user/index', 'title' => '我的发布']); ?>

<?php $list = source('Model/Forum/getList', ['user_id' => $user['id']]); ?>

<?php if ($list->isEmpty()) { ?>
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
<?php useComp('/components/common/footer'); ?>