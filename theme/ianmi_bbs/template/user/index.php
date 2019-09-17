<?php useComp('components/common/user_header',['title' => '用户中心']); ?>
<link rel="stylesheet" type="text/css" href="/static/css/cropper.min.css">

<script src="/static/js/cropper.min.js"></script>
<script src="/static/js/reszieimg.js"></script>

<style>
.select-photo-page {
    display: none;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999;
}
.select-photo {
    position: absolute;
    top: 45px;
    bottom: 0;
    left: 0;
    right: 0;
}
</style>
<?php useComp('/components/common/header_nav', ['back_url' => '/', 'title' => '个人中心']); ?>

<?php useComp('/components/common/left_menu'); ?>

    <div class="user-info border-b">
      <img class="user-photo photo" src="<?=$user['photo']?>" alt="">
      <div class="info-box">
        <div class="user-nc">
            <span><?=$user['nickname']?> <span class="vip_icon vip_0">vip <?=$user['vip_level']?></span><span class="user_lv">lv.<?=$user['level']?></span><span class="user_coin">金币: <?=$user['coin']?></span></span>
            
        </div>
        <div class="user-ep"><?=$user['explain']?></div>
        <div class="edit-info"><i class="icon-svg s_edit"></i>点击修改个人信息</div>
      </div>
    </div>
    
<a class="fans_nav flex-box" href="/user/friend_care">
    <div class="fans_nav_link">
        <div class="fans_nav_num"><?=$care_count?></div>
        <div>关注</div>
    </div>
    <div class="fans_nav_link border-l">
        <div class="fans_nav_num"><?=$fans_count?></div>
        <div>粉丝</div>
    </div>
</a>

<div class="change-info">

    <div class="li-box border-b message_line_item">
        <a href="/message" class="flex-box flex">
            <i class="li-box-svg icon-svg b_message"></i>
            <div class="li-box-word">消息通知</div>
        </a>
    </div>


    <div class="li-box border-b">
        <a href="/sign/index" class="flex-box flex">
            <i class="li-box-svg icon-svg b_qiandao"></i>
            <div class="li-box-word">签到</div>
            <div class="flex">
                <?php if ($user['is_today_sign']) { ?>
                <span class="word_right sign_status_ok">已完成</span>
                <?php } else { ?>
                <span class="word_right sign_status_no">未完成</span>
                <?php } ?>
            </div>
        </a>
    </div>

    <!-- 论坛统计 Begin -->
    <div class="li-box border-b">
        <a href="/forum/my_list?user_id=<?=$user['id']?>" class="flex-box">
            <div><i class="li-box-svg icon-svg b_shoubing"></i></div>
            <div class="li-box-word">帖子(<?=$forum_count?>)</div>
        </a>
    </div>
    <!-- 论坛统计 End -->

    <!-- 论坛评论统计 Begin -->
    <div class="li-box border-b">
        <a href="/forum/reply_art_list?reply_id=<?=$user['id']?>" class="flex-box">
            <div><i class="li-box-svg icon-svg b_pingtu"></i></div>
            <div class="li-box-word">评论(<?=$reply_count?>)</div>
        </a>
    </div>
    <!-- 论坛评论统计 End -->

    <!-- <div class="li-box border-b">
        <a href="/chat/room/?id=2" class="flex-box flex">

            <i class="li-box-svg icon-svg b_youxika"></i>
            <div class="li-box-word">聊天大厅</div>
        </a>
    </div> -->

    <div class="li-box border-b">
        <a href="/user/edit_page" class="flex-box flex">
            <i class="li-box-svg icon-svg b_mofang"></i>
            <div class="li-box-word">修改资料</div>
        </a>
    </div>
    <div class="li-box border-b">
        <a href="/user/update_password_page" class="flex-box flex">
            <i class="li-box-svg icon-svg b_puke"></i>
            <div class="li-box-word">修改密码</div>
        </a>
    </div>
    <div class="li-box border-b">
        <a href="/user/quit" class="flex-box flex">
            <i class="li-box-svg icon-svg b_shuiqiang"></i>
            <div class="li-box-word">退出</div>
        </a>
    </div>
</div>
<div class="select-photo-page">
    <div class="header-bar">
        <div class="header-item back-info">
            <i class="icon-svg svg-left"></i>
        </div>
        
        <div class="header-title">更换头像</div>
        
        <div class="header-item btn-save">
        保存
        </div>
    </div>
    <div class="select-photo">
        <img src="" alt="">
    </div>
</div>
<script type="text/javascript">
    var $file = $('<input type="file">');
    var cropper;
    var $img = $('.select-photo img');

    $file.localResizeIMG({
        maxSize: 90,
        error: function(msg) {
            $.alert(msg);
        },
        success: function(result, __this) {
            $('.select-photo-page').show();
            $img.attr('src', result.base64);
            cropper = new Cropper($img[0], {
                aspectRatio: 1/1
            })
        }
    });
    $('.photo').click(function() {
        var $this = $(this);
        $.confirm('从相册中选择', {
            'yes': function() {
                $file.click();
            }
        });
    });
    $('.back-info').click(function() {
        $('.select-photo-page').hide();
        // console.log(cropper.getImageData());
        cropper.destroy();
    });
    $('.btn-save').click(function() {
        $('.select-photo-page').hide();
        var base64 = cropper.getCroppedCanvas().toDataURL('image/png');
        $('.photo').attr('src', base64);
        $.post('/user/base64_upload', {'base64': base64}).then(function() {
            $.msg('更换成功');
        });
        cropper.destroy();
    });
    $('.edit-info').click(function() {
        location.href="/user/edit_page";
    });

    $('.bbs_article').click(function() {
        var id = $(this).data('id');
        if (id) {
            location.href = '/forum/view/?id=' + id;
        }
        return false;
    });

    $('.bbs_reply').click(function() {
        var id = $(this).data('forum-id');
        if (id) {
            location.href = '/forum/view/?id=' + id;
        }
        return false;
    });
</script>
<?php useComp('/components/common/footer_nav', ['index' => 4]); ?>
<?php useComp('components/common/footer'); ?>
