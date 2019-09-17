<?php
/**
 * Created by PhpStorm.
 * User: lichao
 * Date: 2019/9/17
 * Time: 20:11
 */
?>
<?php
$setting = \comm\Setting::get(['theme']);
$theme = $setting['theme'] ?? 'default';
?>
<div class="house_nomore" style="border-top: 0px none;">
  <div class="nofind"><img src="/theme/<?=$theme?>/template/static/img/x11_nofind_list.png">
    <p><?=$desc?></p></div>
</div>
