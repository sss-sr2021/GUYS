<?php
/*
 * shop.php :ショップ画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "ショップ";
$h1 ="ショップ";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>カスタムテーマショップ</h2>
                <p>所持ポイント：〇〇pt</p>
                <a href="custom.php">カスタム</a>
                <img src="" alt="theme2" /> <!-- 未所持のカスタムテーマの表示。ユーザーのが未所持のカスタムテーマを表示する。参照先：shopInfoテーブル -->
                <p>theme2：100pt</p>
                <img src="" alt="theme3" />
                <p>theme3：100pt</p>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>