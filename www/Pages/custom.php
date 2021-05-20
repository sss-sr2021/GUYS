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
$pageTitle = "カスタム";
$h1 ="カスタム";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>カスタムテーマ</h2>
                <p>現在のテーマ：<span >/p> <!-- 設定されている現在のテーマ名を表示する。参照先：userテーブル(currentTheme) -->
                <a href="shop.php">ショップ</a>
                <img src="" alt="theme1" /> <!-- ユーザーのが所持済のカスタムテーマを表示する。参照先：shopInfoテーブル -->
                <p>theme1</p>
                <img src="" alt="theme2" />
                <p>theme2</p>
                <img src="" alt="theme3" />
                <p>theme3</p>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>