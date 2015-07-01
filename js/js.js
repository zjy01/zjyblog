/**
 * Created by zjy on 2015/6/28.
 */
$(function(){
    $(".roomChange").click(function(){
        var td=$(this).closest('td').prevAll('td');
        var room_condition=$(td[0]).find('span').text();
        var room_type=$(td[1]).find('span').text();
        var room_floor=$(td[2]).find('span').text();
        var room_num=$(td[3]).find('span').text();

        var ra=$(".roomAdd");
        var rn=ra.find("input[name='room_num']");
        var rf=ra.find("input[name='room_floor']");
        var rt=ra.find("input[name='room_type']");
        var rc=ra.find("textarea[name='room_condition']");

        rn.val(room_num);
        rf.val(room_floor);
        rt.val(room_type);
        rc.val(room_condition);

        ra.focus();
    });
    $(".ct_select").change(function(){
        var form=$(this).closest('form');
        var room_num=form.find("select[name='room_num']");
        var occupy_price=form.find("input[name='occupy_price']");
        var rt=form.find("input[name='room_type']");
        var rc=form.find("textarea[name='room_condition']");
        $.ajax({
            'url':'book.php',
            'data':{
                'room_type':$(this).val()
            },
            'success':function(data){
                var NData=JSON.parse(data);
                var select=form.find(".rn_select");
                select.html("<option>请选择</option>");
                if(NData.status==1){
                    var len=NData.data.length;
                    for(var i=0;i<len;i++){
                        $("<option>").text(NData.data[i].room_num).appendTo(select);
                    }
                }
            }
        });
    });
    $(".rn_select").change(function(){
        var form=$(this).closest('form');
        var occupy_price=form.find("input[name='occupy_price']");
        var rf=form.find("input[name='room_floor']");
        var rc=form.find("textarea[name='room_condition']");
        $.ajax({
            'url':'book.php',
            'data':{
                'room_num':$(this).val()
            },
            'success':function(data){
                var NData=JSON.parse(data);
                occupy_price.val(NData.room_price);
                rf.val(NData.room_floor);
                rc.val(NData.room_condition);
            }
        });
    });
    $("input[type='submit']").click(function(){
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
    $('.datetimepicker').datetimepicker();
});