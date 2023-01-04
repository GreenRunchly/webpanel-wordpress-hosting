<?php

    /// Load Config (Diperlukan)
    require('../oneconfig.php');

    $thispath = realpath(dirname(__FILE__));    
    $boompath = explode('/',$thispath);    
    $topath = ONEPANEL_ROOT_DIR;

    if (!empty($_POST['transferurl'])){

        $url = $_POST['transferurl'];
        
        if (!empty($_POST['transferdir'])){
            $newtopath = ($_POST['transferdir']);
        }else{
            $newtopath = $topath.'/'.basename($url);
        }
        
        print_r(terminalCurl($url,$newtopath));
        
    }

    function terminalCurl($url,$saveto){
        $output=null; $resultCode=null;
        exec("curl --output '".$saveto."' --create-dirs '".$url."'", $output, $resultCode);
        return $output;
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
<?php echo $topath; ?>
    <form method="post">
        <input type="url" name="transferurl"><br>
        <input type="text" name="transferdir" placeholder="Awali dengan garing (/)"><br>
        <input type="submit" value="Download">
    </form>
</body>
</html>