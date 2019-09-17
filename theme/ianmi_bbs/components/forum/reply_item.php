    <div class="list-group">
        <div class="bbs_info">
            <div class="bbs_user"><img class="bbs_user_photo" src="<?=$item->author['photo']?>" alt=""><?=$item->author['nickname']?> </div>
            <div class="create_time">
                <?=$item['create_time']?>
            </div>
        </div>
        <div>
            <div class="reply_content">
            <a href="<?=href('/user/show?id=' . $item->forum_art->author['id']) ?>">@<?=$item->forum_art->author['nickname']?></a> <?=$item['context']?>
            </div>
            
            <div class="create_time">
                <a href="<?=href('/forum/view?id=' . $item->forum_id)?>" class="bbs_user">主题《<?=$item->forum_art->title?>》</a>
                <span class="bbs_replay_num"><i class="icon-svg svg-bbs_reply"></i> <?=$item->forum_art['reply_count']?> <i class="icon-svg svg-look"></i> <?=$item->forum_art['read_count']?></span>
            </div>
        </div>
    </div>
    <style>
        .list-group{background:#fff}
        .reply_content a{margin:5px 10px 5px 20px}
    </style>