<?php
/*
 * changePassword.php :パスワード変更画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "パスワード変更";
$h1 ="パスワード変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>パスワード変更</h2>
                <form action="" method="post">
                    <p>現在のパスワード：<input type="password" name="password" required></p>
                    <p>新しいパスワード：<input type="password" name="password" required></p>
                    <p>新しいパスワード：<br />(確認のためもう一度)<input type="password" name="password" required></p>
                    <p><input type="submit" name="submit" value="変更"></p>
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>