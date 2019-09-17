<script type="text/javascript">
    <?php
    $setting = \comm\Setting::get(['theme']);
    $theme = $setting['theme'] ?? 'default'; ?>
    $(function () {
      //  图片懒加载
      lazyLoadInit({
//        coverColor: "#FFF1CE",
//        coverDiv: "<img class='loading-gif' src='/theme/<?//= $theme ?>///template/static/img/load.gif' alt='加载中...'/>",
        offsetBottom: 200,
        offsetTopm: 200
//        showTime: 500
      });
    });
</script>
</body>
</html>