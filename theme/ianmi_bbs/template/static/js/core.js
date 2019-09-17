var Store = function(namespace) {
    this.namespace = namespace;
    this.data = localStorage.getItem(namespace);
    try {
        this.data = JSON.parse(this.data);
    } catch(e) {
        this.data = {};
    }
}

Store.prototype.save = function() {
    localStorage.setItem(this.namespace, JSON.stringify(this.data));
}

var care_time = $.now() - 1000 * 5;
$(document).on('click', '.btn-action-care', function() {
    var $this = $(this);
    var diff_time = 0.5 - ($.now() - care_time) / 1000;
    if (diff_time > 0) {
        return $.alert('请再等 ' + Math.ceil(diff_time) + ' 秒后操作');
    }
    care_time = $.now();
    
    var userId = $this.data('userId');
    $.getJSON('/user/care_user', {id: userId}).then(function(data) {
        if (data.err) {
            return $.alert(data.msg);
        }
        $.msg(data.msg);
        if (data.is_care) {
            $this.removeClass('btn-fill').text('- 已关注');
        } else {
            $this.addClass('btn-fill').text('+ 关注');
        }
    });
});
