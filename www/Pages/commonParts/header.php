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
 * 
*/

require_once './commonParts/functions.php';

?>

<!DOCTYPE html>
<html>
    <!--
        div class="wrapper" :全体
        div class="container" :mainの中
    -->
 <head>
    <meta charset="utf-8">
    <script src="/jquery-3.6.0.js"></script>
</head>
 <title><?= $pageTitle ?></title>
 <body>
     <div class='wrapper'>
        <header style="">
            <a href="top.php"><img src="../images/logo.png" alt="ロゴ画像" width="80px" height="80px"/></a>
            <h1><?= $h1 ?></h1>
            <?php if(empty($_SESSION['logined'])):?><!--ログインしていなければ-->
                <a href ="createAccount.php">アカウント作成</a>
            <?php endif;?>
                <nav>
                    <ul>
                        <li><a href="top.php">TOP</a></li>
                        <li><a href="./commonParts/myPagebifurcation.php">マイページ</a></li>
                        <?php if(empty($_SESSION['logined'])):?><!--ログインしていなければ-->
                            <li><a href="./commonParts/loginout.php">ログイン</a></li>
                        <?php else:?><!--ログインしていれば-->
                            <li><a href="./commonParts/loginout.php">ログアウト</a></li>
                        <?php endif;?>
                    </ul>
                </nav>
        </header>