<?php
$version = source('/comm/core/IamVersion/getVersion').'01';
$setting = \comm\Setting::get(['theme', 'login_reward', 'weblogo', 'webname', 'webname_after', 'keywords', 'description']);
$theme = $setting['theme'] ?? 'default';
$title = $title ?? $setting['webname'] ?? '安米社区';
$webname_after = $webname_after ?? $setting['webname_after'] ?? '-专注于手机网站建设';
$keywords = $keywords ?? $setting['keywords'] ?? '手机网站制作,手机建站,手机建站程序,wap建站程序,免费开源程序,安米程序,安米cms';
$description = $description ?? $setting['description'] ?? '安米手机建站程序，打造免费开源的纯移动端建站程序。';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="initial-scale=1.0,width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title><?= $title . $webname_after ?></title>
  <meta name="keywords" content="<?= $keywords ?>"/>
  <meta name="description" content="<?= $description ?>"/>
  <link rel="shortcut icon" href="favicon.ico?v=<?= $version ?>">
  <link rel="stylesheet" href="/theme/<?= $theme ?>/template/static/css/style.css?v=<?= $version ?>">
  <link rel="stylesheet" href="/theme/<?= $theme ?>/template/static/css/ianmi_bbs.css?v=<?= $version ?>">
  <script src="/theme/<?= $theme ?>/template/static/js/jquery.min.js?v=<?= $version ?>"></script>
  <script src="/theme/<?= $theme ?>/template/static/js/core.js?v=<?= $version ?>"></script>
  <script src="/theme/<?= $theme ?>/template/static/plugs/EasyLazyload/EasyLazyload.js?v=<?= $version ?>"></script>
  <script src="/static/ui/ui.js?v=<?= $version ?>"></script>
</head>
<body>
