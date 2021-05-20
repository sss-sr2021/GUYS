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
$pageTitle = "ログイン";
$h1 ="ログイン";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>アカウント作成フォーム</h2>
            <p>メールアドレス：</p>
            <input type="email" name="email" require><br />
            <p>パスワード：</p>
            <input type="password" name="password" require><br />
            <p>お名前：</p>
            <input type="text" name="name" require><br />
            <p>性別：</p>
            <label><input type="radio" name="gender" value="1" />男</label>
            <label><input type="radio" name="gender" value="2" />女</label>
            <label><input type="radio" name="gender" value="3" />その他</label>
            <br />
            <!-- 作成ボタン　-->
            <input type="submit" name="create" value="作成">
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>