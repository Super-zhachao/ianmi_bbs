<?php if (empty($list['data'])) { ?>
    <div class="bbs_empty">这个地方空空如也！</div>
<?php } else { ?>
<div class="list bbs_list">
<?php foreach ($list['data'] as $item) { ?>
    <?php $this->load('/components/forum/list_item', ['item' => $item]); ?>
<?php } ?>
<?php $this->load('/components/common/page_jump', ['page' => $list['page']]); ?>
</div>
<?php } ?>