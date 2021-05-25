<?php
/*
 * top.php :トップページ画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.19
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "リサーチGO！";
$h1 ="リサーチGO！";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
             <div class="images"><p class="inimages">輝く明日へGO！</p></div>
            <h2>あなたの健康への第一歩を後押しする。</h2>
                <article class="provision">
                    <h3>あなたの頑張りを入力するだけ</h3>
                    <p>
                        健康のために走った距離、歩いた距離を日々、入力するだけで自分がどれくらいの距離を進んだのか一目で分かる。<br/>
                        マイページにはランク機能もあり、自分の累計距離を可視化することができる。<br/>
                        目指せ月まで級。
                    </p>
                </article>
                <article class="provision">
                    <h3>日々の頑張りでポイントが貯まる</h3>
                    <p>
                        あなたが頑張りで、ポイントがどんどん貯まる。貯めたポイントで、自身のマイページも変更可能。<br/>
                        自身の個性に合わせたテーマを設定しよう。
                    </p>
                </article>
                <article class="provision">
                    <h3>日々の頑張りがランキングに</h3>
                    <p>
                        あなたの頑張りがランキングに。<br/>
                        週間、月間、年間、累計、どのランキングを目指すも良し。<br/>
                        上位10名は全ユーザーのランキングに表示。他のユーザーに自慢できるチャンス。目指せ10位。
                    </p>
                </article>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>