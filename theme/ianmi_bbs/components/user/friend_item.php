<a href="/user/show?id=<?=$userinfo['id']?>" class="list-item list-item-image-text border-b">
    <div class="list-item-image">
        <img src="<?=$userinfo['photo']?>" alt="">
    </div>
    <div class="list-item-text">
        <div class="nickname"><?=$userinfo['nickname']?></div>
        <div class="explain"><?=$userinfo['explain']?></div>
    </div>
    <?php $this->load('components/user/friend_item_care', ['user_id' => $userinfo['id']]); ?>
</a>