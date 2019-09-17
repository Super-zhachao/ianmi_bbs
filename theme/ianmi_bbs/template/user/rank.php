<?php useComp('components/common/header',['title' => '排行榜']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/index', 'title' => '首页']); ?>
<div class="rank_title">会员排行 Top20</div>
<div class="user_rank_box list">
<?php $user_list = source('/Model/User/rank'); ?>
<?php foreach ($user_list as $key => $item) { ?>
<div class="list-group list-arrow user_rank">
    <a href="/user/show/?id=<?=$item['id']?>" class="list-item list-item-image-text">
        <div class="rank_index"><?=$key + 1?></div>
        <div class="list-item-image">
            <img src="<?=$item['photo']?>" alt="">
            
            <div class="vip_icon vip_<?=$item['vip_level']?>">vip <?=$item['vip_level']?></div>
        </div>
        <div class="list-item-text">
            <div class="flex-box">
                <div class="nickname"><?=$item['nickname']?></div>
                <div class="user_lv">Lv.<?=$item['lv']['level']?></div>
                
                <div class="is_online is_online_<?=$item['is_online']?>">
                    <?=$item['is_online'] ? '在线' : '离线'?>
                </div>
            </div>
            <div class="explain">
                <?=$item['explain']?>
            </div>
        </div>
</a>
</div>
<?php } ?>
</div>
<?php useComp('components/common/footer'); ?>
