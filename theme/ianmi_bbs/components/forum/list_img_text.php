<div class="list-img">
    <a class="list-t-item" href="/forum/view?id=<?=$item['id']?>">
        <div class="title">
            <?php if($item['is_top'] == 1){?><span class='forum_top'>顶</span><?php }?>
            <?php if($item['is_cream'] == 1){?><span class='forum_cream'>精</span><?php }?>
            <!-- <?php if($item['img_data'] != ''){?><span class='forum_img'>图</span><?php }?> -->
            <?php if($item['file_data'] != ''){?><span class='forum_file'>附</span><?php }?>
            <?=$item['title']?>
        </div>
        <div class="text-image flex-box">
            <div class="flex context"><?=$item['mini_context']?></div>
            <?php if (!empty($item['img_list'])) { ?>
                <img class="image" src="/forum/imagecropper?path=<?=ltrim($item['img_list'][0]['path'], '/')?>" alt="加载中...">
            <?php } ?>
        </div>
        <div class="user flex-box">
            <span class="class_info_title"><?=$item->class_info['title']?></span>
            <img class="photo" src="<?=$item['author']['photo']?>" alt="">
            <div class="flex"><?=$item['author']['nickname']?> · <?=$item['reply_count']?> 评论</div>
            <div class="create_time"><?=friendlyDateFormat($item['create_time'])?></div>
        </div>
    </a>
    <div class="hr"></div>
</div>