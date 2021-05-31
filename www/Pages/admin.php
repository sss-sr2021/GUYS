<?php
/*
 * admin.php :管理者画面
 * 
 * Author:秦伊吹
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.24 秦//admin.phpのユーザー削除機能追加。
 *         2021.05.25 秦//管理者だけ非表示。パスワードは非表示
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    loginBi();      //ログインしていなければログインページへ遷移
    if($_SESSION['logined']['email'] !== 'admin@sr-co.co.jp'){      //セッションの中身が管理者じゃなければ、マイページへ遷移。
        header('Location:myPage.php');
    }
        $dbh = dbInit();
        $sql = "SELECT * FROM users WHERE NOT email = 'admin@sr-co.co.jp'";     //管理者以外のユーザー情報の表示。
        $sth = $dbh->prepare($sql);     //usersテーブルの中のすべての列を検索
        $exc = $sth->execute();
        $rows = $sth->fetchAll();

        $ok=false;
        
        $check = @$_POST['check'];      //チェックが入ったものを配列に入れる。
        if(!empty($_POST['delete'])){       //もし削除ボタンが押されて空じゃなければ
            //↓↓↓セキュリティ↓↓↓
            if (!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))) {
                header('Content-Type: text/plain; charset=UTF-8', true, 400);
                die('CSRF validation failed.');
            }
            //↑↑↑セキュリティ↑↑↑
            foreach((array)$check as $value){       //$checkの配列の中身をforeachで回す。
                dbExe("DELETE FROM users WHERE id = $value");       //usersテーブルからidを指定して削除
                dbExe("DELETE FROM shop_info WHERE user_id = $value");      //shop_infoテーブルからidを指定して削除
                dbExe("DELETE FROM mileage WHERE user_id = $value"); //mileageテーブルからidを指定して削除
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
        <main class="admin">
            <form action="" method="post" class="adminform">
            <h2 class="adminh2">アカウント情報一覧</h2>
                <table border="1" id="table">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>マイレージ</th>
                        <th>所持ポイント</th>
                    </tr>
                    <?php
                    foreach($rows as $row)://usersテーブルのすべての中身をforeachで回す。
                        ?>
                    <tr class="row_<?= $row['id'] ?>">
                        <td> <input type="checkbox" name="check[<?= $row['id'] ?>]" value="<?= $row['id'] ?>"> </td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['sum_mileage'] ?></td>
                        <td><?= $row['point'] ?></td>
                    </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
                    <div class="adminsubmit">
                        <input type="submit" name="delete" value="削除" class="adminbutton" onclick="return confirm('本当に削除しますか？')">
                    </div>
                    <!-- ↓↓↓セキュリティ↓↓↓ -->
                    <input type="hidden" name="token" value="<?=CsrfValidator::generate()?>">
                    <!-- ↑↑↑セキュリティ↑↑↑ -->
            </form>
                <script>
                    <?php if($ok){ ?>  //$okがtrueの時だけアラート
                        alert('削除しました'); 
                        location.href = 'commonParts/toAdmin.php';//外部ファイルに一度飛んでadmin.phpに戻る。
                    <?php } ?>
                </script>
        </main>
    </div>
<?php
include('./commonParts/footer.php');
?>