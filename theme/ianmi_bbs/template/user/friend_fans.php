<?php useComp('components/common/user_header',['title' => '用户中心']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/index', 'title' => '首页']); ?>

<div class="tab ">
    <div class="tab-header">
        <a class="tab-link"  href="/user/friend_care">关注(<?=$care_list->total()?>)</a>
        <div class="tab-link tab-active">粉丝(<?=$fans_list->total()?>)</div>
    </div>
    <div class="tab-content">
            <div class="tab-page tab1 tab-active">
                <?php if ($fans_list->toArray()['total']== 0) {
                    useComp('/components/common/nofind', ['desc' => "哦！看来是人格魅力还差点哟！"]);
                } else { ?>
                <div class="list">
                <?php foreach ($fans_list as $item) { ?>
                    <?php if ($userinfo = source('Model/User/getAuthor', ['id' => $item['user_id']])) { ?>
                    <div class="list-group friend_list">
                        <a href="/user/show?id=<?=$userinfo['id']?>" class="list-item list-item-image-text border-b">
                            <div class="list-item-image">
                                <img src="<?=$userinfo['photo']?>" alt="">
                            </div>
                            <div class="list-item-text">
                                <div class="nickname"><?=$userinfo['nickname']?></div>
                                <div class="explain"><?=$userinfo['explain']?></div>
                            </div>
                            <?php $is_care = source('Model/Friend/isCare', ['user_id' => $user['id'], 'care_user_id' => $userinfo['id']]); ?>

                            <?php if ($is_care) { ?>
                                <button data-id="<?=$userinfo['id']?>" data-href="/user/care_user?id=<?=$userinfo['id']?>" class="btn btn-sm btn_care">已关注</button>
                            <?php } else { ?>
                                <button data-id="<?=$userinfo['id']?>" data-href="/user/care_user?id=<?=$userinfo['id']?>" class="btn btn-shadow btn-fill btn-sm btn_care">关注</button>
                            <?php } ?>
                        </a>
                    </div>
                    <?php } ?>
                <?php } ?>
                </div>
                <?=$fans_list->render()?>
                <?php } ?>
            </div>
            <div class="tab-page tab2">
            </div>
    </div>
</div>

<script type="text/javascript">
    var wait_time = 2;
    var care_time = $.now() - 1000 * wait_time;
    $('.btn_care').click(function() {
        var $this = $(this);
        var diff_time = wait_time - Math.ceil(($.now() - care_time) / 1000);
        if (diff_time > 0) {
            $.alert('请再等 ' + diff_time + ' 秒后操作');
            return false;
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
        return false;
    });
</script>

<?php useComp('components/common/footer'); ?>
