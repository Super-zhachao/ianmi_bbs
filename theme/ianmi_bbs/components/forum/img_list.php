<?php if (!empty($list['data'])) { ?>
<div class="list img_list">
    
<div class="list-group border-bottom">
<?php foreach ($list['data'] as $item) { ?>
    <?php $this->load('/components/forum/img_list_item', ['item' => $item]); ?>
<?php } ?>
</div>
</div>
<?php } ?>