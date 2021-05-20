<?php
/*
 * createAccount.php :アカウント作成画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.19
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "アカウント作成";
$h1 ="アカウント作成";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>アカウント作成</h2>
                <form action="" method="post">
                    <p>メールアドレス：<input type="email" name="email" require></p>
                    <p>パスワード：<input type="password" name="password" require></p>
                    <p>お名前：<input type="text" name="name" require></p>
                    <p>性別：
                    <label><input type="radio" name="gender" value="1" />男</label>
                    <label><input type="radio" name="gender" value="2" />女</label>
                    <label><input type="radio" name="gender" value="3" />その他</label>
                    </p>
                    <!-- 作成ボタン　-->
                    <input type="submit" name="create" value="作成">
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>