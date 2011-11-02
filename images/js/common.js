// 广告效果监测
jQuery.fn.checkAll = function() {
    var obj = $('tbody :checkbox');
    $(this).toggle(function() {
        obj.each(function() {
            $(this).attr('checked', true);
        })
    },
    function() {
        obj.each(function() {
            $(this).attr('checked', false);
        })
    })
};
jQuery.fn.highlight = function() {
    $(this).mouseover(function() {
        $(this).addClass("highlight");
    }).mouseout(function() {
        $(this).removeClass("highlight");
    });
};
jQuery.fn.myConfirm = function() {
    $(this).click(function() {
        if (confirm("确认要执行当前的操作？")) {
            if ($('tbody :checkbox:checked').length < 1) {
                alert('请选择你要操作的记录');
            } else {
                document.getElementById('myform').submit();
            }
        }
        return false;
    })
};
jQuery.fn.showMenu = function() {
    $(this).click(function() {
        $('.menu dt').each(function() {
            $(this).removeClass('current');
            $(this).parent().find('dd').slideUp();
        });
        $(this).addClass('current');
        $(this).parent().find('dd').slideDown();
    });
};
jQuery.fn.sideBar = function() {
    $(this).click(function() {
        var obj = window.top.frames['mainframe'];
        if (obj.cols == '205,*') {
            obj.cols = '9,*';
            $(this).css({
                'background-position': '-9px -250px'
            });
            $(this).attr('title', '打开侧边栏');
            $('.menu').hide();
        } else {
            obj.cols = '205,*';
            $(this).css({
                'background-position': '0 -250px'
            });
            $(this).attr('title', '关闭侧边栏');
            $('.menu').show();
        }
    });
};