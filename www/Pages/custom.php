<?php
/*
 * shop.php :ショップ画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 * 
 * $theme :テーマを1(所持)か0(未所持)かで入れる
 * 
*/

    require_once './commonParts/functions.php';
    loginBi();//ログインしていなければログインページへ遷移
    $user = $_SESSION['logined'];
    //shop_infoからデータを取得
    $dbh = dbInit();
    //セッションのIDとデータベースのuser_idを照合
    $sql = "SELECT * FROM shop_info WHERE user_id = :user_id";
    $sth = $dbh->prepare($sql);     //shop_infoテーブルの中のすべての列を検索
    $exc = $sth->execute([
        'user_id' => $user["id"] //セッションのID
    ]);
    $rows = $sth->fetchAll();

    //usersからcurrent_themeを取得
    $dbh = dbInit();
    //セッションのIDとデータベースのidを照合
    $sql2 = "SELECT current_theme FROM users WHERE id = :id";
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
$pageTitle = "カスタム";
$h1 ="カスタム";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>カスタムテーマ</h2>
                <p>現在のテーマ：theme<?= $rows2[0]["current_theme"] ?> </p> <!-- 設定されている現在のテーマ名を表示する。参照先：userテーブル(currentTheme) -->
                <a href="shop.php">ショップ</a><br />
                <?php
                //ユーザーのが所持済のカスタムテーマを表示する。参照先：shop_infoテーブル
                    foreach($theme as  $key => $value){
                        if(empty($value)){  //空(0(未所持))だったらスキップして次のthemeの処理へ
                            continue;
                        }
                        echo "<img src='../images/theme{$key}.png'  alt='theme{$key}'width='500'height='280' />" . 
                        "<p>theme{$key}</p>" ;
                    }
                ?>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>