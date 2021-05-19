<?php
/*
 * createAccount.php :アカウント作成画面
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
    <!--
        div class="wrapper" :全体
        div class="container" :mainの中
    -->
 <head><meta charset="utf-8"></head>
 <title>トップページ</title>
 <body>
     <div class='wrapper'>
        <header>
            <img src="" alt="ロゴ画像" />
            <h1>アカウント作成</h1>
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
            <h2>アカウント作成フォーム</h2>
            <p>メールアドレス：</p>
            <input type="email" name="email"><br />
            <p>パスワード：</p>
            <input type="password" name="password"><br />
            <p>お名前：</p>
            <input type="text" name="name"><br />
            <p>性別：</p>
            <label><input type="radio" name="gender" value="1" />男</label>
            <label><input type="radio" name="gender" value="2" />女</label>
            <label><input type="radio" name="gender" value="3" />その他</label>
            <br />
            <!-- 作成ボタン　-->
            <input type="submit" name="create" value="作成">
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