<?php
    
    /// Load Config (Diperlukan)
    require('../oneconfig.php');

    // Function to remove folders and files 
    function git_remove($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file){
                if ($file != "." && $file != ".." && $file != "web-panel") git_remove("$dir/$file");
                rmdir($dir);
            }
        }
        else if (file_exists($dir)) unlink($dir);
    }

    // Function to remove folders and files 
    function git_remove_safe($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file){
                if (ONEPANEL_GITSYNC[$file]){
                    if ($file != "." && $file != ".." && $file != "web-panel") git_remove_safe("$dir/$file");
                    rmdir($dir);
                    //echo '['.ONEPANEL_GITSYNC[$file].']';
                }
            }
        }
        else if (file_exists($dir)) unlink($dir);
    }

    // Function to Copy folders and files       
    function git_copy_safe($src, $dst) {
        if (file_exists ( $dst ))
            git_remove_safe ( $dst );
        if (is_dir ( $src )) {
            mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    git_copy_safe ( "$src/$file", "$dst/$file" );
        } else if (file_exists ( $src ))
            copy ( $src, $dst );
    }

    $thispath = realpath(dirname(__FILE__));    
    $boompath = explode('/',$thispath);    
    $topath = str_ireplace(array('/'.$boompath[count($boompath)-1],'/'.$boompath[count($boompath)-2]), "", $thispath);
    $topath = ONEPANEL_ROOT_DIR;

    if (!empty(ONEPANEL_GITSYNC)){
        
        foreach (ONEPANEL_GITSYNC as $dirrepo => $urlrepo){

            $inputrepo = $urlrepo; //$inputrepo = "https://github.com/GreenRunchly/livesite-playcirclescolors-my-id";
            
            $boomrepo = explode('/',$inputrepo);
            $repo = $boomrepo[count($boomrepo) - 1];
    
            $pulledfile = file_put_contents($repo.".zip", fopen($inputrepo."/archive/refs/heads/master.zip", 'r'), LOCK_EX);
            if ($pulledfile == true){
                $zip = new ZipArchive;
                $openedzipfile = $zip->open($repo.".zip");
                if ($openedzipfile == true) {
                    $zip->extractTo($thispath.'/temp');
                    $zip->close();
                    $templistingfolder = scandir($thispath.'/temp');
                    $templistingfolder = array_diff($templistingfolder, array('.', '..'));
                    $templistingfolder = array_values($templistingfolder);
    
                    foreach ($templistingfolder as $key => $value) {
                        ///echo($thispath.'/temp/'.$value);
                        git_copy_safe($thispath.'/temp/'.$value, $topath.'/'.$dirrepo );
                        git_remove($thispath.'/temp/'.$value);
                    }
                    unlink($repo.".zip");
                    ///git_copy_safe($thispath.'/'.$repo.'-main' , $thispath.'/extracted' );
                }
                //print_r($templistingfolder);
                echo("Sync Complete [".$repo."] [".$topath.'/'.$dirrepo."]<br>");
            }else{
                echo("Sync Failed [".$repo."] [".$topath.'/'.$dirrepo."]<br>");
            }

        }  

    }
    //print_r($thispath);
?>