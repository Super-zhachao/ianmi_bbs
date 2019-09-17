<?php useComp('/components/common/header', ['title' => '全部板块']); ?>
<?php useComp('/components/common/header_menu_nav?title=全部板块' ); ?>

<?php $column = source('Model/Category/getList'); ?>
<div class="list column_nav">
    <?php foreach ($column as $item) { ?>
        
    <div class="list-group list-arrow">
        <a class="list-item list-item-image-text" href="/forum/list?id=<?=$item['id']?>">
            <div class="list-item-image">
                <img class="column_photo" src="<?=$item['photo']?>" alt="<?=$item['title']?>">
            </div>
            <div class="list-item-text column_info">
                <div class="column_title"><?=$item['title']?></div>
                <div class="column_count">
                    总数: <?=$item->getTotal()?>
                </div>
            </div>
        </a>
    </div>
    <?php } ?>
</div>
<?php useComp('/components/common/footer_nav', ['index' => 1]); ?>

<?php useComp('components/common/footer'); ?>