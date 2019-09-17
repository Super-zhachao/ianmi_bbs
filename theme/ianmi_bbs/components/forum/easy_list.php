<?php if (!empty($list['data'])) { ?>
<div class="list simple_list">
    
<div class="list-group list-arrow border-bottom">
<?php foreach ($list['data'] as $item) { ?>
    <a href="/forum/view/?id=<?=$item['id']?>" class="list-item ellipsis">
        <?=$item['title']?>
    </a>
<?php } ?>
</div>
</div>
<?php } ?>