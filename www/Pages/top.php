<?php
/*
 * functions.php :共通関数
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * Update :2021.05.19
 * 
 * 
*/

    require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
 <head><meta charset="utf-8"></head>
 <title>トップページ</title>
 <body>
     <div class='wrapper'>
        <header>
            <img src="" alt="ロゴ画像" />
            <h1>リサーチGO！</h1>
            <a href ="createAccount.php">アカウント作成</a>
                <nav>
                    <ul>
                        <li><a href="top.php">TOP</a></li>
                        <li><a href="myPage.php">マイページ</a></li>
                        <li><a href="login.php">ログイン/ログアウト</a></li>
                    </ul>
                </nav>
        </header>
     <div class='container'>
         <main>
            <img src="" alt="背景画像" />
            <p>機能紹介</p>
         </main>
     </div>
        <footer>
            <a href="top.php">TOP</a>
            <a href="company.php">漢委員会</a>
            <a href="privacy.php">プライパシーポリシー</a>
            <p>Copyright © 2021 チーム漢. All rights reserved.</p>
        </footer>
     </div>
 </body>
</html>