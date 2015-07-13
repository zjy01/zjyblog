/**
 * Created by zjy on 2015/6/28.
 */
$(function(){
    $(".login-submit,.register-submit").click(function(){
        var text=$(this).closest('form').find("input[type='text']");
        var textarea=$(this).closest('form').find("textarea");
        var ts=0;
        text.each(function (i,v) {
            if($(v).val()==''){
                ts=1;
                return false;
            }
        });
        textarea.each(function (i,v) {
            if($(v).val()==''){
                ts=1;
                return false;
            }
        });
        if(ts==1){
            alert("有空未填");
            return false;
        }
    });
    $(".comment-button").click(function () {
        var comment=$(this).closest(".diary-show-content").find(".diary-comment-box");
        var dis=comment.css('display');
        if(dis=='none'){
            comment.slideDown('fast');
        }
        else{
            comment.slideUp('fast');
        }
    });
    $(".diary-delete").click(function(){
        var dl=$(this);
        var diaryId=$(this).attr('data-ms');
        $.ajax({
            url:__APP__+'/view/diary.php?action=delete',
            data:{
                'diary_id':diaryId
            },
            success:function(data){
                if(data){
                    dl.closest(".diary-show-one").slideUp('fast');
                    var countB=$("#diary-count");
                    var t=countB.text();
                    countB.text(parseInt(t)-1);
                }
                else{
                    alert(删除失败);
                }
            }
        });
    });
    $(document).on('click','.attenAdd',function(){
        var dl=$(this);
        var from=dl.attr('data-from');
        var to=dl.attr('data-to');
        $.ajax({
            url:__APP__+'/view/diary.php?action=attenAdd',
            data:{
                'from':from,
                'to':to
            },
            success:function(data){
                if(data){
                    var a=$("a[data-from='"+from+"'][data-to='"+to+"']");
                    a.text("取消关注");
                    a.attr('class','attenDel');
                }
                else{
                    alert('关注失败');
                }
            }
        });
    });
    $(document).on('click','.attenDel',function(){
        var dl=$(this);
        var from=dl.attr('data-from');
        var to=dl.attr('data-to');
        $.ajax({
            url:__APP__+'/view/diary.php?action=attenDel',
            data:{
                'from':from,
                'to':to
            },
            success:function(data){
                if(data){
                    var a=$("a[data-from='"+from+"'][data-to='"+to+"']");
                    a.text("关注");
                    a.attr('class','attenAdd');
                }
                else{
                    alert('取消关注失败');
                }
            }
        });
    });

    var a= 1,b= 1,c=1;
    $(".change-submit").click(function(){
        var st=1;
        $(this).closest("form").find(".haveto").each(function(i,v){
            if($(v).val()==''){
                st=0;
                alert('必填项不能留空');
                $(v).focus();
                return false;
            }
        });
        if(a==0){
            alert("用户名已被占用");
        }
        else if(c==0){
            alert("邮箱格式不正确");
        }
        if(st==0  || c==0 || a==0){
            return false;
        }
    });
    $("input[name='userName']").focusout(function(){
        var name=$(this).val();
        var bt=$(this);
        if($.trim(name)==''){
            $(this).closest('td').find(".right").hide();
            $(this).closest('td').find(".wrong").show();
        }
        else{
            $.ajax({
                url:__APP__+'/login/verify.php',
                data:{
                    'verify':1,
                    'userName':$.trim(name)
                },
                success:function(data){
                    if(data==1){
                        a=1;
                        bt.closest('td').find(".wrong").hide();
                        bt.closest('td').find(".right").show();
                    }
                    else{
                        a=0;
                        bt.closest('td').find(".right").hide();
                        bt.closest('td').find(".wrong").show();
                    }
                }
            });
        }
    });
    $("input[name='repassword']").focusout(function(){
        var password=$(this).closest('form').find("input[name='password']").val();
        var repassword=$("input[name='repassword']").val();
        if(password==repassword && password!=''){
            b=1;
            $(this).closest('td').find(".wrong").hide();
            $(this).closest('td').find(".right").show();
        }
        else{
            b=0;
            $(this).closest('td').find(".right").hide();
            $(this).closest('td').find(".wrong").show();
        }
    });
    $("input[name='email']").focusout(function(){
        var text=$(this).val();
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if(text!=''){
            if(!pattern.test(text)){
                c=0;
                $(this).closest('td').find(".right").hide();
                $(this).closest('td').find(".wrong").show();
            }
            else{
                c=1;
                $(this).closest('td').find(".wrong").hide();
                $(this).closest('td').find(".right").show();
            }
        }
    });
    $(".face-now").click(function(){
        var face=$(this);
        var box=$(".face-box");
        box.stop(false,true).slideDown('fast');
        var img=box.find('.face-img');
        img.click(function(){
            var src=$(this).attr('src');
            face.attr('src',src);
            $("input[name='face']").val(src);
            box.stop(false,true).slideUp('fast');
        });
    });
    $(".password-submit").click(function(){
        var st=1;
        $(this).closest("form").find(".haveto").each(function(i,v){
            if($(v).val()==''){
                st=0;
                alert('必填项不能留空');
                $(v).focus();
                return false;
            }
        });
        if(b==0){
            alert("两次输入密码不相同");
        }
        if(st==0  || b==0 ){
            return false;
        }
    });
    $(".change-ms").click(function(){
        $(".table-bordered").hide();
        $(".ms-table").show();
    });
    $(".change-pw").click(function(){
        $(".table-bordered").hide();
        $(".pw-table").show();
    });
    $(".comment-submit").click(function(){
        var form=$(this).closest("form");
        var box=form.prev(".diary-comment-list");
        var from=form.find("input[name='from']").val();
        var to=form.find("input[name='to']").val();
        var content=form.find("input[name='comment']").val();
        $.ajax({
            url:__APP__+'/view/diary.php?action=comment',
            data:{
                'from':from,
                'to':to,
                'comment':content
            },
            type:'POST',
            success:function(data){
                if(data){
                    form.find("input[name='comment']").val('');
                    $('<div class="alert-success"><span>@'+from+'</span>'+content+'</div>').appendTo(box);
                }
                else{
                    alert("评论失败");
                }
            }
        });
        return false;
    });
    //$('.datetimepicker').datetimepicker();
});
