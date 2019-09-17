<div class="reply_body">
    <div class="reply_input border-t">
        <form class="reply_index" action="/forum/reply_add?forum_id=<?=$forum_id?>&amp;back_url=<?=$get_url?>" method="post">
            <div class="icon-svg input_face"></div>
            <input class="input_show input" name="context">
            <button class="btn btn_reply">回复</button>
        </form>
        <div class="chat-face-box transition" style="height: 0;">
            <div class="face-box">
            <span class="face-out"><img data-img="爱你"  src="/static/images/face/aini.gif" alt="爱你"></span>
        <span class="face-out"><img data-img="抱抱"  src="/static/images/face/baobao.gif" alt="抱抱"></span>
        <span class="face-out"><img data-img="不活了"  src="/static/images/face/buhuole.gif" alt="不活了"></span>
        <span class="face-out"><img data-img="不要"  src="/static/images/face/buyao.gif" alt="不要"></span>
        <span class="face-out"><img data-img="超人"  src="/static/images/face/chaoren.gif" alt="超人"></span>
        <span class="face-out"><img data-img="大哭"  src="/static/images/face/daku.gif" alt="大哭"></span>
        <span class="face-out"><img data-img="嗯嗯"  src="/static/images/face/enen.gif" alt="嗯嗯"></span>
        <span class="face-out"><img data-img="发呆"  src="/static/images/face/fadai.gif" alt="发呆"></span>
        <span class="face-out"><img data-img="飞呀"  src="/static/images/face/feiya.gif" alt="飞呀"></span>
        <span class="face-out"><img data-img="奋斗"  src="/static/images/face/fendou.gif" alt="奋斗"></span>
        <span class="face-out"><img data-img="尴尬"  src="/static/images/face/ganga.gif" alt="尴尬"></span>
        <span class="face-out"><img data-img="感动"  src="/static/images/face/gandong.gif" alt="感动"></span>
        <span class="face-out"><img data-img="害羞"  src="/static/images/face/haixiu.gif" alt="害羞"></span>
        <span class="face-out"><img data-img="嘿咻"  src="/static/images/face/heixiu.gif" alt="嘿咻"></span>
        <span class="face-out"><img data-img="画圈圈"  src="/static/images/face/huaquanquan.gif" alt="画圈圈"></span>
        <span class="face-out"><img data-img="惊吓"  src="/static/images/face/jinxia.gif" alt="惊吓"></span>
        <span class="face-out"><img data-img="敬礼"  src="/static/images/face/jingli.gif" alt="敬礼"></span>
        <span class="face-out"><img data-img="快跑"  src="/static/images/face/kuaipao.gif" alt="快跑"></span>
        <span class="face-out"><img data-img="路过"  src="/static/images/face/luguo.gif" alt="路过"></span>
        <span class="face-out"><img data-img="抢劫"  src="/static/images/face/qiangjie.gif" alt="抢劫"></span>
        <span class="face-out"><img data-img="杀气"  src="/static/images/face/shaqi.gif" alt="杀气"></span>
        <span class="face-out"><img data-img="上吊"  src="/static/images/face/shangdiao.gif" alt="上吊"></span>
        <span class="face-out"><img data-img="调戏"  src="/static/images/face/tiaoxi.gif" alt="调戏"></span>
        <span class="face-out"><img data-img="跳舞"  src="/static/images/face/tiaowu.gif" alt="跳舞"></span>
        <span class="face-out"><img data-img="万岁"  src="/static/images/face/wanshui.gif" alt="万岁"></span>
        <span class="face-out"><img data-img="我走了"  src="/static/images/face/wozoule.gif" alt="我走了"></span>
        <span class="face-out"><img data-img="喜欢"  src="/static/images/face/xihuan.gif" alt="喜欢"></span>
        <span class="face-out"><img data-img="吓死人"  src="/static/images/face/xiasiren.gif" alt="吓死人"></span>
        <span class="face-out"><img data-img="嚣张"  src="/static/images/face/xiaozhang.gif" alt="嚣张"></span>
        <span class="face-out"><img data-img="疑问"  src="/static/images/face/yiwen.gif" alt="疑问"></span>
        <span class="face-out"><img data-img="做操"  src="/static/images/face/zuocao.gif" alt="做操"></span>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $('.input_face').click(function() {
        $('.chat-face-box').height($('.chat-face-box').height() == 0 ? $('.face-box').innerHeight() : 0);
    });
    $('.face-box .face-out img').click(function() {
        var img_tag = $(this).data('img');
        var face_code = '[表情:' + img_tag + ']';
        $('.input_show').val($('.input_show').val() + face_code);
    });
});

</script>