<?php if ($user_id == 0 || $user_id == $care_user_id) return; ?>

<?php if (source('/Model/Friend/isCare', [ 'user_id' => $user_id, 'care_user_id' => $care_user_id ])) { ?>
    <a href="#" data-user-id="<?=$care_user_id?>" class="flw btn-action-care">- 已关</a>
<?php } else { ?>
    <a href="#" data-user-id="<?=$care_user_id?>" class="flw btn-action-care">+ 关注</a>
<?php } ?>