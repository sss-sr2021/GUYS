<?php
/*
 * deleteAccount.php :アカウント削除画面
 * 
 * Author:伊藤明洋
 * Version :0.1.1
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 *         2021.05.23 花岡(全テーブルからユーザーのデータを削除できるように変更)
 * 
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    loginBi();//ログインしていなければログインページへ遷移
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $user = $_SESSION['logined'];
    if(!empty($_POST['delete'])){
        dbExe("DELETE FROM users WHERE id =".$user["id"] );//idはセッションにある値を入れる
        dbExe("DELETE FROM mileage WHERE user_id =".$user["id"] );
        dbExe("DELETE FROM shop_info WHERE user_id =".$user["id"] );
        logout();
        $ok=true; //成功したので、trueにする。
    }
    else{
        "";
    }
?>
<?php
$pageTitle = "アカウント削除";
$h1 ="アカウント削除";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>アカウント削除</h2>
                <form action="" method="post">
                    <p>アカウントを削除します。</p>
                    <input type="submit" name="delete" value="削除" onclick="return confirm('本当に削除しますか？')">
                    <!--
                <script>
                    alert('削除しました。');
                </script>
                -->
                </form>
         </main>
     </div>
        <script>

        //削除した場合のみアラート表示
            <?php if($ok){ ?>  //$okがtrueの時だけアラート
            alert('削除しました'); 
            location.href = 'top.php';
            <?php } ?>
        </script>
<?php
include('./commonParts/footer.php');
?>