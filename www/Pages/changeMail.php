<?php
/*
 * login.php :メールアドレス変更画面
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
$pageTitle = "メールアドレス変更";
$h1 ="メールアドレス変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>メールアドレス変更</h2>
                <form action="" method="post">
                    <p>新しいメールアドレス：<input type="email" name="email" require></p>
                    <p>新しいメールアドレス：<br /> （確認のためもう一度） <input type="email" name="email" require></p>
                    <p>パスワード：<input type="password" name="password" require></p>
                    <p><input type="submit" name="submit" value="変更"></p>
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>