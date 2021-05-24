<?php
/*
 * company.php :運営会社画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.24 秦//漢委員会概要の中身追加
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "漢委員会";
$h1 ="漢委員会";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>漢委員会概要</h2>
            <dl class="overview">
                <dt class="	corporate-name">
                    団体名
                </dt>
                <dd class="	corporate-name">
                    漢委員会
                </dd>
                <dt class="representative">
                    代表者
                </dt>
                <dd class="representative">
                    <span class="position">代表取締役</span>　<span class="president">○○</span>
                </dd>
                <dt class="established">
                    設立日
                </dt>
                <dd class="established">
                    2021年 5月 31日
                </dd>
                <dt class="	capital">
                    資本金
                </dt>
                <dd class="	capital">
                    1,000万円
                </dd>
                <dt class="base">
                    本社所在地
                </dt>
                <dd class="base">
                    〒669-0000 兵庫県豊岡市
                </dd>
                <dt class="phone">
                    電話番号
                </dt>
                <dd class="phone">
                    0000-00-0000　(代表)
                </dd>
            </dl>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>