<?php useComp('/components/common/header', ['title' => '每日签到']); ?>
<?php useComp('/components/common/header_nav?title=每日签到' ); ?>
<div class="m_body">
    <div class="sign_input_box">
    <?php if (!$is_sign) { ?>
        <div class="sign_word flex-box">
            <div>
                <div class="feel feel_0">求好运</div>
            </div>
            <div>
                <div class="feel feel_1">开心</div>
            </div>
            <div>
                <div class="feel feel_2">难过</div>
            </div>
            <div>
                <div class="feel feel_3">元气</div>
            </div>
            <div>
                <div class="feel feel_4">难受</div>
            </div>
            <div>
                <div class="feel feel_5">努力</div>
            </div>
            <div>
                <div class="feel feel_6">划水</div>
            </div>
            <div>
                <div class="feel feel_7">奋斗</div>
            </div>
            <div>
                <div class="feel feel_8">大家好</div>
            </div>
            <div>
                <div class="feel feel_9">生气ing</div>
            </div>
        </div>
        <form class="input-search sign_input" action="/sign/sign" method="post">
            <input type="text" name="content" class="input" placeholder="我知道你想说点什么">
            <button class="btn btn-fill">签到</button>
        </form>
    <?php } else { ?>
        今日签到任务已完成！
    <?php } ?>
    </div>

    <div class="sign_log_box">
        <div class="nav_title">最新签到记录</div>
        <div class="list">
        <?php foreach ($list as $item) { ?>
            <div class="list-group">
                <div class="list-item flex-box border-t">
                    <div class="img_head">
                        <img src="<?=$item['user_info']['photo']?>" alt="">
                    </div>
                    <div class="flex">
                        <div class="sign_user_info"><span class="nickname"><?=$item['user_info']['nickname']?></span> <span class="user_lv">lv.<?=$item['user_info']['lv']['level']?></span> <span class="vip_icon vip_0">vip<?=$item['user_info']['vip_level']?></span> <span class="datatime"><?=$item['friendly_create_time']?></span></div>
                        <div class="sign_info_memo"> 
                            <div class="sign_text_info border-b"><?=$item['content']?></div>
                            <div class="sign_info">
                                <table class="sign_table">
                                    <tr>
                                        <th>天数</th>
                                        <th>基础</th>
                                        <th>连奖</th>
                                        <th>VIP</th>
                                        <th>随机</th>
                                        <th>暴击</th>
                                        <th>合计</th>
                                    </tr>
                                    <tr>
                                        <td><?=$item['time']?> 天</td>
                                        <td><?=$item['info']['coin'][0]?></td>
                                        <td><?=$item['info']['coin'][1]?></td>
                                        <td><?=$item['info']['coin'][2]?></td>
                                        <td><?=$item['info']['coin'][3]?></td>
                                        <td>X<?=$item['info']['mul']?></td>
                                        <td><?=$item['coin']?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>

    <div class="sign_info_box">
        <div class="nav_title">签到奖励说明</div>
        <div>
        不连续<u>第一次</u>奖励<b>1</b>，连续签到奖励<u>递加</u><b>1</b>，最大上限为<b>7</b><br>
        VIP奖励：v1奖<b>1</b> | v2奖<b>2</b> | v3奖<b>3</b> | v4奖<b>4</b> | v5奖<b>5</b><br>
        随机奖励：有一定的几率<u>额外</u>获得<b>1 - 20</b> 的金币奖励<br>
        暴击：有一定的几率产生<u>暴击</u>，获得<u>双倍</u>奖励<br>
        </div>
    </div>
</div>
<script>
    $('.sign_word .feel').click(function() {
        var $input = $('input[name=content]');
        $input.val($input.val() + $(this).text());
    });
    window.onpopstate=function() {
        var json = window.history.state;
        if (json.time) {
            window.location.reload();
        }
    }
    $('.sign_input').submit(function() {
        history.replaceState({time: new Date().getTime()}, null, window.location);
    });
</script>
<?php self::load('common/footer'); ?>
