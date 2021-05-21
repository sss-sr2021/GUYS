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
    session_start();
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $user = $_SESSION['logined'];
    $today = date("Y-m-d");
    if(!empty($_POST['submit'])){ //もしsubmitが押されれば以下を実行する
        $dbh = dbInit();  //functionsからデータベースとの接続関数を持ってくる
        if(!empty($_SESSION["logined"][$today]) || $_SESSION["logined"][$today] ===''){     //もしテーブルの今日の日付の値が空だったらインサート、値があれば変更
            $sth = $dbh-> prepare(
                'UPDATE mileage SET mileage = :mileage WHERE user_id = :user_id and date = :date'  //条件が二つあるときはandを使う 
            );
            $ret = $sth->execute([
                'date' => $today,
                'mileage' => filter_input(INPUT_POST,'mileage'),
                'user_id' => filter_input(INPUT_POST,$user['id'])
            ]);
        }
        else{
            $sth = $dbh-> prepare(
                "INSERT INTO mileage(user_id,date,mileage)values(:user_id,:date,:mileage)" //mileageテーブルのuser_id,date,mileageを追加
            );
            $ret = $sth->execute([
                'date' => $today, //dateに今日の日付を入れる
                'mileage' => filter_input(INPUT_POST,$name),  //mileageに入力された値を入れる
                'user_id' => filter_input(INPUT_POST,$user['id']) //user_idにidを値を入れる
            ]);
        }
        $_SESSION["logined"][$today] = filter_input(INPUT_POST,'mileage');   //sessionに日付を入れる、もしmileageの値が空だったらインサートだけ起こるから値を入れる
        $ok=true; //成功したので、trueにする。
    }
    else{
        "";
    }
?>
<?php
$pageTitle = "マイページ";
$h1 ="マイページ";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>
                <?= $user['name']?>さん
            </h2>
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
                    <p><input type="number" name="mileage">km</p>
                    <p><input type="submit" name="submit" value="送信"></p>
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
        <script>
            //変更した場合のみアラート表示
            <?php if($ok){ ?>  //$okがtrueの時だけアラート
            alert('変更しました'); 
            location.href = 'myPage.php';
            <?php } ?>
        </script>
<?php
include('./commonParts/footer.php');
?>