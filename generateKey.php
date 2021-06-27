<?php 

    $randomInts = array();
    $lenght = 256;
    
    for($x = 0;$x < $lenght;$x++)
    {
        array_push($randomInts,random_int(0,256));
    }

    $nkey = "";

    foreach($randomInts as $int)
    {
        $nkey .= dechex($int); //bytes TO ASCII
    }
    
    $array = str_split($nkey,1);
    $key = "";
    for($x = 0;$x < 256;$x++)
    {
        $key.=$array[$x];
    }

    $array = null;
    $nkey = null;
    $lenght = null;
    $randomInts = null;
    //echo json_encode($key);
?>