<?php
/*

toAdmin.php:削除したときにadmin.phpに戻る。

Author:秦伊吹
Version:0.0.1
Created:2021.05.24（）
updated:

*/


    require_once './functions.php';
    session_start();
    if($_SESSION['logined']['id'] == 4){
        header('Location:../admin.php');
    }else{
        header('Location:../top.php');
    }