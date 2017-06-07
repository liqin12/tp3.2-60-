<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<!--<link rel="stylesheet" type="text/javascript" href="/public/js/jquery-1.11.0.min.js" />-->
<script src="/public/js/jquery-1.11.0.min.js"></script>
<body>
<!--<form action="<?php echo U('obtainyzm');?>" method="post">-->
    <div class="form-group">
        <div class="field field-icon-right">
            <input type="text" id="admin" class="input" name="admin" placeholder="用户名" data-validate="required:请填写用户名,length#>=5:用户长度不符合要求"  />
            <span class="icon icon-user"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="field field-icon-right">
            <input id="mobile" type="tel" class="input" name="mobile" placeholder="手机号码"  />
            <span class="icon icon-mobile"></span>
        </div>
    </div>
     <span class="x4" style="text-align: center;vertical-align: middle">
        <!--<button id="sendmsg">获取验证码</button>-->
         <input type="button" id="sendmsg" value="获取验证码" >
    </span>

<!--</form>//"admin=" + $('#admin').val()+"&mobile="+$("#mobile").val() ,-->
<script>

    /*-------------------------------------------*/
    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    var code = ""; //验证码
    var codeLength = 6;//验证码长度

    $(function () {
        $('#sendmsg').click(function () {
            $.ajax({
                type: "POST",
                url: "<?php echo U('obtainyzm');?>",
                data: {admin:$('#admin').val(),mobile:$("#mobile").val()},
                async:true,
                success: function (result) {
                    if(result==0){
                        curCount = count;
                        //设置button效果，开始计时
                        $("#sendmsg").css("background-color", "LightSkyBlue");
                        $("#sendmsg").attr("disabled", "true");
                        $("#sendmsg").val("获取" + curCount + "秒");
                        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                    }
                    if(result==1){
                        alert("用户名和手机号不匹配!");
                    }
                    if(result==2){
                        alert("用户名不存在！");
                    }
                },
                dataType: 'json'
            })
        })
    })

    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#sendmsg").removeAttr("disabled");//启用按钮
            $("#sendmsg").css("background-color", "");
            $("#sendmsg").val("重发验证码");
            code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
        }
        else {
            curCount--;
            $("#sendmsg").val("获取" + curCount + "秒");
        }
    }
</script>
</body>
</html>