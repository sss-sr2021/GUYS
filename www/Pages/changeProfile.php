<?php
/*
 * login.php :プロフィール情報変更画面
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
$pageTitle = "プロフィール情報変更";
$h1 ="プロフィール情報変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>プロフィール情報変更</h2>
                <form action="" method="post">
                    <p>お名前：<input type="text" name="email" require></p>
                    <p>性別：
                    <label><input type="radio" name="gender" value="1" />男</label>
                    <label><input type="radio" name="gender" value="2" />女</label>
                    <label><input type="radio" name="gender" value="3" />その他</label>
                    </p>
                    <p>パスワード：<input type="password" name="password" require></p>
                    <p><input type="submit" name="submit" value="変更"></p>
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>