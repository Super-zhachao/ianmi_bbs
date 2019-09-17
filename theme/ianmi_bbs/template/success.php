<?php useComp('components/common/header',['title' => '操作成功']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/', 'title' => '操作成功']); ?>

<div class="page-msg-box">
    <i class="icon-svg svg-true"></i>
    <?=$msg?>
</div>
<script>
    setTimeout(function(){
        <?php if (empty($url)) { ?>
            history.go(-1);
        <?php } else { ?>
            history.replaceState(null, null, "<?=$url?>");
            window.location.reload();
        <?php } ?>
    }, 1000);
</script>
<?php self::load('common/footer'); ?>
