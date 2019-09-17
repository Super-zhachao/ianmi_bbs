<div class="list-item list-item-image-text border-b">
    <div class="list-item-image">
        <img src="<?=$userinfo['photo']?>" alt="">
    </div>
    <div class="list-item-text">
        <div class="nickname"><?=$userinfo['nickname']?></div>
        <div class="explain"><?=$content?></div>
    </div>
    <?php if (!$status) { ?>
    <span class="new_message">新</span>
    <?php } ?>
</div>