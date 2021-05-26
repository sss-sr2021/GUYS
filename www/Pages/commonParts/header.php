<?php
/*
 * header.php :ヘッダー部分の共通化
 * 
 * Author:伊藤明洋
 * Version :0.0.2
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 * Update :2021.05.20 秦(<script></script>の追加)
 * Update :2021.05.21 秦(ログイン/ログアウトの分岐追加)
 *         2021.05.23 花岡//ログイン・ログアウトの分岐の明示化
 *                        //未ログイン時のみアカウント作成リンク表示
 *         2021.05.25 花岡//管理者ページリンク(管理者のみ)の追加
 *         2021.05.26 秦//SEOの追加
 * 
 *  $_SESSION['theme']:現在の設定テーマ
 * 
*/
require_once './commonParts/functions.php';
@session_start();
if(empty(@$_SESSION['theme'])){
    $_SESSION['theme']=1;//theme初期値
}


?>

<!DOCTYPE html>
<html>
    <!--
        div class="wrapper" :全体
        div class="container" :mainの中
    -->
<head>
    <title><?= $pageTitle ?></title>
    <meta charset="utf-8">
    <meta name="robots" content="index,follow">
    <meta name=“description” content="輝く明日へGO！あなたの健康への第一歩を後押しする。あなたの頑張りを入力するだけ。健康のために走った距離、歩いた距離を日々、入力するだけで自分がどれくらいの距離を進んだのか一目で分かる。">
    <meta name="keywords" content="リサーチGO！,健康,頑張り">
    <script src="/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="./commonParts/pcStyle/style<?=$_SESSION['theme']?>.css" media="screen and (min-width:768px)"/> 
    <link rel="stylesheet" href="./commonParts/spStyle/style<?=$_SESSION['theme']?>.css" media="screen and (max-width:767px)"/> 
    
    <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body class="<?php if(!empty($_SESSION['logined'])){ ?> logined <?php } ?>">
    <div class='wrapper'>
        <header style="">

            <div class="head">
                <a href="top.php"><img src="../images/logo.png" alt="ロゴ画像" width="100px" height="100px"/></a>
                <div class="title">
                    <h1><?= $h1 ?></h1>
                </div>
                <div class="create">
                    <?php //if(empty($_SESSION['logined'])):?><!--ログインしていなければ-->
                    <a href ="createAccount.php">アカウント作成</a>
                </div>
                
            </div>

            <?php //endif;?>

                <nav>
                <div class="menu">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
                    <ul class="nav-links">
                        <li><a href="top.php">TOP</a></li>
                        <li><a href="./commonParts/myPagebifurcation.php">マイページ</a></li>
                        <?php if(empty($_SESSION['logined'])):?><!--ログインしていなければ-->
                            <li><a href="./commonParts/loginout.php">ログイン</a></li>
                        <?php else:?><!--ログインしていれば-->
                            <li><a href="./commonParts/loginout.php">ログアウト</a></li>
                        <?php endif;?>
                        <?php if(@$_SESSION['logined']['email']=="admin@sr-co.co.jp"):?>
                            <li><a href="./admin.php">管理者ページ</a></li>
                        <?php endif;?>
                    </ul>
                </nav>

            <script>
                const menu = document.querySelector('.menu');
                menu.addEventListener('click', function() {
                this.classList.toggle('toggle');
                });
            </script>
        </header>