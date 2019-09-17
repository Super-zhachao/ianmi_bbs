<?php useComp('components/common/header',['title' => '错误提示']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/', 'title' => '错误提示']); ?>

<div class="page-msg-box">
    <i class="icon-svg svg-false"></i>
    <div class="page-msg-box false"><?=$msg?></div>
</div>
<script>
    setTimeout(function(){
        history.go(-1);
    }, 2000);
</script>
<?php self::load('common/footer'); ?>
