<?php
$loginUser = $this->session->userdata('loginUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
  <title>博客设置/分类管理 Johnny的博客 - SYSIT个人博客</title>
    <base href="<?php echo site_url();?>">
    <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
    <?php include 'admin_header.php' ?>
	<div id="OSC_Content">
<div id="AdminScreen">
    <div id="AdminPath">
        <a href="index_logined.htm">返回我的首页</a>&nbsp;»
    	<span id="AdminTitle">博客设置/分类管理</span>
    </div>
    <?php include 'admin_menu.php' ?>
    <div id="AdminContent">
<div class="MainForm BlogCatalogManage">
<form id="CatalogForm" action="/action/blog/add_blog_catalog?space=154693&amp;id=92334" method="post">
    <h3> 修改博客分类 </h3>
    <div id="error_msg" class="error_msg" style="display:none;"></div>
    <label>分类名称:</label><input id="txt_link_name" name="name" value="工作日志" size="15" tabindex="1" type="text">
    <label>排序值:</label><input name="sort_order" value="1" size="3" type="text">
    <span class="submit">
          <input value="修改&nbsp;»" tabindex="3" class="BUTTON SUBMIT" type="submit">
      <input value="取消" class="BUTTON" onclick="location.href='blogCatalogs.htm';" type="button">
        </span>
</form>
<form class="BlogCatalogs">
<h3>博客分类 <span>(点击分类名编辑)</span></h3>
<table cellpadding="1" cellspacing="1">
	<tbody><tr>
		<th>序号</th>
		<th>分类名</th>
		<th>文章</th>
		<th>操作</th>
	</tr>
    <?php foreach($results as $result){?>
	<tr id="catalog_92334">
		<td class="idx"><?php echo $index+1?></td>
		<td class="name"><a href="#" title="点击修改博客分类">工作日志</a></td>
		<td class="num"><?php echo  $result->num?></td>
		<td class="opts">
			<a href="admin/update_type?<?php echo  $result->type_id?>" title="点击修改博客分类">修改</a>
			<a href="#" onclick="return delete_catalog(154693,92334);">删除</a>
		</td>
	</tr>
    <?php }?>

</form>
</div>
<script type="text/javascript">
<!--
$('#CatalogForm').ajaxForm({
    success: function(html) {
    	if(html.length == 0)
    		location.reload();
    	else{
    		$('#error_msg').hide();
    		$('#error_msg').html(html);
    		$('#error_msg').show("fast");
        }
	}
});
$('#BlogDispForm').ajaxForm({
    success: function(html) {alert(html);}
});
function delete_catalog(space, catalog_id){
	if(confirm('确实要删除此博客分类吗？')){
		var args = "space="+space+"&id="+catalog_id;
		ajax_post('/action/blog/delete_blog_catalog',args,function(html){
		if(html.length==0)
			$('#catalog_'+catalog_id).fadeOut();
		else
			alert(html);
		});
	}
	return false;
}
$('#chb_blog_enabled').click(function(){
	var chk = $('#chb_blog_enabled').attr("checked");
	if(!confirm(chk?"请确认是否要开启空间的博客功能？":"请确认是否要关闭空间博客功能？")) return false;
	ajax_post("/action/blog/switch_blog?space=154693","enabled="+chk,function(){
		alert(chk?"已经开启了博客功能！":"博客功能已经关闭！");
	});
});
//-->
</script></div>
	<div class="clear"></div>
</div>


</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
<script type="text/javascript" src="js/space.htm" defer="defer"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('a.fancybox').fancybox({titleShow:false});
});

function pay_attention(pid,concern_it){
	if(concern_it){
		$("#p_attention_count").load("/action/favorite/add?mailnotify=true&type=3&id="+pid);
		$('#attention_it').html('<a href="javascript:pay_attention('+pid+',false)" style="color:#A00;">取消关注</a>');	
	}
	else{
		$("#p_attention_count").load("/action/favorite/cancel?type=3&id="+pid);
		$('#attention_it').html('<a href="javascript:pay_attention('+pid+',true)" style="color:#3E62A6;">关注此文章</a>');
	}
}
//-->
</script>
</body></html>