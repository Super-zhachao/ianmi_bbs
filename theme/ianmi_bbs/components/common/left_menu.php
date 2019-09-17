<?php
    $theme = \comm\Setting::get('theme');
?>
<style>
.left_user_box .user-info {
    justify-content: center;
}
.left_user_box .info-box {
    align-items: center;
    margin-bottom: .5rem;
}
.left_user_box .user-photo {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
}
.left_user_box {
    border-bottom: .05rem solid #eee;
}
.left-menu-list-open {
  overflow: hidden;
}
.left-menu-list {
  position: fixed;
  left: 0;
  top: 50px;
  right: 0;
  bottom: 0;
  visibility: hidden;
  z-index: 100;
}
.left-menu-list .menu-list-body {
  position: absolute;
  left: 0;
  top: 0;
  width: 66%;
  margin-left: -66%;
  bottom: 0;
  z-index: 10011;
  overflow: auto;
  background: #FFF;
  -webkit-transition-duration: 400ms;
  transition-duration: 400ms;
}
.left-menu-list .modal-overlay {
  position: absolute;
}
.left-menu-list.left-menu-list-show {
  visibility: visible;
}
.left-menu-list.left-menu-list-show .menu-list-body {
  margin-left: 0;
}
.left-menu-list.left-menu-list-show .modal-overlay {
  visibility: visible;
  opacity: 1;
}

.modal-overlay {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  z-index: 10010;
  visibility: hidden;
  opacity: 0;
  -webkit-transition-duration: 400ms;
  transition-duration: 400ms;
}
.modal-overlay.modal-overlay-visible {
  visibility: visible;
  opacity: 1;
}
</style>
<div class="left-menu-list">
    <div class="modal-overlay"></div>
    <div class="menu-list-body">
        <div class="left_user_box border-b">
        <?php $user = source('comm/core/CommonPublic/getUserInfo'); ?>
        <?php if ($user['id'] > 0) { ?>
            <div class="user-info">
                <img class="user-photo photo" src="<?=$user['photo']?>" alt="">
            </div>
            
            <div class="info-box">
                <div class="user-nc">
                    <span><?=$user['nickname']?> <span class="vip_icon vip_0">vip <?=$user['vip_level']?></span></span>
                </div>
                <div class="user-ep">
                    <span class="user_lv">等级：<?=$user['level']?></span><span class="user_coin">金币: <?=$user['coin']?></span>
                </div>
            </div>
            <a class="fans_nav flex-box" href="/user/friend_care">
                <div class="fans_nav_link">
                    <div class="fans_nav_num"><?//=$care_count?></div>
                    <div>关注</div>
                </div>
                <div class="fans_nav_link border-l">
                    <div class="fans_nav_num"><?//=$fans_count?></div>
                    <div>粉丝</div>
                </div>
            </a>
        <?php } else { ?>
            <a href="<?=href('/login')?>">
                <div class="user-info">
                    <img class="user-photo photo" src="/static/images/empty-photo.png" alt="">
                </div>
                <div class="info-box">
                    <div class="user-nc">登录/注册</div>
                </div>
            </a>
        <?php } ?>
        </div>
<style>
    .search-bar {
        display: flex;
        padding: .5rem;
    }
    .searchbar-content {
        flex: 1;
    }
    .searchbar-cancel {
        display: none;
        padding: 0 .25rem;
        line-height: 1.5rem;
        color: #09f;
    }
    .search-form-input {
        border: none;
        line-height: 1.5rem;
        padding-left: 1.5rem;
        border-radius: 3px;
        background: #eeeeee url(/theme/<?=$theme?>/template/static/svg/icon_search.svg) .5rem 50% no-repeat;
        background-size: 1rem;
    }
</style>
<div class="search-bar">
    <div class="searchbar-content clearfix">
        <form action="<?=href('/forum/search')?>">
            <input type="search" name="keyword" id="title" class="input search-form-input" placeholder="搜一下">
        </form>
    </div>
    <div class="searchbar-cancel">取消</div>
</div>

        <div class="list">
            <div class="list-group list-arrow">
                <!-- <a href="/" class="list-item ellipsis">社区首页</a>
                <a href="/user/index" class="list-item ellipsis">个人中心</a>
                <a href="/user/friend" class="list-item ellipsis">我的好友</a> -->
                <!-- <div class="list-item ellipsis">消息列表</div>
                <div class="list-item ellipsis">论坛大厅</div> -->
                <?php $column = source('Model/Category/getList'); ?>
                <?php foreach ($column as $item) { ?>
                <a class="list-item ellipsis list-item-icon" href="<?=href('/forum/list?id=' . $item['id'])?>">
                    <img src="<?=$item['photo']?>" alt="<?=$item['title']?>">
                    <?=$item['title']?> [<?=$item->getTotal()?>]
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(".searchbar-content .search-form-input").focus(function(){
        $(".searchbar-content").addClass("focus");
        $(".searchbar-cancel").show();
    });
    $('.search-form-input').blur(function() {
        $(".searchbar-cancel").click();
    });
    $(".searchbar-cancel").click(function(){
        $(".searchbar-content").removeClass("focus");
        $(".searchbar-cancel").hide();
    });
</script>