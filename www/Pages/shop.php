<?php
/*
 * shop.php :ショップ画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 * 
 * $getTheme :取得してきたテーマ(1,2,3が入ってる)
 * 
*/

    require_once './commonParts/functions.php';
    loginBi();//ログインしていなければログインページへ遷移
    $user = $_SESSION['logined'];


    if(@$_POST['point']){
        //usersからpointを100減らす
        $dbh = dbInit();
        $sql2 = "UPDATE users SET point=point-100 WHERE id = :id"; //セッションのIDとデータベースのidを照合
        $sth = $dbh->prepare($sql2);
        $exc = $sth->execute([
            'id' => $user["id"], //セッションのID
        ]);
        $rows2 = $sth->fetchAll();

        //shop_infoからデータを取得
        $getTheme = (integer)filter_input(INPUT_POST, 'theme');
        $dbh = dbInit();
        //セッションのIDとデータベースのuser_idを照合
        if($getTheme > 0){ //未所持の0
        $sql = "UPDATE shop_info SET theme{$getTheme}=1 WHERE user_id = :user_id"; //所持済みの１
        $sth = $dbh->prepare($sql);     //shop_infoテーブルの中のすべての列を検索
        $exc = $sth->execute([
            'user_id' => $user["id"], //セッションのID
        ]);
        $rows = $sth->fetchAll();
    }}

    //shop_infoからデータを取得
    $dbh = dbInit();
    //セッションのIDとデータベースのuser_idを照合
    $sql = "SELECT * FROM shop_info WHERE user_id = :user_id";
    $sth = $dbh->prepare($sql);     //shop_infoテーブルの中のすべての列を検索
    $exc = $sth->execute([
        'user_id' => $user["id"] //セッションのID
    ]);
    $rows = $sth->fetchAll();
    


    //usersからpointを取得
    $dbh = dbInit();
    //セッションのIDとデータベースのidを照合
    $sql2 = "SELECT point FROM users WHERE id = :id";
    $sth = $dbh->prepare($sql2);
    $exc = $sth->execute([
        'id' => $user["id"] //セッションのID
    ]);
    $rows2 = $sth->fetchAll();

    $theme[1] = $rows[0]["theme1"];
    $theme[2] = $rows[0]["theme2"];
    $theme[3] = $rows[0]["theme3"];
?>
<?php
$pageTitle = "ショップ";
$h1 ="ショップ";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <script>
                
                function imgClick(theme){ //画像がクリックされた時
                    if(<?= $rows2[0]["point"] ?> < 100){ //ポイント数が100より小さい時にポイントが足らないアラート
                        alert('ポイントが足りません（所持ポイント数：<?= $rows2[0]["point"] ?>pt）');
                    }
                    else{
                        var result = confirm('購入しますか？（購入後のポイント数：<?= $rows2[0]["point"] -100 ?>pt）');
                        if(result){
                            $('#theme').val(theme);
                            $('#themeForm').submit();
                        }
                    }
                }
            </script>
            <h2>カスタムテーマショップ</h2>
                <p>所持ポイント：<?= $rows2[0]["point"] ?>pt</p>
                <a href="custom.php">カスタム</a><br />
                <?php
                //未所持のカスタムテーマの表示。ユーザーのが未所持のカスタムテーマを表示する。参照先：shop_infoテーブル
                    foreach($theme as  $key => $value){
                        if(!empty($value)){  //0(未所持)の場合のみ表示
                            continue;
                        }
                        echo "<img src='../images/theme{$key}.png ' alt='theme{$key}' name='{$key}' width='500' height='280' onclick='imgClick({$key})' />" . 
                        "<p>theme{$key}:100pt</p>" ;   
                    }
                ?>
                <form id="themeForm" method="post"> <!-- 自分に送ってる -->
                    <input type="hidden" id="theme" name="theme" value="">
                    <input type="hidden" id="point" name="point" value="-100">
                </form>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>