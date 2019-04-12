<?php
$loginUser = $this->session->userdata('loginUser');
?>
<div id="OSC_Banner">

    <div id="OSC_Slogon"><?php echo $loginUser->username;?></div>
    <div id="OSC_Channels">
        <ul>
            <li><a href="#" class="project"><?php echo $loginUser->mood; ?></a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div><!-- #EndLibraryItem -->
<div id="OSC_Topbar">
    <div id="VisitorInfo">
        当前访客身份：
        <?php echo $loginUser->username; ?> [ <a href="welcome/logout">退出</a> ]

    </div>
    <div id="SearchBar">
        <form action="">
            <input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" type="text">
            <input class="SUBMIT" value="搜索" type="submit" id="go">
        </form>
    </div>
    <div class="clear"></div>
</div>