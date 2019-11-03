<?php
    require_once './core/Loader.php';
    header("Access-Control-Allow-Origin: *");
    $application = new Application($_GET);
    $result=$application->run();
    //var_dump($_GET);
    echo $result;
    
?>
