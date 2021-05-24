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
    if($_SESSION['logined']['email'] == 'admin@sr-co.co.jp'){//もしセッションの中身が管理者の情報ならadmin.phpに飛ぶ。
        header('Location:../admin.php');
    }else{
        header('Location:../top.php');//もしセッションの中身が管理者の情報ではないなら、top.phpに飛ぶ。
    }