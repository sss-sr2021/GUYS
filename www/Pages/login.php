<?php
/*
 * login.php :ログイン画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.19
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "ログイン";
$h1 ="ログイン";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>ログイン</h2>
                <form action="" method="post">
                    <p>メールアドレス：<input type="email" name="email" require></p>
                    <p>パスワード：<input type="password" name="password" require></p>
                    <p><input type="submit" name="submit" value="ログイン"></p>
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>