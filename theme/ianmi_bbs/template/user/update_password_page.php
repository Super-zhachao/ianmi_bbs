<?php useComp('components/common/user_header',['title' => '修改密码']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/user/index', 'title' => '个人中心']); ?>

<form id="add" class="box-padding" action="/user/update_password" method="post">

<div class="item-line item-lg">
    <div class="item-title">原密码</div>
    <div class="item-input"><input type="password" class="input input-line input-lg" name="password" placeholder="原密码"></div>
</div>

<div class="item-line item-lg">
    <div class="item-title">新密码</div>
    <div class="item-input"><input type="password" class="input input-line input-lg" name="password1" placeholder="新密码"></div>
</div>

<div class="item-line item-lg">
    <div class="item-title">确认密码</div>
    <div class="item-input"><input type="password" class="input input-line input-lg" name="password2" placeholder="确认密码"></div>
</div>

<p><button class="btn btn-fill btn-lg" style="width: 100%;">修改</button></p>
</form>
<script>
        $('#add').submit(function() {
        var $this = $(this)
        $.post($this.attr('action'), $this.serialize()).then(function(data) {
            if (data.err) {
                $.alert(data.msg);
            } else {
                location.href = '/login';
            }
        });
        return false;
    });
</script>
<?php useComp('components/common/footer'); ?>