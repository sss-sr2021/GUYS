<?php
/*
 *  ranking.php :マイレージのランキングの動的表示
 * 
 * Author:花岡宗史
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 花岡
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "ランキング";
$h1 ="ランキング";
include('./commonParts/header.php');
?>
    <div class='container'>
    <script src="/jquery-3.6.0.js"></script>
        <script>
            $(function(){
                $("#weekly").click(function(){
                    $("h2").html("週間ランキング");
                });
            });
            $(function(){
                $("#monthly").click(function(){
                    $("h2").html("月間ランキング");
                });
            });
            $(function(){
                $("#yearly").click(function(){
                    $("h2").html("年間ランキング");
                });
            });
            $(function(){
                $("#total").click(function(){
                    $("h2").html("累計ランキング");
                });
            });
        </script>
        <main>
            <h2>週間ランキング</h2>
                <label for="spanButton">
                    <button name="spanButton" id="weekly">週間</button>
                    <button name="spanButton" id="monthly">月間</button>
                    <button name="spanButton" id="yearly">年間</button>
                    <button name="spanButton" id="total">累計</button>
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