<?php
session_start();
//require_once("Includes/header.php");
require_once dirname(__FILE__) . "/phpfreechat-1.7/src/phpfreechat.class.php";
if (!isset($_SESSION['userid'])) {
    echo "You must register and Login";
} else {
    $params = array();
    $params["title"] = "Chat";
    $params["nick"] = $_SESSION['name']; // setup the initial nickname
    //$params["isadmin"] = true; // makes everybody admin: do not use it on production servers ;)
    $params["serverid"] = md5(__FILE__); // calculate a unique id for this chat
    $params["debug"] = false;
    $chat = new phpFreeChat($params);
    ?>
        <?php $chat->printChat(); ?>
        <?php if (isset($params["isadmin"]) && $params["isadmin"]) { ?>
            <p style="color:red;font-weight:bold;">Warning: because of "isadmin" parameter, everybody is admin. Please
                modify this script before using it on production servers !</p>
        <?php } ?>
<?php } ?>
<input type="button" value="Back to previous page" onclick="history.back(-1)" />
