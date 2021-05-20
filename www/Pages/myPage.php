<?php
/*
 * myPage.php :マイページ画面
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
$pageTitle = "マイページ";
$h1 ="マイページ";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>マイページ</h2>
                <div class="MENU">
                    <h3>MENU</h3>
                    <a href="top.php">▶トップページ</a><br />
                    <a href="ranking.php">▶ランキング</a><br />
                    <a href="shop.php">▶ショップ</a><br />
                    <a href="custom.php">▶カスタム</a><br />
                    <a href="settingAccount.php">▶アカウント設定</a><br />
                    <a href="">ログアウト</a>
                </div>
                <div class="mile">
                    <h3>入力フォーム</h3>
                    <p>今日のマイル</p>
                    <p><input type="number" name="mile">km</p>
                </div>
                <div class="user">
                    <!--  後々データベースからもってくる、下は仮 階級はif文？？-->
                        ・〇〇ポイント<br />
                        ・〇〇km<br />
                        ・〇〇級
                    <p>●階級一覧</p>
                        <ul name='rank'>
                            <li>0km → お散歩級</li>
                            <li>42km → フルマラソン級</li>
                            <li>200km → 琵琶湖１周級</li>
                            <li>500km → 北海道１周級</li>
                            <li>1200km → 四国１周級</li>
                            <li>2500km → 日本縦断級</li>
                            <li>6400km → アマゾン川級</li>
                            <li>8800km → 万里の長城級</li>
                            <li>1万2千km → 日本１周級</li>
                            <li>4万km → 地球１周級</li>
                            <li>36万km → 月まで級</li>
                        </ul>
                </div>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>