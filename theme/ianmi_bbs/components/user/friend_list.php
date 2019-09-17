<?php if (empty($list['data'])) { ?>
    <div class="bbs_empty">这个地方空空如也！</div>
<?php } else { ?>
<div class="list">
<?php foreach ($list['data'] as $item) { ?>
    <div class="list-group friend_list">
		<?php
		$user_id = $item['user_id'];
		if ($is_fans_care == 'care') {
			$user_id = $item['care_user_id'];
		}
		$this->load('components/user/friend_item', ['user_id' => $user_id]);
		?>
    </div>
<?php } ?>
<?php $this->load('/components/common/page_jump', ['page' => $list['page']]); ?>
</div>
<?php } ?>