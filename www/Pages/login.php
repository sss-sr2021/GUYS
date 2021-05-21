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
    session_start();
        $email=filter_input(INPUT_POST, 'email');
        $pass=filter_input(INPUT_POST, 'password');
    if(!empty($_POST['submit'])){
        $dbh = dbInit();
        $user = getLoginUser(['email' => $email]);//usesテーブルの中のすべての列の中からemailの列を検索している
            if(password_verify($pass,$user['pass'])){//passwordを照合して一致すれば、myPage.phpに飛ぶ
                header('Location:myPage.php');
            }else{
                echo 'ログインできません';
            }
    }

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
                    <p>メールアドレス：<input type="email" name="email" required></p>
                    <p>パスワード：<input type="password" name="password" required></p>
                    <p><input type="submit" name="submit" value="ログイン"></p>
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>