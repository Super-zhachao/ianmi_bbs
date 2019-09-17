<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2019/9/15
 * Time: 21:31
 */
?>
<?php $column = source('Model/Category/getList'); ?>
<?php $sta_data = source('Model/IanmiBBS/getIndexStastic'); ?>

<div class="ianmi-category">
  <div class="wp">
    <ul class="ul-imgtxt1">
        <?php foreach ($column as $item) { ?>
          <li class="item">
            <a href="<?= href('/forum/list?id=' . $item['id']) ?>">
              <div class="pic" style="background:url('<?= $item['photo'] ?>') no-repeat 0 0/40px auto;"></div>
              <h3> <?= $item['title'] ?></h3>
            </a>
          </li>
        <?php } ?>
    </ul>
    <div class="bot">
      <div class="l">
        <span><em>总帖</em><?= $sta_data['total'] ?></span>
        <span><em>昨日</em><?= $sta_data['yesterday'] ?></span>
        <span><em>今日</em><?= $sta_data['today'] ?></span>
      </div>
      <div class="r">
        <span><em class="e2">浏览</em><?= $sta_data['read_count'] ?></span>
      </div>
    </div>
  </div>
</div>
