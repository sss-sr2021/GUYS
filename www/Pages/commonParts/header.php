<?php
/*
 * header.php :ヘッダー部分の共通化
 * 
 * Author:伊藤明洋
 * Version :0.0.2
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 * Update :2021.05.20 秦(<script></script>の追加)
 * 
 * 
*/
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
        <header>
            <img src="" alt="ロゴ画像" />
            <h1><?= $h1 ?></h1>
            <a href ="createAccount.php">アカウント作成</a>
                <nav>
                    <ul>
                        <li><a href="top.php">TOP</a></li>
                        <li><a href="myPage.php">マイページ</a></li>
                        <li><a href="login.php">ログイン/ログアウト</a></li>
                    </ul>
                </nav>
        </header>