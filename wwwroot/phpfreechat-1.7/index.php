<?php

require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params["title"] = "Quick chat";
$params["nick"] = "guest".rand(1,1000);  // setup the intitial nickname
$params['firstisadmin'] = true;
//$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
$params["serverid"] = md5(__FILE__); // calculate a unique id for this chat
$params["debug"] = true;
$chat = new phpFreeChat( $params );

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>phpFreeChat- Sources Index</title>
</head>
<body>
<div class="content">
    <?php $chat->printChat(); ?>
    <?php if (isset($params["isadmin"]) && $params["isadmin"]) { ?>
        <p style="color:red;font-weight:bold;">Warning: because of "isadmin" parameter, everybody is admin. Please modify this script before using it on production servers !</p>
    <?php } ?>
</div>

<div class="footer">
    <span class="partners">-</span>
</div>

</body></html>
