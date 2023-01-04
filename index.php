<?php
    
    /// Load Config (Diperlukan)
    require('oneconfig.php');

    ///Login Auth
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
          || ($_SERVER['PHP_AUTH_USER'] != ONEPANEL_ADMIN_USER) 
          || ($_SERVER['PHP_AUTH_PW'] != ONEPANEL_ADMIN_PASS)) { 
        header('HTTP/1.1 401 Unauthorized'); 
        header('WWW-Authenticate: Basic realm="One Panel Login Page"'); 
        exit("Akses ditolak, username dan password diperlukan."); 
    } 

    ///Check Protocol
    $OnePanelProtocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    if ($OnePanelProtocol == 'https://'){
        define("ONEPANEL_SECURITY_PROTOCOL", 'Secured');
    }else{
        define("ONEPANEL_SECURITY_PROTOCOL", 'Unsecured');
    }

?>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="One Web Panel">
    <meta name="author" content="GreenRunchly">
    
    <title>One Web Panel</title>

    <link rel="icon" href="favicon.ico">
    
    <!--- Style --->
    <link rel="stylesheet" href="css/style.css?ver=22"/>
    <link rel="stylesheet" href="css/icons/web/css/all.css?ver=1"/>
    
    <!--- Script --->
    <script src="js/jquery-3.5.1.min.js"></script>
    
</head>
<body>
    <div class="app-main">
        <h1>One Web Panel</h1><br>
        <h4><?php echo ONEPANEL_IP; ?> - <?php echo ONEPANEL_ROOT_DIR; ?> - <?php echo ONEPANEL_SECURITY_PROTOCOL; ?></h4>
        <br>
        <div class="rak">
            <div class="rak-box">
                <i class="fas fa-folders"></i> 
                <div class="sub-rak-box">
                    <a href="filemanager" target="_blank"><h2>File Manager</h2></a><br>
                    <p>
                        <span>User : <?php echo ONEPANEL_FILE_USER; ?></span><br>
                        <span>Pass : <?php echo ONEPANEL_FILE_PASS; ?></span>
                    </p>
                </div>
            </div>
            <div class="rak-box">
                <i class="fas fa-database"></i> 
                <div class="sub-rak-box">
                    <a href="phpmyadmin" target="_blank"><h2>phpMyAdmin</h2></a><br>
                    <p>
                        <span>User : <?php echo ONEPANEL_DB_USER; ?></span><br>
                        <span>Pass : <?php echo ONEPANEL_DB_PASS; ?></span><br>
                        <span>Host : <?php echo ONEPANEL_DB_HOST; ?></span>
                    </p>
                </div>
            </div>
            <div class="rak-box">
                <i class="fas fa-cogs"></i>
                <div class="sub-rak-box">
                    <a><h2>Tools</h2></a><br>
                    <p>
                        <span><a href="tools/remote-download-curl.php" target="_blank">Remote Download</a></span><br>
                        <span><a href="tools/remote-git.php" target="_blank">Sync GIT</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
