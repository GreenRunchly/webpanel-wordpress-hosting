<?php

    /// Configuration Server Panel
    define("ONEPANEL_IP", $_SERVER['SERVER_ADDR']);
    define("ONEPANEL_DOMAIN", $_SERVER['SERVER_NAME']);
    define("ONEPANEL_FILE_USER", 'qiktLwHNDmP9bN');
    define("ONEPANEL_FILE_PASS", 'wrrDZDnuDQvUig');
    define("ONEPANEL_DB_NAME", 'sILD7tOWWpiGyl');
    define("ONEPANEL_DB_USER", 'sILD7tOWWpiGyl');
    define("ONEPANEL_DB_PASS", 'EfeSWwuexGtMX5');
    define("ONEPANEL_DB_HOST", 'localhost:3306');
    
    /// User Login Panel
    define('ONEPANEL_ADMIN_USER','rizki'); // Username untuk masuk
    define('ONEPANEL_ADMIN_PASS','Juancok1878'); // Password untuk masuk
    
    /// Sub Website GIT Sync
    /// NOTE : Direktori yang dipilih akan TERHAPUS sepenuhnya, jadi harap perhatikan direktori mana yang dipilih
    /// dan jangan buat perubahan apapun secara manual, lakukan pada repository github mu.
    /// tidak ada mode push pada fitur ini, hanya ada pull (menarik master zip file) pada repo agar lebih mudah 
    /// ikuti format repo dibawah, KEY = folder pada root, VALUE = url repo yang akan di sync
    define("ONEPANEL_GITSYNC", array(
        "" => "https://github.com/GreenRunchly/livesite-playcirclescolors-my-id",
        "nh" => "https://github.com/GreenRunchly/livesite-nhentai-my-id"
    ));

    //define("ONEPANEL_GITSYNC_DIR", realpath(dirname(__FILE__)));
    define("ONEPANEL_GITSYNC_DIR", mendapat_direktori_root());

    define("ONEPANEL_ROOT_DIR", mendapat_direktori_root().'/public_html');

    function mendapat_direktori_root(){
        $thispath = realpath(dirname(__FILE__));    
        $boompath = explode('/',$thispath);    
        return str_ireplace(array('/'.$boompath[count($boompath)-1],'/'.$boompath[count($boompath)-2]), "", $thispath);
    }