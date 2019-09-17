<?php useComp('components/common/header',['title' => '登陆网站']); ?>
<?php useComp('/components/common/header_nav', ['back_url' => '/', 'title' => '用户登录']); ?>
<div class="login-main">
    <a class="logo" href="/">

    </a>
    <form class="login" action="/login/login" method="post">
        <div class="login-item">
            <input class="input input-lg" type="text" name="username" placeholder="用户名">
        </div>
        <div class="login-item">
            <input class="input input-lg" type="password" name="password" placeholder="密码">
        </div>
        <div class="login-item">
            <button class="btn btn-fill btn-block btn-lg">登陆</button>
        </div class="login-item">
        <div class="login-reg-nav">
            <a class="func-null">忘记密码</a>
            <a href="/login/register">立即注册</a>
        </div>
    </form>
</div>
<?php useComp('components/common/footer'); ?>
