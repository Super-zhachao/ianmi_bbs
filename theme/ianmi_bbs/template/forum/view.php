<?php useComp('/components/common/header', [
    'title' => !empty($forum['title']) ? $forum['title'] : '查看内容',
    // 'keywords' => implode($forum['keywords'], ','),
    // 'description' => mb_substr($forum['strip_tags_context'], 0, 100)
]); ?>
  <script src="/static/js/iamEditor.min.js?v=<?= $version ?>"></script>
  <style>
    body {
      background: #FFF;
    }

    .read_count {
      margin-right: 5px;
      color: #897777;
    }

    /* .create_time{line-height: 25px;} */
  </style>
<?php useComp('/components/common/header_nav', ['title' => '帖子详情']); ?>
<?php if ($forum_reply->currentPage() == 1) { ?>
  <div class="content-main" style="padding: 0 10px">
    <div class="view_head border-b">
      <div class="view_title">
          <?= $forum['title'] ?>
      </div>
      <div class="info">
        <div class="ll clearfix">
          <div class="rr"><a class="view_info_item"
                             href="<?= href('/forum/list?id=' . $forum->class_id) ?>">#<?= $forum->class_info['title'] ?>
              #</a>
          </div>
          <span><?= $forum['read_count'] + 1 ?>阅读</span>
          <span><?= $forum_reply->total() ?>回复</span>
          <span><font class="date"><?= friendlyDateFormat($forum->create_time) ?></font></span>
        </div>
      </div>

        <?php if ($forum['user_id'] == $user['id'] || $forum['is_admin']) { ?>
          <div class="view_action">
            <a class="btn" href="/forum/edit_page?id=<?= $forum['id'] ?>">修改</a>
            <a class="btn btn_remove" data-id="<?= $forum['id'] ?>">删除</a>
              <?php if ($forum['is_admin']) { ?>

                <a class="btn" href="/forum/top_cream_way?id=<?= $forum['id'] ?>">
                    <?php if ($forum['is_top']) { ?>
                      取消置顶
                    <?php } else { ?>
                      置顶
                    <?php } ?>
                </a>

                <a class="btn" href="/forum/top_cream_way?id=<?= $forum['id'] ?>&way=cream">
                    <?php if ($forum['is_cream']) { ?>
                      取消加精
                    <?php } else { ?>
                      加精
                    <?php } ?>
                </a>

              <?php } ?>
          </div>
        <?php } ?>
      <div class="view_user_info">
        <div class="top">
          <div class="con">
            <div class="pic"><a href="<?= href('/user/show?id=' . $forum->author['id']) ?>"><img
                  src="<?= $forum->author['photo'] ?>" alt=""></a></div>
            <div class="rr">
              <h3><a href="<?= href('/user/show?id=' . $forum->author['id']) ?>"> <?= $forum->author['nickname'] ?><span
                    class="bbs-vip"><i></i>VIP<?= $forum->author['vip_level'] ?></span><em>楼主</em></a></h3>
              <p><font class="date2"><?= $fans_count ?>粉丝</font></p>
            </div>
          </div>
          <!-- 关注按钮-Begin -->
            <?php useComp('/components/user/care_button', ['user_id' => $user['id'], 'care_user_id' => $forum->author['id']]); ?>
          <!-- 关注按钮-End -->
        </div>
      </div>


      <div class="view_context_cus">
          <?= $forum['context'] ?>
      </div>
        <?php if (!empty($forum['file_list'])) { ?>
          <div class="view_context_file box_card">
            <div class="box_title">共有附件(<?= count($forum['file_list']) ?>)个</div>
            <div class="box_content">
                <?php foreach ($forum['file_list'] as $key => $value) { ?>
                  <div class="forum_file_list">
                    <div class="forum_down_name"><?= $value['name'] ?></div>
                    <a class="forum_down_link" href="<?= $value['path'] ?>">点击下载(<?= $value['format_size'] ?>)</a>
                  </div>
                <?php } ?>
            </div>
          </div>
        <?php } ?>
        <?php if (!empty($forum->mark_body)) { ?>
          <div class="view_mark">
            话题标签：
              <?php foreach ($forum->mark_body as $item) { ?>
                <a href="/forum/search?mark_id=<?= $item['id'] ?>" class="mark-item"><?= $item['title'] ?></a>
              <?php } ?>
          </div>
        <?php } ?>
    </div>
    <!-- 代码自定义 BEGIN -->
      <?= code('ad_forum') ?>
    <!-- 代码自定义 END -->
      <?php } ?>
    <div class="replay_box">
      <div class="replay_title border-b">全部回复 <?= $forum_reply->total() ?> 条</div>

        <?php if (empty($forum_reply)) { ?>
          <div class="bbs_empty replay_empty">暂无评论！</div>
        <?php } else { ?>
          <div class="list bbs_list">
              <?php foreach ($forum_reply as $index => $item) { ?>
                <div class="list-group">
                  <div class="bbs_info">
                    <div class="bbs_user">
                      <a href="<?= href('/user/show?id=' . $item->author['id']) ?>">
                        <img class="bbs_user_photo" src="<?= $item->author['photo'] ?>" alt="">
                      </a>
                      <div class="user_lou_info">
                        <div>
                          <a href="<?= href('/user/show?id=' . $item->author['id']) ?>">
                              <?= $item->author['nickname'] ?>
                          </a>
                          <button class="btn btn-sm btn_alt_user" data-user-id="<?= $item->author['id'] ?>"
                                  data-nickname="<?= $item->author['nickname'] ?>">@Ta
                          </button>
                        </div>
                        <div
                          class="create_time"><?= (($forum_reply->currentPage() - 1) * $forum_reply->listRows()) + $index + 1 ?>
                          楼 <?= friendlyDateFormat($item['create_time']) ?></div>
                      </div>
                      <!-- 关注按钮-Begin -->
                        <?php useComp('/components/user/care_button', ['user_id' => $user['id'], 'care_user_id' => $item->author['id']]); ?>
                      <!-- 关注按钮-End -->
                    </div>
                  </div>
                  <div class="list-item">
                      <?= $item['context'] ?>
                  </div>
                </div>
              <?php } ?>
              <?= $forum_reply->render() ?>
          </div>
        <?php } ?>
      <div class="reply_body">
        <div class="reply_input border-t">
          <form class="reply_index" action="/forum/reply_add?id=<?= $forum['id'] ?>" method="post">
            <div class="icon-svg input_face"></div>
            <div class="input_show input"></div>
            <input type="hidden" name="context">
            <button class="btn btn_reply">回复</button>
          </form>
          <div class="chat-face-box transition" style="height: 0;">
            <div class="face-box">
              <span class="face-out"><img data-img="爱你" src="/static/images/face/aini.gif" alt="爱你"></span>
              <span class="face-out"><img data-img="抱抱" src="/static/images/face/baobao.gif" alt="抱抱"></span>
              <span class="face-out"><img data-img="不活了" src="/static/images/face/buhuole.gif" alt="不活了"></span>
              <span class="face-out"><img data-img="不要" src="/static/images/face/buyao.gif" alt="不要"></span>
              <span class="face-out"><img data-img="超人" src="/static/images/face/chaoren.gif" alt="超人"></span>
              <span class="face-out"><img data-img="大哭" src="/static/images/face/daku.gif" alt="大哭"></span>
              <span class="face-out"><img data-img="嗯嗯" src="/static/images/face/enen.gif" alt="嗯嗯"></span>
              <span class="face-out"><img data-img="发呆" src="/static/images/face/fadai.gif" alt="发呆"></span>
              <span class="face-out"><img data-img="飞呀" src="/static/images/face/feiya.gif" alt="飞呀"></span>
              <span class="face-out"><img data-img="奋斗" src="/static/images/face/fendou.gif" alt="奋斗"></span>
              <span class="face-out"><img data-img="尴尬" src="/static/images/face/ganga.gif" alt="尴尬"></span>
              <span class="face-out"><img data-img="感动" src="/static/images/face/gandong.gif" alt="感动"></span>
              <span class="face-out"><img data-img="害羞" src="/static/images/face/haixiu.gif" alt="害羞"></span>
              <span class="face-out"><img data-img="嘿咻" src="/static/images/face/heixiu.gif" alt="嘿咻"></span>
              <span class="face-out"><img data-img="画圈圈" src="/static/images/face/huaquanquan.gif" alt="画圈圈"></span>
              <span class="face-out"><img data-img="惊吓" src="/static/images/face/jinxia.gif" alt="惊吓"></span>
              <span class="face-out"><img data-img="敬礼" src="/static/images/face/jingli.gif" alt="敬礼"></span>
              <span class="face-out"><img data-img="快跑" src="/static/images/face/kuaipao.gif" alt="快跑"></span>
              <span class="face-out"><img data-img="路过" src="/static/images/face/luguo.gif" alt="路过"></span>
              <span class="face-out"><img data-img="抢劫" src="/static/images/face/qiangjie.gif" alt="抢劫"></span>
              <span class="face-out"><img data-img="杀气" src="/static/images/face/shaqi.gif" alt="杀气"></span>
              <span class="face-out"><img data-img="上吊" src="/static/images/face/shangdiao.gif" alt="上吊"></span>
              <span class="face-out"><img data-img="调戏" src="/static/images/face/tiaoxi.gif" alt="调戏"></span>
              <span class="face-out"><img data-img="跳舞" src="/static/images/face/tiaowu.gif" alt="跳舞"></span>
              <span class="face-out"><img data-img="万岁" src="/static/images/face/wanshui.gif" alt="万岁"></span>
              <span class="face-out"><img data-img="我走了" src="/static/images/face/wozoule.gif" alt="我走了"></span>
              <span class="face-out"><img data-img="喜欢" src="/static/images/face/xihuan.gif" alt="喜欢"></span>
              <span class="face-out"><img data-img="吓死人" src="/static/images/face/xiasiren.gif" alt="吓死人"></span>
              <span class="face-out"><img data-img="嚣张" src="/static/images/face/xiaozhang.gif" alt="嚣张"></span>
              <span class="face-out"><img data-img="疑问" src="/static/images/face/yiwen.gif" alt="疑问"></span>
              <span class="face-out"><img data-img="做操" src="/static/images/face/zuocao.gif" alt="做操"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(function () {
        var iamEditor = new IamEditor();
        iamEditor.getBox(document.querySelector('.input_show'));
        // var alt = document.querySelector('.a_btn');
        // var btn_img = document.querySelector('.a_btn_img');
        // alt.addEventListener('click', function(event) {
        //     iamEditor.insertHTML('<b data-code="[@:123456]" class="alt_user" unit="true">@' + this.dataset.nickname + '</b>');
        // });
        // btn_img.addEventListener('click', function(event) {
        //     iamEditor.insertHTML('<img data-code="[表情:抱抱]" src="http://ianmi.com/upload/column/20180909234237_202.png"/>');
        // });

        $('.btn_remove').click(function () {
          var id = $(this).data('id');
          $.confirm('确定删除该帖子？', {
            yes: function () {
              $.getJSON('/forum/ajax_remove', {id: id}).then(function (data) {
                $.msg('删除成功');
                setTimeout(function () {
                  location.href = '/forum/list?id=' + data.class_id;
                }, 1000);
              });
            },
            no: function () {
              $.alert('好吧，我以为你想清楚了。');
            }
          });
        });
        $('.input_face').click(function () {
          $('.chat-face-box').height($('.chat-face-box').height() == 0 ? $('.face-box').innerHeight() : 0);
        });
        $('.face-box .face-out img').click(function () {
          var img_tag = $(this).data('img');
          var face_code = '[表情:' + img_tag + ']';
          iamEditor.insertHTML('<img data-code="' + face_code + '" src="' + $(this).attr('src') + '"/>');
          // $('.input_show').val($('.input_show').val() + face_code);
        });
        $('.btn_alt_user').click(function () {
          var code = '[@:' + $(this).data('user-id') + ']';
          iamEditor.insertHTML('<b data-code="' + code + '" class="alt_user_nickname" unit="true">@' + $(this).data('nickname') + '</b>');
        });
        $('.reply_index').submit(function () {
          $(this).find('input[name=context]').val(iamEditor.toUbb());
        });
      });

    </script>
<?php useComp('components/common/footer'); ?>