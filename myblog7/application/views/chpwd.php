<?php
$loginUser = $this->session->userdata('loginUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title>修改登录密码 Johnny的博客 - SYSIT个人博客</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
    <style type="text/css">
        body, table, input, textarea, select {
            font-family: Verdana, sans-serif, 宋体;
        }
    </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {
    padding: 3px 10px 3px 10px;
}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {
    padding: 3px 10px 4px 10px;
}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
    <?php include 'admin_header.php' ?>

    <div id="OSC_Content">
        <div id="AdminScreen">
            <div id="AdminPath">
                <a href="admin/index">返回我的首页</a>&nbsp;»
                <span id="AdminTitle">修改登录密码</span>
            </div>
            <?php include 'admin_menu.php' ?>
            <div id="AdminContent">

                <div class="MainForm">
                    <form class="AutoCommitJSONForm" action="admin/update_pwd" method="POST" onsubmit="return false">
                        <h2>修改我的登录密码</h2>
                        <table width="100%">
                            <tbody>
                            <tr>
                                <th width="110">旧的登录密码</th>
                                <td>
                                    <input name="pwd" size="20" class="TEXT" tabindex="1" type="password" id="old_pwd">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" target="_blank">忘记登录密码</a>
                                </td>
                            </tr>
                            <tr>
                                <th>新密码</th>
                                <td><input name="newpwd" size="20" class="TEXT" tabindex="2" type="password" id="new_pwd"></td>
                            </tr>
                            <tr>
                                <th>再次输入新密码</th>
                                <td><input name="newpwd2" size="20" class="TEXT" tabindex="3" type="password" id="re_new_pwd"></td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                            </tr>
                            <tr class="submit">
                                <th></th>
                                <td>
                                    <input value="修改密码" class="BUTTON SUBMIT" tabindex="4" type="submit" id="button_submit">
                                    <span id="error_msg"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script>
    $(function(){
        $('#button_submit ').on('click',function(){
            var old_pwd = $('#old_pwd').val();
            var new_pwd = $('#new_pwd').val();
            var re_new_pwd = $('#re_new_pwd').val();
            $.get('admin/update_pwd',{
                old_pwd:old_pwd,
                new_pwd:new_pwd,
                re_new_pwd:re_new_pwd,
            },function(data){
                if(data == 'success'){
                    $("#error_msg").html('');
                    alert('密码修改成功');
                    location.href="welcome/login";
                }else if(data == "empty"){
                    $("#error_msg").html('密码不能为空');
                }
                else if(data == "notmatch"){
                    $("#error_msg").html('密码不一致')
                }else{
                    $("#error_msg").html('旧的密码错误')
                }
            },'text')
        })








    })

</script>
</body>
</html>