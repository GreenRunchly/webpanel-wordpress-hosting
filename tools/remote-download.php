<?php

    /// Load Config (Diperlukan)
    require('../oneconfig.php');

    $thispath = realpath(dirname(__FILE__));    
    $boompath = explode('/',$thispath);    
    $topath = str_ireplace(array('/'.$boompath[count($boompath)-1],'/'.$boompath[count($boompath)-2]), "", $thispath);

    if (!empty($_POST['transferurl'])){

        $url = $_POST['transferurl'];
        
        if (!empty($_POST['transferdir'])){
            $newtopath = ($_POST['transferdir']);
        }

        /// Pull file dan simpan dimana skrip berada
        $pulledfile = file_put_contents($topath.'/'.basename($url), fopen($url, 'r'), LOCK_EX);
        if ($pulledfile == true){
            die("Saved in [".$topath.'/'.basename($url)."]");
        }else{
            die("Failed");
        }
        
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Remote</title>
</head>
<style>
form input{
width:100%;
}
</style>
<body>
    <form method="post">
        <input type="url" name="transferurl"><br>
        <input type="submit" value="Download">
    </form>
</body>
</html>