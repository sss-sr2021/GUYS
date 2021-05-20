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
?>
<?php
$pageTitle = "アカウント設定";
$h1 ="アカウント設定";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>アカウント設定一覧</h2>
                <ul class="">
                    <li><a href="changeProfile.php">プロフィール情報変更ページ</a></li>
                    <li><a href="changeMail.php">メールアドレス変更ページ</a></li>
                </ul>
                <ul class="">
                    <li><a href="changePassword.php">パスワード変更ページ</a></li>
                    <li><a href="deleteAccount.php">アカウント削除ページ</a></li>
                </ul>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>