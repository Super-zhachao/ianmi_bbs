<?php useComp('/components/common/header', ['title' => '我的帖子']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/user/index', 'title' => '个人中心']); ?>
<?php $list = source('Model/ForumReply/replyList', ['reply_userid' => $user['id']]); ?>

<?php useComp('/components/forum/reply_list', ['list' => $list]); ?>
<!-- 分页 -->
<?=$list->render()?>
</div>
<?php useComp('/components/common/footer'); ?>