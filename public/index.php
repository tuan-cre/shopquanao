<?php

    require("../model/database.php");
    require("../model/danhmuc.php");
    require("../model/mathang.php");

    $dm = new DANHMUC();
    $danhmuc = $dm->laydanhmuc();
    $mh = new MATHANG();    
    // $mathangnoibat = $mh->laymathangxemnhieu();

    if(isset($_REQUEST["action"])){
        $action = $_REQUEST["action"];
    }
    else{
        $action="null"; 
    }

    switch($action){
        case "null": 	
            $mathang = $mh->laymathang();
            include("main.php");
            break;
        // case "group":
        //     if(isset($_REQUEST["id"])){
        //         $id = $_REQUEST["id"];
        //         $danhmuctheoID = $dm->laydanhmuctheoid($id);
        //         $tendanhmuc = $danhmuctheoID['tendanhmuc'];
        //         $mathang = $mh->laymathangtheodanhmuc($id);
        //         include("group.php");
        //     }
        //     else{
        //         include("main.php");
        //     }
        //     break;
        // case "detail":
        //     if(isset($_GET["id"])){
        //         $mahang = $_GET["id"];
        //         $mh->tangluotxem($mahang);
        //         $mhct = $mh->laymathangtheoid($mahang);
        //         $madm = $mhct["danhmuc_id"];
        //         $mathang = $mh->laymathangtheodanhmuc($madm);
        //         include("detail.php");
        //     }
        //     break;
        default:
            break;
    }
?>
