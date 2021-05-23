<?php
/*
 * admin.php :管理者画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.20
 * Update :
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
        
?>
<?php
$pageTitle = "管理者ページ";
$h1 ="管理者ページ";
include('./commonParts/header.php');
?>
    <div class='container'>
        <main>
            <h2>アカウント情報一覧</h2>
                <table border="1" id="table">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>パスワード</th>
                        <th>マイレージ</th>
                        <th>所持ポイント</th>
                        <th>削除</th>
                    </tr>
                    <?php
                    foreach($rows as $row):
                        ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['pass'] ?></td>
                        <td></td>
                        <td><?= $row['point'] ?></td>
                        <td> <input type="submit" name="delete" value="<?= $row['id'] ?>" onclick="alert('本当に削除しますか？')"></td>
                    </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                <input type="submit" name="delete" value="削除" onclick="alert('本当に削除しますか？')">
                <script>
                    alert('削除しました。');
                </script>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>