<?php
/*
 * admin.php :管理者画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.21 秦//
 * 
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    loginBi();//ログインしていなければログインページへ遷移
        $dbh = dbInit();
        $sql = "SELECT * FROM users";
        $sth = $dbh->prepare($sql);     //usersテーブルの中のすべての列を検索
        $exc = $sth->execute();
        $rows = $sth->fetchAll();

        $ok=false;
        
        $check = @$_POST['check'];  //チェックが入ったものを配列に入れる。
        if(!empty($_POST['delete'])){   //もし削除ボタンが押されて空じゃなければ
            foreach((array)$check as $value){      //$checkの配列の中身をforeachで回す。
                dbExe("DELETE FROM users WHERE id = $value");   //usersテーブルからidを指定して削除
                dbExe("DELETE FROM shop_info WHERE user_id = $value");  //shop_infoテーブルからidを指定して削除
                $ok=true;
            }
        }

?>
<?php
$pageTitle = "管理者ページ";
$h1 ="管理者ページ";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>アカウント情報一覧</h2>
            <form action="" method="post">
                <table border="1" id="table">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>パスワード</th>
                        <th>マイレージ</th>
                        <th>所持ポイント</th>
                    </tr>
                    <?php
                    foreach($rows as $row):
                        ?>
                    <tr class="row_<?= $row['id'] ?>">
                        <td> <input type="checkbox" name="check[<?= $row['id'] ?>]" value="<?= $row['id'] ?>"> </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['pass'] ?></td>
                        <td><?= $row['sum_mileage'] ?></td>
                        <td><?= $row['point'] ?></td>
                    </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                <input type="submit" name="delete" value="削除" onclick="alert('本当に削除しますか？')">
            </form>
                <script>
                    <?php if($ok){ ?>  //$okがtrueの時だけアラート
                        alert('削除しました'); 
                        location.href = 'commonParts/toAdmin.php';//再読み込み
                    <?php } ?>
                </script>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>