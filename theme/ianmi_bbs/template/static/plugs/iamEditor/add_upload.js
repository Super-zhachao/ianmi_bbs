$(function () {
  var upload_data = {
    'img_data': [],
    'file_data': []
  };

  var contentEditor = new Eleditor({
    el: '#contentEditor',
    /*初始化完成钩子*/
    mounted: function () {
    },
    changer: function () {
    },
    /*自定义按钮的例子*/
    toolbars: [
      {
        id: 'upimg',
        name: '插图片',
        handle: function (_select, _controll) {//回调有两个参数，分别是已选择的编辑dom对象和当前控制按钮对象
          upimg_self(_select, _controll)
        }
      },
      'insertText',
      'editText',
      'insertLink',
      'insertHr',
      'delete',
      'undo',
      'cancel'
    ]
  });

  if ($('input[name=img_data]').val()) {
    upload_data.img_data = $('input[name=img_data]').val().split(',');
  }

  if ($('input[name=file_data]').val()) {
    upload_data.file_data = $('input[name=file_data]').val().split(',');
  }

  // console.log(upload_data);

  var allow_type = ["png", "gif", "jpg", "bmp", "jpeg"];
  $('._add_image').click(function () {
    var file_input = $('<input type="file">');
    file_input.hide();
    $('body').append(file_input);
    file_input.change(upImg);
    file_input.click();
  });

  var allow_type_file = ["rar", "zip"];
  $('.add_file').click(function () {
    var file_input = $('<input type="file">');
    file_input.change(upRar);
    file_input.click();
  });

  var upRar = function () {
    var e = this;
    var file = e.files[0];
    var isUp = false;
    var fileType = /\.[^\.]+$/.exec(file.name);
    fileType = fileType[0].replace(".", "");
    if (allow_type_file.indexOf(fileType) == -1) {
      $.alert('文件类型错误，请选择图片文件');
      return;
    }
    console.log(file);
    var box = $('<div class="file_item"><div class="file_icon icon-svg"></div><div class="file_progress_box"><div class="file_name">abc.rar</div><div class="file_progress"><div class="file_progress_bar"></div></div></div><div class="file_action"><div class="flex-box"><div class="btn_remove">--</div><!--div class="btn_setting">--</div--></div></div></div>');
    box.find('.file_name').text(file.name + '(' + renderSize(file.size) + ')');
    $('.add_file').before(box);

    $('._file_box').height($('.file_group').innerHeight());
    ajaxUpload({
      form: {'file': file},
      url: '/forum/ajax_upload',
      progress: function (e) {
        if (e.lengthComputable) {
          var w = parseInt(e.loaded * 100 / e.total);
          box.find(".file_progress_bar").css("width", w + "%");
        }
      },
      success: function (data) {
        dataAdd('file_data', data.id);
        box.data('id', data.id);
        var $remove = box.find('.btn_remove');
        $remove.addClass('btn_file_remove');
        $remove.text('删除');
        // box.find('.btn_setting').text('设置');
      }
    });
    this.remove();
  }

  var upImg = function () {
    var e = this;
    var file = e.files[0];
    var isUp = false;
    var fileType = /\.[^\.]+$/.exec(file.name);
    fileType = fileType[0].replace(".", "");
    if (allow_type.indexOf(fileType) == -1) {
      $.alert('文件类型错误，请选择图片文件');
      return;
    }

    window.URL = window.URL || window.webkitURL;
    if (window.URL) {
      var pic = $('<div class="img_item"><div class="progress_bg"></div><div class="progress_text">0%</div><div class="progress_del">x</div></div>');
      var r = new FileReader();
      r.readAsDataURL(file);
      r.onload = function () {
        var img = new Image();
        img.src = this.result;
        img.onload = function () {
          if (img.width > img.height) {
            pic.css("background-size", "auto 100%");
          }
        }
        pic.css("background-image", "url(" + this.result + ")");
      }
      // $(".add_img").before(pic);

      var modal = $.modal({
        content: pic
      });
      ajaxUpload({
        form: {'file': file},
        url: '/forum/ajax_upload',
        progress: function (e) {
          if (e.lengthComputable) {
            var w = parseInt(e.loaded * 100 / e.total);
            pic.find(".progress_bg").css("height", (100 - w) + "%");
            pic.find(".progress_text").text(w + "%");
          }
        },
        success: function (data) {
          dataAdd('img_data', data.id);
          pic.data('id', data.id);
          var $insert = pic.find(".progress_text");
          $insert.addClass('btn_pic_insert');
          $insert.text("插入");
          iamEditor.insertHTML('<img data-code="[img=' + data.id + ']" src="' + data.path + '"/>');
          $.modal.close(modal);
          $.msg('插入图片成功');
        }
      });
    } else {
      $.alert('您的浏览器当前不支持在线预览上传');
    }
  }

  $(document).on('click', '.btn_pic_insert', function () {
    insertImg($(this).parents('.img_item').data('id'));
  })

  $(document).on('click', '.progress_del', function () {
    var $parent = $(this).parents('.img_item');
    dataRemve('img_data', $parent.data('id'));
    $parent.remove();
  })


  $(document).on('click', '.btn_file_remove', function () {
    var $parent = $(this).parents('.file_item');
    dataRemve('file_data', $parent.data('id'));
    $parent.remove();

    $('._file_box').height($('.file_group').innerHeight());
  });

  var insertImg = function (id) {
    id = id.toString();
    var index = upload_data['img_data'].indexOf(id);

    if (index >= 0) {
      var val = $('.add_context').val();
      $('.add_context').val(val + '[img_' + index + ']');
    }
  }

  var dataAdd = function (name, id) {
    console.log(name, id);
    upload_data[name].push(id);
    $('input[name=' + name + ']').val(upload_data[name].join(','));
  }

  var dataRemve = function (name, id) {
    id = id.toString();

    var index = upload_data[name].indexOf(id);
    if (index >= 0) {
      upload_data[name].splice(index, 1);
    }
    $('input[name=' + name + ']').val(upload_data[name].join(','));
  }

  // var options = {
  //     form: {
  //         'file': 0
  //     },
  //     url: '',
  //     progress: function(e) {

  //     },
  //     success: function(data) {

  //     }
  // };
  var ajaxUpload = function (options) {
    var fd = new FormData();
    for (var p in options.form) {
      fd.append(p, options.form[p]);
    }
    $.ajax({
      url: options.url,
      type: "POST",
      dataType: 'json',
      xhr: function () {
        myXhr = $.ajaxSettings.xhr();
        if (myXhr.upload) {
          myXhr.upload.addEventListener('progress', options.progress, false);
        }
        return myXhr;
      },
      processData: false,
      contentType: false,
      data: fd,
      success: options.success
    });
  }

  function renderSize(value) {
    if (null == value || value == '') {
      return "0 Bytes";
    }
    var unitArr = new Array("Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
    var index = 0;
    var srcsize = parseFloat(value);
    index = Math.floor(Math.log(srcsize) / Math.log(1024));
    var size = srcsize / Math.pow(1024, index);
    size = size.toFixed(2);//保留的小数位数
    return size + unitArr[index];
  }

  var $mark_input = $('.mark_input');
  $('.btn_add_mark').click(function () {
    $.get('/forum/mark_check', {
      title: $mark_input.text()
    }).then(function (data) {
      if (data.err) {
        return $.alert('标签名不正确，或不能使用！');
      }
      var all_mark_id = getAllMarkId();
      if (all_mark_id.indexOf(data.id) >= 0) {
        return $.alert('改标签已经添加了，不能重复添加的哦！');
      }
      if (data.status == 0) {
        $.alert('您添加的标签为一个新的标签，系统审核通过之后即可显示！');
      }
      $mark_input.text('').before('<span class="mark-item mark-close" data-id="' + data.id + '">' + data.title + '</span>');
    });
  });

  $(document).on('click', '.mark-close', function () {
    $(this).remove();
  })

  // 获取所有已添加标签
  var getAllMarkId = function () {
    var data = [];
    $('.item-input .mark-item').each(function () {
      data.push($(this).data('id'));
    });
    return data;
  }

  // 发表文章

  $('._right_bottom').click(function () {
    var $this = $('._edit_forum');

    //把颜表情换成文本
    var code_dom = document.getElementById('contentEditor').querySelectorAll('[data-code]');
    for (let value of code_dom) {
      var code = value.dataset.code;
      value.parentNode.replaceChild(document.createTextNode(code), value);
    }

    var $imgs = $('img[data-code^="[img="]');
    var ids = [];
    $imgs.each(function ($key, $item) {
      console.log($item);
      var code = $($item).data('code');
      var id = code.replace(/[^0-9]/ig, "");
      if (ids.indexOf(id) == -1) {
        ids.push(id);
      }
    });

    // $('input[name=img_data]').val(ids.join(','));
    $this.append($('<input name="context" type="hidden">').val(contentEditor.getContent()));
    $this.find('input[name=mark_body]').val(getAllMarkId());
    $.post($this.attr('action'), $this.serialize()).then(function (data) {
      if (data.err) {
        $.alert(data.msg);
      } else {
        location.replace('/forum/view?id=' + data.data.id);
      }
    });
    return false;
  });

  // this.remove();



  //上传图片
  function upimg_self(_select, _controll) {
    var allow_type = ["png", "gif", "jpg", "bmp", "jpeg"];
    /*注意！！！在编辑修改内容前务必通过saveState保存下状态，这样编辑器撤销按钮才会生效，否则无法撤销修改*/
    contentEditor.saveState();

    var file_input = $('<input type="file">');
    file_input.hide();
    $('body').append(file_input);
    file_input.change(function () {
      var e = this;
      var file = e.files[0];
      var isUp = false;
      var fileType = /\.[^\.]+$/.exec(file.name);
      fileType = fileType[0].replace(".", "");
      if (allow_type.indexOf(fileType) == -1) {
        $.alert('文件类型错误，请选择图片文件');
        return;
      }

      window.URL = window.URL || window.webkitURL;
      if (window.URL) {
        var pic = $('<div class="img_item"><div class="progress_bg"></div><div class="progress_text">0%</div><div class="progress_del">x</div></div>');
        var r = new FileReader();
        r.readAsDataURL(file);
        r.onload = function () {
          var img = new Image();
          img.src = this.result;
          img.onload = function () {
            if (img.width > img.height) {
              pic.css("background-size", "auto 100%");
            }
          }
          pic.css("background-image", "url(" + this.result + ")");
        }
        // $(".add_img").before(pic);

        var modal = $.modal({
          content: pic
        });
        ajaxUpload({
          form: {'file': file},
          url: '/forum/ajax_upload',
          progress: function (e) {
            if (e.lengthComputable) {
              var w = parseInt(e.loaded * 100 / e.total);
              pic.find(".progress_bg").css("height", (100 - w) + "%");
              pic.find(".progress_text").text(w + "%");
            }
          },
          success: function (data) {
            dataAdd('img_data', data.id);
            pic.data('id', data.id);
            _select.after('<img data-code="[img=' + data.id + ']" src="' + data.path + '"/>');
            if (_select.context.className.indexOf('Eleditor-placeholder') !== -1) {
              _select.remove();
            }
            $.modal.close(modal);
            $.msg('插入图片成功');
          }
        });
      } else {
        $.alert('您的浏览器当前不支持在线预览上传');
      }
    });
    file_input.click();
  }
});