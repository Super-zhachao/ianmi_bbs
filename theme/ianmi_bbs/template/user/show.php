<?php useComp('components/common/header',['title' => '用户中心']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/index', 'title' => '首页']); ?>
<link rel="stylesheet" href="/static/js/dropload/dropload.css"/>

<script src="/static/js/dropload/dropload.js"></script>
<style>
    .tab .tab-content,
    .bbs_list.list .list-group {
        padding: 0;
    }
    .care_btn {
        margin-left: .25rem;
    }
</style>
<div class="user-info border-b">
    <img class="user-photo photo" src="<?=$userinfo['photo']?>" alt="">
    <div class="info-box">
        <div class="user-nc">
            <span><?=$userinfo['nickname']?> <span class="vip_icon vip_0">vip <?=$userinfo['vip_level']?></span><span class="user_lv">lv.<?=$userinfo['lv']['level']?></span></span>
            <?php if ($user['id'] != 0 && $user['id'] != $userinfo['id']) { ?>
            
            <span class="care_btn">
                <?php $is_care = source('Model/Friend/isCare', ['user_id' => $user['id'], 'care_user_id' => $userinfo['id']]); ?>

                <?php if ($is_care) { ?>
                    <button data-id="<?=$userinfo['id']?>" class="btn btn-sm btn_care">已关注</button>
                <?php } else { ?>
                    <button data-id="<?=$userinfo['id']?>" class="btn btn-shadow btn-fill btn-sm btn_care">关注</button>
                <?php } ?>
            </span>
            <?php } ?>
        </div>
        <div class="user-ep"><?=$userinfo['explain']?></div>
    </div>
</div>
<div class="tab ">
    <div class="tab-header">
        <div class="tab-link tab-active" data-to-tab=".tab1">动态</div>
        <div class="flex"></div>
    </div>
    <div class="tab-content">
            <div class="tab-page tab1 tab-active">
                <div class="forum_list_box list bbs_list" data-user-id="<?=$userinfo['id']?>">
                    <div class="list-group">

                    </div>
                </div>
            </div>
            <div class="tab-page tab2">
                <div class="forum_reply_box list">
                    <div class="list-group">

                    </div>
                </div>
            </div>
    </div>
</div>

<script type="text/javascript">
    var care_time = $.now() - 1000 * 5;
    $('.btn_care').click(function() {
        var $this = $(this);
        var diff_time = 5 - Math.ceil(($.now() - care_time) / 1000);
        if (diff_time > 0) {
            return $.alert('请再等 ' + diff_time + ' 秒后操作');
        }
        care_time = $.now();
        $.getJSON('/user/care_user', {id: $this.data('id')}).then(function(data) {
            if (data.err) {
                return $.alert(data.msg);
            }
            $.msg(data.msg);
            if (data.is_care) {
                $this.removeClass('btn-fill').text('已关注');
            } else {
                $this.addClass('btn-fill').text('关注');
            }
        });
    });

    var domUp = {
        domClass   : 'dropload-up',
        domRefresh : '<div class="dropload-refresh">↓下拉刷新</div>',
        domUpdate  : '<div class="dropload-update">↑释放更新</div>',
        domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
    }
    var domDown = {
        domClass   : 'dropload-down',
        domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
        domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
        domNoData  : '<div class="dropload-noData">暂无数据</div>'
    }

    var forum_next_page = 1;

    var itemTpl = function(value) {
        var item_tpl = `<div class="list-img">
            <a class="list-t-item" href="/forum/view?id=` + value.id + `">
                <div class="title">` + value.title + `</div>
                <div class="text-image flex-box">
                    <div class="flex context">` + value.mini_context + `</div>`;
                    
                    if (value.img_list.length > 0) {
                        item_tpl += `<img class="image" src="` + value.img_list[0].path + `" alt="加载中...">`
                    }
                item_tpl += `</div>
                <div class="user flex-box">
                    <span class="class_info_title">` + value.class_info.title + `</span>
                    <img class="photo" src="` + value.author.photo + `" alt="">
                    <div class="flex">` + value.author.nickname + ` · ` + value.reply_count + ` 评论</div>
                    <div class="create_time">` + getFriendlyTime(value.create_time) + `</div>
                </div>
            </a>
            <div class="hr"></div>
        </div>`
        return item_tpl;
    }

    $('.forum_list_box').dropload({
        scrollArea : window,
        domUp : domUp,
        domDown : domDown,
        loadUpFn : function(me){
            var $box = $('.forum_list_box');
            $.get('/forum/get_list_by_user_id', {user_id: $box.data('user-id'), page: 1}).then(function(data) {
                forum_next_page = Number(data.current_page) + 1;
                $box.find('.list-group').empty();
                for (var p in data.data) {
                    var value = data.data[p];
                    var item_tpl = itemTpl(value);

                    $box.find('.list-group').append(item_tpl);
                }
                // 每次数据插入，必须重置
                if (data.current_page >= data.last_page) {
                    me.noData(true);
                } else {
                    me.noData(false);
                }
                me.resetload();
            });
        },
        loadDownFn : function(me){
            var $box = $('.forum_list_box');
            $.get('/forum/get_list_by_user_id', {user_id: $box.data('user-id'), page: forum_next_page}).then(function(data) {
                forum_next_page = Number(data.current_page) + 1;
                for (var p in data.data) {
                    var value = data.data[p];
                    var item_tpl = itemTpl(value);
                    $box.find('.list-group').append(item_tpl);
                }
                // 每次数据插入，必须重置
                
                if (data.current_page >= data.last_page) {
                    me.noData(true);
                }
                me.resetload();
            });

        },
        threshold : 50
    });

/**
 * 获取指定时间的友好时间字符串。
 * @param str 指定的时间字符串，如yyyy-MM-dd HH:mm:ss
 * @param now 当前时间，允许时间戳，GMT时间，如果该参数为undefined，则使用浏览器时间。
 */
function getFriendlyTime(str, now){

    var currentTime = now ? new Date(now) : new Date();
    var arr = str.split(/\s+/gi);
    var temp = 0, arr1, arr2, oldTime, delta;
    var getIntValue = function(ss, defaultValue){
        try{
            return parseInt(ss, 10);
        }catch (e){
            return defaultValue;
        }
    };
    var getWidthString = function(num){
        return num < 10 ? ("0" + num) : num;
    };
    if(arr.length >= 2){
        arr1 = arr[0].split(/[\/\-]/gi);
        arr2 = arr[1].split(":");
        oldTime = new Date();
        oldTime.setYear(getIntValue(arr1[0], currentTime.getFullYear()));
        oldTime.setMonth(getIntValue(arr1[1], currentTime.getMonth() + 1) - 1);
        oldTime.setDate(getIntValue(arr1[2], currentTime.getDate()));

        oldTime.setHours(getIntValue(arr2[0], currentTime.getHours()));
        oldTime.setMinutes(getIntValue(arr2[1], currentTime.getMinutes()));
        oldTime.setSeconds(getIntValue(arr2[2], currentTime.getSeconds()));

        delta = currentTime.getTime() - oldTime.getTime();
        if(delta <= 6000){
            return "1分钟内";
        }
        else if(delta < 60 * 60 * 1000){
            return Math.floor(delta / (60 * 1000)) + "分钟前";
        }
        else if(delta < 24 * 60 * 60 * 1000){
            return Math.floor(delta / (60 * 60 * 1000)) + "小时前";
        }
        else if(delta < 3 * 24 * 60 * 60 * 1000){
            return Math.floor(delta / (24 * 60 * 60 * 1000)) + "天前";
        }
        else if(currentTime.getFullYear() != oldTime.getFullYear()){
            return [getWidthString(oldTime.getFullYear()), getWidthString(oldTime.getMonth() + 1), getWidthString(oldTime.getDate())].join("-")
        }
        else{
            return [getWidthString(oldTime.getMonth() + 1), getWidthString(oldTime.getDate())].join("-");
        }
    }
    return "";
}
</script>
<style>

.flex {
    text-align: left;
}
</style>
<?php useComp('components/common/footer'); ?>
