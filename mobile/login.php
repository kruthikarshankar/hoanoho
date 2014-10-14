<?php
    $referer = "";

    if (!isset($_SESSION)) {
        session_start();
    }

    if(isset($_GET['cmd']) && $_GET['cmd'] == "logout")
        $_SESSION['REAL_REFERER'] = "";

    if(isset($_SESSION['REAL_REFERER']))
        $referer = $_SESSION['REAL_REFERER'];

    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    include dirname(__FILE__).'/../includes/dbconnection.php';

    $sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
    $result = mysql_query($sql);

    $__CONFIG = array();

    while ($row = mysql_fetch_array($result)) {
        $__CONFIG[$row[0]] = $row[1];
    }

    if (isset($_GET['login'])) {
        $result = mysql_query("SELECT users.uid, password, username, grpname, isAdmin from users left join usergroups on users.uid = usergroups.uid left join groups on groups.gid = usergroups.gid  where users.hash = '" . $_GET['login'] . "' limit 1");
        while ($row = mysql_fetch_object($result)) {

            session_start();

            $_SESSION['username'] = $row->username;
            $_SESSION['md5password'] = md5($row->password);
            $_SESSION['isAdmin'] = $row->isAdmin;
            $_SESSION['login'] = 1;
            $_SESSION['uid'] = $row->uid;
            $_SESSION['logintime'] = time();

            $sql = "UPDATE users set lastlogin = now() where uid = " . $row->uid;
            mysql_query($sql);

            header('Location: ./index.php?login='.$_GET['login']);
            exit;
        }
    }

    if (isset($_POST['cmd']) && isset($_POST['login_username']) && isset($_POST['login_password'])) {
        if (strlen($_POST['login_username']) > 0 && strlen($_POST['login_password']) > 0) {
            $result = mysql_query("SELECT users.uid,password, grpname, isAdmin from users left join usergroups on users.uid = usergroups.uid left join groups on groups.gid = usergroups.gid  where username = '" . $_POST['login_username'] . "' limit 1");
            while ($row = mysql_fetch_object($result)) {
                if ($row->password == md5($_POST['login_password'])) {
                    session_start();

                    $_SESSION['username'] = $_POST['login_username'];
                    $_SESSION['md5password'] = md5($_POST['login_password']);
                    $_SESSION['isAdmin'] = $row->isAdmin;
                    $_SESSION['login'] = 1;
                    $_SESSION['uid'] = $row->uid;
                    $_SESSION['logintime'] = time();

                    $sql = "UPDATE users set lastlogin = now() where uid = " . $row->uid;
                    mysql_query($sql);

                    if(isset($_POST['referer']) && $_POST['referer'] != "")
                        header('Location:'.$_POST['referer']);
                    else
                        header('Location: ./index.php');
                    exit;
                }
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="apple-touch-icon" href="../img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

        <script src="./js/ratchet.js"></script>
        <script src="./js/standalone.js"></script>

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Anmelden</title>
    </head>
    <body>
        <header class="bar-title">
            <h1 class="title">Anmelden</h1>
        </header>

        <div class="content">
            <div class="content-padded">
              <p class="welcome">&nbsp;</p>
            </div>
            <form class="loginform" action="login.php" method="post" name="loginform">
                <ul class="list inset">
                    <li class="login">
                        <input type="text" name="login_username" placeholder="Benutzername" autofocus>
                    </li>
                    <li class="login">
                        <input type="password" name="login_password" placeholder="Passwort">
                    </li>
                </ul>

                <input type="hidden" name="cmd" value="login">

                <div class="content-padded">
                  <a class="button-block" href="#" onclick="javascript:document.loginform.submit();">Anmelden</a>
                </div>
            </form>

          </div>
    </body>
</html>
