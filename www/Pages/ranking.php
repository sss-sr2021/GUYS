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
 * $_SESSION['sumId']//
 * 
 * dbExe($sql)//SQL文を実行する。$sql:SQL文
*/

    require_once './commonParts/functions.php';
    @session_start();
    $dbh=dbInit();
    $today= date("Y-m-d");//今日の日付
    $weekNum=date("w");//今日の曜日番号
    print_r($today);
    function dbExe($sql){
        $dbh=dbInit();
        $sth=$dbh->prepare($sql);
        $exc=$sth->execute();
        $rows=$sth->fetchAll();
        return $rows;
    }
    function ranking($span){

    }

    if(empty($_SESSION['span'])){
        $_SESSION['span']="週間";
    }

    if(isset($_POST['weeklyButton'])) {
        $_SESSION['span']="週間";
    }
    elseif(isset($_POST['monthlyButton'])) {
        $_SESSION['span']="月間";
    }
    elseif(isset($_POST['yearlyButton'])) {
        $_SESSION['span']="年間";
    }
    elseif(isset($_POST['totalButton'])) {
        $_SESSION['span']="累計";
        //重複なしでuser_idをmileageテーブルから取得
        $disSql="SELECT DISTINCT user_id FROM mileage";
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
    }
    $allRank=1;//順位
    $counter=0;//添え字カウンター
    //userテーブルに接続
    $usersSql="SELECT *  FROM users";
    $users=dbExe($usersSql);
    //データベースから検索
    $resultArr=[];
    foreach($arrRank as $k=>$v){
        foreach($users as $data){
            if($allRank<11){
                if($k==$data['id']){
                    $resultArr[$counter]['rank']=$allRank;
                    $resultArr[$counter]['name']=$data['name'];
                    $resultArr[$counter]['mileage']=$v;
                    $counter++;
                    $allRank++;
                }
            }
        }
    }
    $resultArr=json_encode($resultArr);//JSONエンコード
?>
<?php
$pageTitle = "ランキング";
$h1 ="ランキング";
include('./commonParts/header.php');
?>
    <div class='container'>
    <script src="/jquery-3.6.0.js"></script>
        <script>
            var resultArr = JSON.parse('<?= $resultArr; ?>');  //JSONデコード
            console.log(resultArr);
        $(function(){
            for(var i in resultArr){
                $(".totalRank").append('<li><span class="rankingRank">'+resultArr[i].rank+'位</span><span class="rankingName">'+resultArr[i].name+'さん</span><span class="rankingMileage">'+resultArr[i].mileage+'km</span></li>');
            }
        });
        </script>
        <main>
            <h2><?= $_SESSION['span'] ?>ランキング</h2>
                <form action="ranking.php" method="post">
                    <label for="spanButton">
                    <button type="submit" name="weeklyButton" id="weekly">週間</button>
                    <button type="submit" name="monthlyButton" id="monthly">月間</button>
                    <button type="submit" name="yearlyButton" id="yearly">年間</button>
                    <button type="submit" name="totalButton" id="total">累計</button>
                    </label>
                </form>
                <div class="yourRank">
                    <p>あなたは<span class="rankingRank">位</span><span class="rankingMileage">km</span></p>
                </div>
                <div class="totalRank">
                    <ul>
                    </ul>
                </div>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>