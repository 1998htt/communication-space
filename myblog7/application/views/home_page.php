<?php
$loginUser = $this -> session ->userdata('loginUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title>
        <?php
        if($loginUser){
            ?>
            <?php echo $loginUser->username;?>
            <?php
        }else{
            ?>
            欢迎来到博客网站
            <?php
        }
        ?>

    </title>
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
    <div id="OSC_Banner">
        <div id="OSC_Slogon">
            <?php
            if($loginUser){
                ?>
                <?php echo $loginUser->username;?>
                <?php
            }else{
                ?>
                欢迎来到博客网站
                <?php
            }
            ?>
        </div>
        <div id="OSC_Channels">
            <ul>
                <li><a href="#" class="project">心情 here...</a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div><!-- #EndLibraryItem -->
    <div id="OSC_Topbar">
        <div id="VisitorInfo">
            当前访客身份：
            <?php
            if($loginUser){
                ?>
                <?php echo $loginUser->username;?>[<a href="welcome/logout">退出</a> ]
                <a href="welcome/user_home_page">返回我的博客列表</a>
                <?php
            }else{
                ?>
                游客 [ <a href="welcome/login ">登录</a> | <a href="welcome/reg">注册</a> ]
                <?php
            }
            ?>
        </div>
        <div id="SearchBar">
            <form action="javascript:;" >
                <input id="txt_q" class="SERACH" value="在此空间的博客中搜索" type="text">
                <button class="SUBMIT" value="搜索" id="go">go</button>
<!--                <input class="SUBMIT" value="搜索" type="submit" id="go">-->
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <div id="OSC_Content">
        <div class="BlogList" id="blog_list">
            <ul>
                <?php foreach($results as $result){?>
                 <li class='Blog' id='blog_24027'>

                     <h2 class='BlogAccess_true BlogTop_0'><a href="admin/show_detail?article_id=<?php echo $result->article_id;?>"><?php echo $result->title?></a></h2>

                    <div class='outline'>

                        <span class='time'>发表于 <?php echo $result->post_date?></span>

                        <span class='catalog'>分类: <a href="?catalog=92334"><?php echo $result->type_name?></a></span>

                        <span class='stat'>统计: 0评/<?php echo $result->clicked?>阅</span>

                    </div>

                    <div class='TextContent' id='blog_content_24027'>

                        测试文章3

                        <div class='fullcontent'><a href="viewPost_comment.htm">阅读全文...</a></div>

                    </div>

                </li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <script type="text/javascript" src="js/brush.js"></script>
        <link type="text/css" rel="stylesheet" href="css/shCore.css">
        <link type="text/css" rel="stylesheet" href="css/shThemeDefault.css">
    </div>
    <div class="clear"></div>
</div>
</body>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/search_blog.js"></script>
</html>