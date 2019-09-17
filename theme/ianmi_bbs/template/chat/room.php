<?php self::load('common/header',['title' => '聊天室']); ?>
<?php self::load('common/header_nav',['title' => '聊天室', 'back_url' => '/','message_count' => 0]); ?>
<script data-main="/static/js/chat/room.js?v=<?=$version?>" src="/static/js/require.js"></script>

<style media="screen">
    /* .user {
        margin: .3rem;
        margin-right: .5rem;
        width: 1.6rem;
        height: 1.6rem;
        background-image: url(/static/svg/gr.svg);
    } */
    .search {
        width: 1.6rem;
        height: 1.6rem;
        background-image: url(/static/svg/ss.svg);
    }
    .ss-input {
        margin-right: 0;
        height: 1.6rem;
        background-color: transparent;
    }
    .input-search {
        margin: .3rem;
        padding: 0;
        background-color: #eee;
        border-radius: .4rem;

    }
    .nickname-home
    {
        padding: 0 .8rem;
    }
    .show-box
    {
        display: block;
        margin: 10px;
        padding: 0 .8rem;
        line-height: 25px;
        border-radius: 3px;
        background: #444;
    }

    .chat-view
    {
        position: relative;
        padding: 10px;
        background: #FFFFFF;
    }
    .chat-view .chat-top
    {
        display: -webkit-flex;
        margin-left: 50px;
        /* background: #f0f0f0; */
    }

    .chat-top .chat-nickname
    {
        color: #05f;
        -webkit-flex: 1;
    }
    .chat-top .chat-addtime
    {
        color: #ddd;
        font-size: 12px;
    }
    .chat-top .chat-a
    {
        padding: 0 5px;
        color: #05f;
    }
    .chat-view .chat-content
    {

        /* background-color: #5FB878; */
        color: #fff;

        margin-left: 50px;
        padding: 5px;
        border-radius: 4px;
        position: relative;
        line-height: 22px;
        margin-top: 5px;
        /* background-color: #e2e2e2; */
        border-radius: 3px;
        color: #333;
        word-break: break-all;


    }

    /* .chat-view .chat-content:after {
        left: auto;
        right: -10px;
        border-top-color: #5FB878;
    }

    .chat-view .chat-content:after {
        content: '';
        position: absolute;
        left: -10px;
        top: 13px;
        width: 0;
        height: 0;
        border-style: solid dashed dashed;
        border-color: #e2e2e2 transparent transparent;
        overflow: hidden;
        border-width: 10px;
    } */

    .chat-view .chat-photo
    {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 40px;
        height: 40px;
        background-position: center center;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        overflow: hidden;
        border-radius: 50%;
    }
    .chat-input
    {
        position: fixed;
        z-index: 999;
        bottom: 0;
        width: 100%;
        background-color: #FFF;
        overflow: hidden;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
        /* box-shadow: 0 0 1px #ccc; */
    }

    .transition
    {
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
    }

    .chat-input .chat-input-top
    {
        display: -webkit-flex;
        padding: 8px 10px;
    }

    .chat-input .face{
        margin-left: 5px;
        margin-right: 10px;
        width: 30px;
        height: 30px;
        background-image: url(/static/svg/face.svg);
        background-position: center center;
        background-size: 90% 90%;
        background-repeat: no-repeat;
    }
    .chat-input input
    {
        -webkit-flex: 1;
        padding: 0 10px;
        border: 1px solid #eee;
        height: 30px;
        border-radius: 2px;
        background: #eee;
    }
    .chat-input button
    {
        margin-left: 5px;
        width: 80px;
        border: 1px solid #09f;
        color: #09f;
        border-radius: 2px;
        background: none;
    }

    .border-t
    {
        background-position: left top;
        /* background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0.5,transparent),color-stop(0.5,#e0e0e0),to(#e0e0e0)); */
    }

    .chat-face-box
    {
        height: 0;
    }
    .face-box
    {
        padding: 10px;
        overflow: hidden;
    }
    .face-box .face-out
    {
        float: left;
        width: 12.5%;
        text-align: center;
    }

    .face-box img
    {
        margin: 5px 0;
        width: 28px;
        height: 28px;
    }

    .flex-box
    {
        display: -webkit-flex;
    }
    .flex-1
    {
        -webkit-flex: 1;
    }
    .face-chat
    {
        width: 28px;
        height: 28px;
    }

    .user-explain {
        position: relative;
        color: rgb(148, 124, 124);
        padding-bottom: .2rem;
        padding-left: 2.5rem;
        text-align: right;
        font-size: .6rem;
    }
    .new_action {
        padding: .5rem;
        border-bottom: .2rem #eee solid;
    }
</style>
<div id="app-room" data-classid="<?=$classInfo['id']?>">
    <chat-list v-for="item of list" :item="item"></chat-list>
    <chat-send></chat-send>
</div>
<?php self::load('common/footer'); ?>
