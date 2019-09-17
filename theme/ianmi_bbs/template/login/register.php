<?php useComp('components/common/header',['title' => '登陆网站']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/', 'title' => '新用户注册']); ?>
<div class="login-main">
    <form class="login" action="/login/register" method="post">
        <div class="login-item"><input class="input input-lg" type="text" name="username" placeholder="用户名"></div>
        <div class="login-item"><input class="input input-lg" type="password" name="password" placeholder="密码"></div>
        <div class="login-item"><input class="input input-lg" type="password" name="password2" placeholder="重复密码"></div>
        <div class="login-item"><input class="input input-lg" type="text" name="email" placeholder="邮箱"></div>
        <div class="login-item"><button class="btn btn-fill btn-block btn-lg">立即注册</button></div>
    </form>
</div>

<?php useComp('components/common/footer'); ?>
