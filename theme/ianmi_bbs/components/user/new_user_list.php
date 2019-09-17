<div class="flex-box">
    <?php foreach ($user_list as $item) { ?>
    <div class="flex">
    <a href="/user/show?id=<?=$item['id']?>" class="new_user_item">
        <img class="new_user_photo" src="<?=$item['photo']?>" alt="<?=$item['nickname']?>">
        <span class="new_user_nickname ellipsis"><?=$item['nickname']?></span>
    </a>
    </div>
    <?php } ?>
</div>