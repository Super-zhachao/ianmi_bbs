<a href="/forum/my_list?user_id=<?=$user_id?>" class="flex-box">
    <div><i class="li-box-svg icon-svg b_shoubing"></i></div>
    <div class="li-box-word">帖子(<?=$bbs['page']['count']?>)</div>
    <?php if ($bbs['page']['count']) { ?>
    <div class="ellipsis more bbs_article" data-id="<?=$bbs['data'][0]['id']?>"><?=$bbs['data'][0]['title']?></div>
    <?php } else { ?>
    <div class="ellipsis more bbs_article" data-id="0">还没有发表主题！</div>
    <?php } ?>
</a>