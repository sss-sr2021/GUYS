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
*/

    require_once './commonParts/functions.php';
    @session_start();
    
    $dbh=dbInit();
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
        $sql2= "SELECT SUM(mileage) from milage where user_id=2";
        $sql = 'SELECT user_id FROM mileage ORDER BY mileage DESC';
        var_dump($sql2);
        //データベースを検索
        foreach($dbh->query($sql) as $row){
            var_dump($row);
        }
        //select category,SUM(price) as average from products group by category
        //https://www.ipentec.com/document/sql-get-sum
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
            // $(function(){
            //     $("#weekly").click(function(){
            //         $("h2").html("週間ランキング");
            //     });
            // });
            // $(function(){
            //     $("#monthly").click(function(){
            //         $("h2").html("月間ランキング");
            //     });
            // });
            // $(function(){
            //     $("#yearly").click(function(){
            //         $("h2").html("年間ランキング");
            //     });
            // });
            // $(function(){
            //     $("#total").click(function(){
            //         $("h2").html("累計ランキング");
            //     });
            // });
        </script>
        <main>
            <h2><?= $_SESSION['span'] ?>ランキング</h2>
                <label for="spanButton">
                    <form action="ranking.php" method="post">
                        <button type="submit" name="weeklyButton" id="weekly">週間</button>
                        <button type="submit" name="monthlyButton" id="monthly">月間</button>
                        <button type="submit" name="yearlyButton" id="yearly">年間</button>
                        <button type="submit" name="totalButton" id="total">累計</button>
                    </form>
                </label>
                <label for="yourRank">
                    <p>あなたは<span class="rankingRank">位</span><span class="rankingMileage">km</span></p>
                </label>
                <label for="totalRank">
                    <ul>
                        <li>
                            <p><span class="rankingRank">位</span><span class="rankingName">○○さん</span><span class="rankingMileage">km</span></p>
                        </li>
                    </ul>
                </label>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>