<?php
/*
 * login.php :ログイン画面
 * 
 * Author:秦伊吹
 * Version :0.0.2
 * create :2021.05.19
 * Update :2021.05.22 花岡//誤字修正:uses→users
 *         2021.05.23 花岡//DBに存在しないメールアドレスが入力されたとき、エラーメッセージを表示するように修正
 *         2021.05.24 秦//管理者ならadmin.phpに飛ぶように変更
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
        $email=filter_input(INPUT_POST, 'email');
        $pass=filter_input(INPUT_POST, 'password');
        $message="";//エラーメッセージ
    if(!empty($_POST['submit'])){
        $dbh = dbInit();
        $user = getLoginUser(['email' => $email]);//usersテーブルの中のすべての列の中からemailの列を検索している
        if(!empty($user)){//ログインユーザー情報があれば
            if(password_verify($pass,$user['pass'])){
                //passwordを照合して一致すれば、myPage.phpに飛ぶ
                if($user['email'] == 'admin@sr-co.co.jp'){
                    header('Location:admin.php');
                    //もしidが管理者ユーザーのものならadmin.phpに飛ぶ
                }else{
                header('Location:myPage.php');
                }
            }else{//パスワードが間違っていれば
                logout();
                $message= 'メールアドレスまたはパスワードが違います。';
            }
        }
        else{//ログインユーザー情報がなければ
            logout();
            $user="";
            $message='メールアドレスまたはパスワードが違います。';
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

        <div class="block">
            <h2>ログイン</h2>
            <p><?= $message?></p>
                <form action="" method="post">
                    <p>メールアドレス：<input type="email" name="email" required></p>
                    <p>パスワード：<input type="password" name="password" required></p>
                    <p><input type="submit" name="submit" value="ログイン"></p>
                </form>
        </div>
        
        </main>
     </div>
<?php
include('./commonParts/footer.php');
?>