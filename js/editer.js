/**
 * Created by zjy on 2015/7/11.
 */
$(function() {
    var diary = KindEditor.create('#simple-type',{
        themeType : 'simple',
        width:600,
        items : [
            'emoticons','bold','italic','underline','fontsize','forecolor', 'link'
        ],
        afterChange : function() {
            var limitNum=140;
            var num=this.count('text');
            KindEditor('#simple-count').html(num);
            if(this.count('text') > limitNum) {
                $('#simple-count').next('.red').text('*字数超过限制，请适当删除部分内容');
            }
            else{
                $('#simple-count').next('.red').text('');
            }
        }
    });
    var longBlog = KindEditor.create('#longBlog',{
        width:972,
        height:600,
        autoHeightMode : true,
        afterChange : function() {
            var limitNum=140;
            var num=this.count('text');
            KindEditor('#simple-count').html(num);
            if(this.count('text') > limitNum) {
                $('#simple-count').next('.red').text('*字数超过限制，请适当删除部分内容');
            }
            else{
                $('#simple-count').next('.red').text('');
            }
        },
        afterCreate : function() {
            this.loadPlugin('autoheight');
        },
        layout: '<div class="container"><div class="toolbar"></div><p><input type="text" class="blog_title-edit input-sm" name="blog_title" placeholder="在这里输入标题"></p><div class="edit"></div><div class="statusbar"></div></div>'
    });

    $(".long-sub").click(function(){
        var form=$(this).closest('form');
        var text=longBlog.text();
        var title=form.find("input[name='blog_title']").val();
        if(title==''){
            alert('标题不能为空');
            return false;
        }
        if(text==''){
            alert("正文不能为空");
            return false;
        }
    });

    $(".short-sub").click(function(){
        var text=diary.text();
        if(text==''){
            alert("编辑框不能为空");
            return false;
        }
    });
});