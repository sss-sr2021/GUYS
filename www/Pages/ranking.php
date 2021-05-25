<?php
/*
 *  ranking.php :マイレージのランキングの動的表示
 * 
 * Author:花岡宗史
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 * 
 * $_SESSION['span']//指定した期間
 * 
 * 関数
 * dbExe($sql)//SQL文を実行する。$sql:SQL文
 * ranking($span)//指定した期間での、ユーザーIDと合計マイレージを取得。
 *               //return Array([ユーザーID]=>合計マイレージ)
 *              //$span:WHERE条件式
*/

    require_once './commonParts/functions.php';
    @session_start();
    loginBi();//ログインしていなければログインページへ遷移
    $dbh=dbInit();
    
    function ranking($span){
        //重複なしでuser_idをmileageテーブルから取得
        $disSql="SELECT DISTINCT user_id FROM mileage $span";
            $dis=dbExe($disSql);
        //user_idの種類の回数だけforeachして$arr1に格納
            $arr1=[];
        foreach($dis as $v){
            $arr1[]=$v['user_id'];
        }
        //user_id=>マイレージの合計となるような$arr2を作成(降順)
            $arrRank=[];
            foreach($arr1 as $v){
                $sumSql="SELECT SUM(mileage) from mileage where user_id=$v";
                $sum=dbExe($sumSql);
                $sum2=$sum[0]['sum'];
                $arrRank[$v]=$sum2;
            }
            arsort($arrRank);
            return $arrRank;
    }

    if(empty($_SESSION['span'])){//デフォルトは週間
        $_SESSION['span']="週間";
    }
    
    if(isset($_POST['weeklyButton'])) {//週間ボタンが押されたとき
        $_SESSION['span']="週間";
    }
    elseif(isset($_POST['monthlyButton'])) {//月間ボタンが押されたとき
        $_SESSION['span']="月間";
    }
    elseif(isset($_POST['yearlyButton'])) {//年間ボタンが押されたとき
        $_SESSION['span']="年間";
    }
    elseif(isset($_POST['totalButton'])) {//累計ボタンが押されたとき
        $_SESSION['span']="累計";
    }
    //セッションの状態で分岐
    switch($_SESSION['span']){
        case "週間":
            $weekNum=date("w");//今日の曜日番号
            $todayWeek=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$weekNum,date("Y")));//今週の日曜日
            $nextWeek=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+(7-$weekNum),date("Y")));//来週の日曜日
            $to=date("Y-m-d",strtotime("{$nextWeek} -1 day"));//今週末
            $arrRank=ranking("WHERE DATE>='".$todayWeek."' AND DATE<'".$nextWeek."'");
            $message="{$todayWeek}～{$to}の記録";
            break;

        case "月間":
            $todayMonth=date("Y-m-d",mktime(0,0,0,date("m"),1,date("Y")));//今月の1日
            $nextMonth=date("Y-m-d",mktime(0,0,0,date("m")+1,1,date("Y")));;//来月の1日 
            $to=date("Y-m-d",strtotime("{$nextMonth} -1 day"));//今月末
            $arrRank=ranking("WHERE DATE>='".$todayMonth."' AND DATE<'".$nextMonth."'");
            $message="{$todayMonth}～{$to}の記録";
            break;

        case "年間":
            $todayYear=date("Y-m-d",mktime(0,0,0,1,1,date("Y")));//今年の1月1日
            $nextYear=date("Y-m-d",mktime(0,0,0,1,1,date("Y")+1));//来年の1月1日
            $to=date("Y-m-d",strtotime("{$nextYear} -1 day"));//今年の12月31日
            $arrRank=ranking("WHERE DATE>='".$todayYear."' AND DATE<'".$nextYear."'");
            $message="{$todayYear}～{$to}の記録";
            break;

        case "累計":
            $today=date("Y-m-d");
            $arrRank=ranking("");
            $message="{$today}までの記録";
            break;
    }

    $allRank=1;//順位
    $counter=0;//添え字カウンター
    //userテーブルに接続
    $usersSql="SELECT *  FROM users";
    $users=dbExe($usersSql);
    //全ユーザーの名前とマイレージを配列$resultArrに格納
    $resultArr=[];
    foreach($arrRank as $k=>$v){
        foreach($users as $data){
            if($k==$data['id']){
                $resultArr[$counter]['id']=$k;
                $resultArr[$counter]['rank']=$allRank;
                $resultArr[$counter]['name']=$data['name'];
                $resultArr[$counter]['mileage']=$v;
                $counter++;
                $allRank++;
            }
        }
    }
    //上位10名のデータの配列
    $topTen=[];
    for($i=0;$i<10;$i++){
        if(isset($resultArr[$i])){
            $topTen[$i]['id']=$resultArr[$i]['id'];
            $topTen[$i]['rank']=$resultArr[$i]['rank'];
            $topTen[$i]['name']=$resultArr[$i]['name'];
            $topTen[$i]['mileage']=$resultArr[$i]['mileage'];
        }
    }
    //$resultArrからログインユーザーの情報を検索
    $userResult=[];
    foreach($resultArr as $v){
        if($_SESSION['logined']['id']==$v['id']){
            $userResult['rank']=$v['rank'];
            $userResult['mileage']=$v['mileage'];
        }
    }
?>
<?php
$pageTitle = "ランキング";
$h1 ="ランキング";
include('./commonParts/header.php');
?>
    <div class='container'>
    <script src="/jquery-3.6.0.js"></script>
        <script>
        </script>
        <main>
            <div class="matome">
                <div class="MENU inLineBrock">
                    <h3>MENU</h3>
                    <a href="top.php">▶トップページ</a><br />
                    <a href="myPage.php">▶マイページ</a><br />
                    <a href="shop.php">▶ショップ</a><br />
                    <a href="custom.php">▶カスタム</a><br />
                    <a href="settingAccount.php">▶アカウント設定</a><br />
                    <a href="commonParts/loginout.php">ログアウト</a>
                </div>
            <div class="Ranking inLineBrock">
            
                <form action="ranking.php" method="post">
                    <div class="spanButton">
                        <label for="spanButton">
                            <button type="submit" name="weeklyButton" id="weekly">週間</button>
                            <button type="submit" name="monthlyButton" id="monthly">月間</button>
                            <button type="submit" name="yearlyButton" id="yearly">年間</button>
                            <button type="submit" name="totalButton" id="total">累計</button>
                        </label>
                    </div>
                </form>
                <h2><?= $_SESSION['span'] ?>ランキング</h2>
                
                <?php if($userResult<>null): ?><!-- 指定した期間内にログインユーザーのデータがあれば -->
                    <div class="yourRank">
                        <h4><p>あなたは<span class="rankingYourRank"><?= $userResult['rank'] ?>位</span><span class="rankingYourMileage"><?= $userResult['mileage'] ?>km</span></p></h4>
                    </div>
                <?php else:?><!-- 指定した期間内にログインユーザーのデータがなければ -->
                    <div class="yourRank">
                        <p>あなたのデータはありません。</p>
                    </div>
                <?php endif; ?><!-- if($userResult<>null): -->
                <div class="totalRank">
                    <?php if($topTen<>null): ?>
                        <ul>
                        <?php foreach($topTen as $v):?>
                            <li><span class="rankingRank"><?=$v['rank']?>位</span><span class="rankingName"><?=$v['name']?>さん</span><span class="rankingMileage"><?=$v['mileage']?>km</span></li>
                        <?php endforeach;?>
                        </ul>
                    <?php else:?>
                        <p>ランキングデータがありません。</p>
                    <?php endif; ?><!-- if($resultArr<>null): -->
                    <div class="spanData">
                        <p><?= $message ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>