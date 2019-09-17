<div class="list-care">
  <div class="user" style="position: relative">
    <img class="photo" src="<?= $item['author']['photo'] ?>" alt="">
    <div class="info">
      <div class="nickname"><?= $item['author']['nickname'] ?> </div>
      <span class="cate-item">#<?= $item->class_info['title'] ?>#</span>
      <div class="mark">
        <span><?= friendlyDateFormat($item['create_time']) ?></span>
      </div>
    </div>
  </div>
  <a class="text" href="/forum/view?id=<?= $item['id'] ?>">
    <div class="title">
        <?php if ($item['is_top'] == 1) { ?><span class='icon-text'><em class="ding">顶</em></span><?php } ?>
        <?php if ($item['is_cream'] == 1) { ?><span class='icon-text re'><em class="re">精</em></span><?php } ?>
      <!-- <?php if ($item['img_data'] != '') { ?><span class='forum_img'>图</span><?php } ?> -->
        <?php if ($item['file_data'] != '') { ?><span class='icon-text'><em>附</em></span><?php } ?>
        <?= $item['title'] ?></div>
    <div class="context"><?= $item['mini_context'] ?></div>
      <?php if (!empty($item['img_list'])) { ?>
        <div class="images">
            <?php for ($i = 0; $i < min(3, count($item['img_list'])); $i++) { ?>
              <div class="images_item">
                <img data-lazy-src="/forum/imagecropper?path=<?= ltrim($item['img_list'][$i]['path'], '/') ?>" alt="加载中...">
              </div>
            <?php } ?>
        </div>
      <?php } ?>
  </a>
    <?php if (count($item->markBody)) { ?>
      <div class="_list_mark">
          <?php foreach ($item->markBody as $_item) { ?>
            <div class="_item">
              <span class="_j">#</span>
              <a href="/forum/search?mark_id=<?= $_item['id'] ?>" class="_title"><?= $_item['title'] ?></a>
            </div>
          <?php } ?>
      </div>
    <?php } ?>
  <div class="count">
    <div class="reply">
      <i class="icon-svg svg-bbs_reply"></i>
        <?= $item['reply_count'] ?>
    </div>
    <div class="read">
      <i class="icon-svg svg-look"></i>
        <?= $item['read_count'] ?>
    </div>
  </div>
  <div class="hr"></div>
</div>