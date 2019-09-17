<?php
    if (!source('comm/core/CommonPublic/isLogin')) {
        redirect('/login', ['back_url' => isset($get_url) ? $get_url : '']);
    }
    $this->use('/components/common/header', ['title' => $title]);
?>