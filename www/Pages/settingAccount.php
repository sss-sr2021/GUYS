<?php
/*
 * settingAccount.php :アカウント情報変更ページ画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.20
 * Update :
 * 
 * 
*/

    require_once './commonParts/functions.php';
    loginBi();//ログインしていなければログインページへ遷移
?>
<?php
$pageTitle = "アカウント設定";
$h1 ="アカウント設定";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>

        <div class="block">
            <h2>アカウント設定一覧</h2>
                <a href="changeProfile.php">▶プロフィール情報変更ページ</a><br />
                <a href="changeMail.php">▶メールアドレス変更ページ</a><br />
                <a href="changePassword.php">▶パスワード変更ページ</a><br />
                <a href="deleteAccount.php">▶アカウント削除ページ</a>
        </div>

        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>