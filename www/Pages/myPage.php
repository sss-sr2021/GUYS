<?php
/*
 * login.php :マイページ画面
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
                        <select name='rank'>
                            <option value='1'>0km → お散歩級</option>
                            <option value='2'>42km → フルマラソン級</option>
                            <option value='3'>200km → 琵琶湖１周級</option>
                            <option value='4'>500km → 北海道１周級</option>
                            <option value='5'>1200km → 四国１周級</option>
                            <option value='6'>2500km → 日本縦断級</option>
                            <option value='7'>6400km → アマゾン川級</option>
                            <option value='8'>8800km → 万里の長城級</option>
                            <option value='9'>1万2千km → 日本１周級</option>
                            <option value='10'>4万km → 地球１周級</option>
                            <option value='11'>36万km → 月まで級</option>
                        </select>
                </div>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>