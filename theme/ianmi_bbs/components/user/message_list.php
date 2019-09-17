<?php if (empty($list['data'])) { ?>
    <div class="bbs_empty">这个地方空空如也！</div>
<?php } else { ?>
<div class="list">
<?php foreach ($list['data'] as $item) { ?>
    <div class="list-group friend_list message_list">
		<?php $this->load('components/user/message_item', [
            'user_id' => $item['user_id'],
            'content' => $item['content'],
            'status' => $item['status']
        ]); ?>
    </div>
<?php } ?>
<?php $this->load('/components/common/page_jump', ['page' => $list['page']]); ?>
</div>
<?php } ?>