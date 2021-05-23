<?php
/*
 * myPage.php :マイページ画面
 * 
 * Author:伊藤明洋
 * Version :0.1.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 *         2021.05.22 花岡(マイレージ入力フォームに初期値今日のマイレージ 最小値0追加)
 *                        (mileageテーブルに追加変更可能に)
 *                        (usersテーブルsum_mileage列の処理の追加)
 * 
 *                         $_SESSION["logined"][$today]:今日のマイレージ
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $user = $_SESSION['logined'];
    $_SESSION['todayMileage'] = 0;//今日のマイレージ
    $today = date("Y-m-d");//今日の日付
    if(!empty($_POST['submit'])){ //もしsubmitが押されれば以下を実行する
        $dbh = dbInit();  //functionsからデータベースとの接続関数を持ってくる
        if(!empty($_SESSION["logined"][$today]) ||@$_SESSION["logined"][$today] ===''){     //もしテーブルの今日の日付の値が空だったらインサート、値があれば変更
            //usersテーブルsumMileageの処理
                //ログインユーザーが今日入力したデータを取得
                    $sth=$dbh->prepare("SELECT mileage FROM mileage WHERE date='$today' AND user_id=:user_id");
                    $exc=$sth->execute([
                        'user_id' => filter_input(INPUT_POST,'user_id')
                    ]);
                    $rows=$sth->fetchAll();
                    echo "過去入力分:{$rows[0]['mileage']}<br />";
                    echo "前合計値：{$user['sum_mileage']}<br />";
                    echo "現在入力分:{$_POST['mileage']}<br />";
                //今日入力したマイレージ分をusersテーブルの合計マイレージから減算して、変更入力分のデータをマイレージを加算
                    $dif = $user['sum_mileage']-@$rows[0]['mileage'];
                    $sum = $dif+filter_input(INPUT_POST,'mileage');//差分+入力マイレージ
                    print_r($sum);
                    $sth = $dbh-> prepare(
                        'UPDATE users SET sum_mileage = :sum_mileage WHERE id = :id' 
                    );
                    $ret = $sth->execute([
                        'sum_mileage' => $sum,
                        'id' => filter_input(INPUT_POST,'user_id')
                    ]);
                    $_SESSION['logined']['sum_mileage']=$sum;//セッションの合計マイレージ列の更新
            //mileageテーブルの更新
                $sth = $dbh-> prepare(
                    'UPDATE mileage SET mileage = :mileage WHERE user_id = :user_id and date = :date'  //条件が二つあるときはandを使う 
                );
                $ret = $sth->execute([
                    'date' => $today,
                    'mileage' => filter_input(INPUT_POST,'mileage'),
                    'user_id' => filter_input(INPUT_POST,'user_id')
                ]);
        }
        else{
            //usersテーブルsumMileageの処理
            $sum = $user['sum_mileage']+filter_input(INPUT_POST,'mileage');//ログインユーザーの累計マイレージ+入力マイレージ
            $sth = $dbh-> prepare(
                'UPDATE users SET sum_mileage = :sum_mileage WHERE id = :id'
            );
            $ret = $sth->execute([
                'sum_mileage' => $sum,
                'id' => filter_input(INPUT_POST,'user_id')
            ]);
            $_SESSION['logined']['sum_mileage']=$sum;//セッションの合計マイレージ列の更新
            //mileageテーブルの追加
            $sth = $dbh-> prepare(
                "INSERT INTO mileage(user_id,date,mileage) values(:user_id,:date,:mileage)" //mileageテーブルのuser_id,date,mileageを追加
            );
            $ret = $sth->execute([
                'date' => $today, //dateに今日の日付を入れる
                'mileage' => filter_input(INPUT_POST,'mileage'),  //mileageに入力された値を入れる
                'user_id' => filter_input(INPUT_POST,'user_id') //user_idにidを値を入れる
            ]);
        }
        $_SESSION["logined"][$today] = filter_input(INPUT_POST,'mileage');   //sessionに日付を入れる、もしmileageの値が空だったらインサートだけ起こるから値を入れる
        $ok=true; //成功したので、trueにする。
    }
    else{
        "";
    }
    $nowSumMileage=dbExe("SELECT sum_mileage FROM users WHERE id=".$_SESSION['logined']['id']);
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
                    <form method="post" action="myPage.php">
                        <p><input type="number" name="mileage" value="<?= $_SESSION["logined"][$today]?>" min="0">km</p><!-- 初期値0 最小値0-->
                        <p><input type="submit" name="submit" value="送信"></p>
                        <input type="hidden" name="user_id" value="<?= $user['id']?>">
                    </form>
                </div>
                <div class="user">
                    <!--  後々データベースからもってくる、下は仮 階級はif文？？-->
                        <p>・〇〇ポイント</p>
                        <p>・<?= $nowSumMileage[0]['sum_mileage'] ?>km</p>
                        <p>・〇〇級</p>
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
            // <?php if($ok){ ?>  //$okがtrueの時だけアラート
            // alert('変更しました'); 
            // location.href = 'myPage.php';
            // <?php } ?>
        </script>
<?php
include('./commonParts/footer.php');
?>