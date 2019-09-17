<?php if ($is_care) { ?>
    <button data-id="<?=$user_id?>" data-href="/user/care_user?id=<?=$user_id?>&amp;back_url=<?=$get_url?>" class="btn btn-shadow btn-sm btn_care">已关注</button>
<?php } else { ?>
    <button data-id="<?=$user_id?>" data-href="/user/care_user?id=<?=$user_id?>&amp;back_url=<?=$get_url?>" class="btn btn-shadow btn-fill btn-sm btn_care">关注</button>
<?php } ?>