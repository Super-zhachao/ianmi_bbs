<a href="/forum/my_list?user_id=<?=$user_id?>" class="flex-box">
    <div><i class="li-box-svg icon-svg b_pingtu"></i></div>
    <div class="li-box-word">评论(<?=$reply_list['page']['count']?>)</div>
    <?php if ($reply_list['page']['count']) { ?>
    <div class="ellipsis more bbs_reply" data-forum-id="<?=$reply_list['data'][0]['forum_id']?>"><?=$reply_list['data'][0]['context']?></div>
    <?php } else { ?>
    <div class="ellipsis more bbs_reply" data-forum-id="0">还没有评论主题！</div>
    <?php } ?>
</a>