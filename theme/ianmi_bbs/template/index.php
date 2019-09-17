<?php useComp("/components/common/header" ); ?>
<?php useComp("/components/common/header_menu_nav?title=首页" ); ?>
<?php
	$version = source('/comm/core/IamVersion/getVersion');
	$setting = \comm\Setting::get(['theme', 'login_reward', 'weblogo', 'webname', 'webname_after', 'keywords', 'description']);
	$theme = $setting['theme'] ?? 'default';
?>
<?php
    $tp = \Iam\Request::get('tp', 1);
    if ($tp == 2) {
        $list = source('Model/Forum/getList', [
            'type' => 1
        ]);
    } elseif ($tp == 3) {
    
        $list = source('Model/Forum/getList', [
            'type' => 5
        ]);
    } elseif ($tp == 4) {
    
        $list = source('Model/Forum/getList', [
            'type' => 6
        ]);
    } elseif ($tp == 5) {
        $list = source('Model/Forum/getList', [
            'type' => 7
        ]);
    } else {
        $list = source('Model/Forum/getList', [
            'type' => 2
        ]);
    }

    // $forum = new \api\Sign;
    // $list = $forum->list();
    // print_r($list);die();
?>
<link rel="stylesheet" href="/theme/<?=$theme?>/template/static/plugs/slick/slick.css?v=<?=$version?>">
<div class="ianmi-slider">
  <div class="slider fade" id="ianmi_slider">
    <div><div class="image"><a href="javascript:;"><img class="slider-img" src="/static/image/20190723160357_345901.png"/><h3>这里是标题</h3></a></div></div>

    <div><div class="image"><a href="javascript:;"><img  class="slider-img" src="/static/image/20190723160607_119401.png"/><h3>这里是标题，这里是标题这里是标题，这里是标题</h3></a></div></div>
  </div>
</div>

<?php useComp("/components/index/category" ); ?>

<div class="_index_nav">
    <div <?=$tp == 1 ? 'class="_active"' : ''?>>
        <a href="/index/index?tp=1">推荐</a>
    </div>
    <div <?=$tp == 2 ? 'class="_active"' : ''?>>
        <a href="/index/index?tp=2">最新</a>
    </div>
    <div <?=$tp == 3 ? 'class="_active"' : ''?>>
        <a href="/index/index?tp=3">话题</a>
    </div>
    <div <?=$tp == 4 ? 'class="_active"' : ''?>>
        <a href="/index/index?tp=4">图片</a>
    </div>
    <div <?=$tp == 5 ? 'class="_active"' : ''?>>
        <a href="/index/index?tp=5">文件</a>
    </div>
</div>

<div class="list img_list">
<?php foreach($list as $item) { ?>
<?php useComp('/components/forum/list_care', ['item' => $item]); ?>
<?php } ?>
</div>
<?=$list->render([
    'tp' => $tp
])?>
<?=code('copyright')?>
<?php useComp('/components/common/footer_nav', ['index' => 0]); ?>
<script src="/theme/<?=$theme?>/template/static/plugs/slick/slick.min.js?v=<?=$version?>"></script>
<script type="text/javascript">
$(function(){
   $('#ianmi_slider').slick({
     dots: true
   });
});
</script>
<?php useComp('/components/common/footer'); ?>