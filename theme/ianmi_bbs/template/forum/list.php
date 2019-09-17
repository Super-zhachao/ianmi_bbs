<?php useComp('/components/common/header?title=' . $class_info['title'] . "-论坛中心"); ?>
<?php useComp('/components/common/header_nav', [
    'title' => $class_info['title']
]); ?>
<?php $sta_data = source('Model/IanmiBBS/getIndexStastic'); ?>
<div class="sys_right_fixed">
  <ul>
    <li class="fare"><a href="/forum/add_page"><div class="ico"></div></a></li>
    <li class="retop"><div class="ico" id="retop"></div></li>
  </ul>
</div>
<div class="_index_nav">
  <div class="_active">
    <a href="#">最近</a>
  </div>
  <div>
    <a href="#">最新</a>
  </div>
  <div>
    <a href="#">话题</a>
  </div>
  <div>
    <a href="#">图片</a>
  </div>
  <div>
    <a href="#">文件</a>
  </div>
</div>

<?php if ($list->total() == 0) { ?>
    <?php useComp('/components/common/nofind', ['desc' => "这个地方空空如也"]); ?>
<?php } else { ?>
    <div class="list bbs_list">
<?php foreach($list as $item) { ?>
<!--    --><?php //useComp('/components/forum/list_img_text', ['item' => $item]); ?>
    <?php useComp('/components/forum/list_care', ['item' => $item]); ?>
<?php } ?>
</div>

<!-- 分页 -->
<?=$list->render()?>
</div>
<?php } ?>
<?php useComp('/components/common/footer'); ?>
