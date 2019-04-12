<?php
$loginUser = $this -> session ->userdata('loginUser');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title><?php echo $loginUser->username?>的博客</title>
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
            <a href="welcome/homepage" style="text-decoration: none">返回首页</a>
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
                <li><a href="#" class="project">  <?php
                        if($loginUser){
                            ?>
                            <?php echo $loginUser->mood;?>
                            <?php
                        }else{
                            ?>

                            <?php
                        }
                        ?></a></li>
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
            <?php
                }else{
            ?>
            游客 [ <a href="welcome/login ">登录</a> | <a href="welcome/reg">注册</a> ]
            <?php
                }
            ?>

        </div>
        <div id="SearchBar">
            <form action="javascript:;">
                 <input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" type="text">
                <button class="SUBMIT" value="搜索" id="go">go</button>
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <div id="OSC_Content">
        <div class="SpaceChannel">
            <div id="portrait"><a href="admin/list_blogs"><img src="images/portrait.gif" alt="Johnny" title="Johnny"
                                                             class="SmallPortrait" user="154693" align="absmiddle"></a>
            </div>
            <div id="lnks">
                <strong>
                    <?php if($loginUser){?>
                    <?php echo $loginUser->username?> 的博客</strong>
                <?php }?>

                <div><a href="welcome/user_home_page">TA的博客列表</a>&nbsp;
                    <a href="sendMsg.htm"></a></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="BlogList" id="blog_list">
            <ul>
                <?php
                    foreach($articles as $article){
                ?>
                <li class="Blog" id="blog_24027">
                    <h2><a href="admin/get_blog_by_id?id=<?php echo $article->article_id;?>"><?php echo $article->title ?></a></h2>
                    <div class="outline">
                        <span class="time">发表于:<?php echo $article->post_date ?></span>
                        <span class="catalog">分类:<?php echo $article->type_name ?></span>
                        <span class="stat">统计: <?php echo $article->clicked?>阅</span>
<!--                        <span class="blog_admin">( <a href="newBlog.htm">修改</a> | <a-->
<!--                                    href="javascript:delete_blog(24027)">删除</a> )</span>-->
                    </div>
                    <div class="TextContent" id="blog_content_24027">
                        <?php echo $article->title ?>
                        <div class="fullcontent"><a href="viewPost_comment.htm">阅读全文...</a></div>
                    </div>
                </li>
                <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="BlogMenu">
            <div class="admin SpaceModule">
                <strong>博客管理</strong>
                <ul class="LinkLine">
                    <li><a href=admin/new_blog>发表博客</a></li>
                    <li><a href="admin/get_blog_type">博客分类管理</a></li>
                    <li><a href="admin/list_blogs">文章管理</a></li>
                    <li><a href="admin/get_comment_to_me">网友评论管理</a></li>
                </ul>
            </div>
            <div class="catalogs SpaceModule">
                <strong>博客分类</strong>
                <ul class="LinkLine">
                    <?php
                        foreach($types as $type) {
                    ?>
                    <li><a href="#"><?php echo $type->type_name?>(<?php echo $type->num?>)</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
<!--            <div class="comments SpaceModule">-->
<!--                <strong>最新网友评论</strong>-->
<!--                <ul>-->
<!--                    <li>-->
<!--                        <span class="u"><a href="#"><img src="images/portrait.gif" alt="Johnny" title="Johnny"-->
<!--                                                         class="SmallPortrait" user="154693"-->
<!--                                                         align="absmiddle"></a></span>-->
<!--                        <span class="c">hoho-->
<!--			<span class="t">发布于 11分钟前 <a href="viewPost_comment.htm">查看»</a></span>-->
<!--		</span>-->
<!--                        <div class="clear"></div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <span class="u"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny"-->
<!--                                                         class="SmallPortrait" user="154693"-->
<!--                                                         align="absmiddle"></a></span>-->
<!--                        <span class="c">测试评论111-->
<!--			<span class="t">发布于 34分钟前 <a href="viewPost_logined.htm">查看»</a></span>-->
<!--		</span>-->
<!--                        <div class="clear"></div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <span class="u"><a href="#"><img src="assets/images/portrait.gif" alt="Johnny" title="Johnny"-->
<!--                                                         class="SmallPortrait" user="154693"-->
<!--                                                         align="absmiddle"></a></span>-->
<!--                        <span class="c">测试评论-->
<!--			<span class="t">发布于 34分钟前 <a href="viewPost_logined.htm">查看»</a></span>-->
<!--		</span>-->
<!--                        <div class="clear"></div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
        <div class="clear"></div>

    </div>
    <div class="clear"></div>

</div>
</div>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/search_blog.js"></script>
</body>
</html>