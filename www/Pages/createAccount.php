<?php
/*
 * createAccount.php :アカウント作成画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.19
 * Update :2021.05.22 花岡//同一メールアドレスで複数のアカウント作成はできないように修正
 *         2021.05.23 花岡//アカウント作成時、shop_infoテーブルにもデータを追加
 *         2021.05.25 秦//アカウント作成の際の、パスワード入力の制限桁数、制限文字の追加
 * 
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $email=filter_input(INPUT_POST, 'email');
    $pass0=filter_input(INPUT_POST, 'password');
    $pass=password_hash($pass0,PASSWORD_DEFAULT);
    $name=filter_input(INPUT_POST, 'name');
    $gender=filter_input(INPUT_POST, 'gender');
    $message="";//エラーメッセージ
    if(!empty($_POST['create'])){
        $dbh = dbInit();
        // $op = "INSERT INTO users(email,pass,name,gender)VALUES('$email','$pass','$name','$gender')";
        // var_dump($op);
        $emailFromUsers="SELECT email FROM users";
        foreach($dbh->query($emailFromUsers) as $row){
            if($row['email']==filter_input(INPUT_POST,'email')){//usersテーブルのメールアドレスと入力されたメールアドレスが一致すれば
                $message.="そのメールアドレスは既に存在します。";//エラーメッセージの追加
            }
        }
        if(empty($message)){//エラーメッセージがなければ
            //アカウント作成処理
            dbExe("INSERT INTO users(email,pass,name,gender)VALUES('$email','$pass','$name','$gender')");//usersテーブル
            $shopUserId=dbExe("SELECT id from users WHERE email='$email'");
            $shopUserId=$shopUserId[0]['id'];
            dbExe("INSERT INTO shop_info(user_id)VALUES('$shopUserId')");
            $ok=true; //成功したので、trueにする。
            //$message="アカウントを作成しました。";
        }
    }
?>
<?php
$pageTitle = "アカウント作成";
$h1 ="アカウント作成";
include('./commonParts/header.php');
?>
     <div class='container'>
        <main>

        <div class="block">
            <h2>アカウント作成</h2>
            <p><?= $message ?></p>
                <form action="createAccount.php" method="post">
                    <p>メールアドレス：<input type="email" name="email" required></p>
                    <p>パスワード：<input type="password" name="password" pattern="[a-zA-Z0-9]{8,16}" required></p>
                    <p>お名前：<input type="text" name="name" pattern=".{1,20}" required></p>
                    <p>性別：
                    <label><input type="radio" name="gender" value="M" required/>男</label>
                    <label><input type="radio" name="gender" value="F" />女</label>
                    <label><input type="radio" name="gender" value="O" />その他</label>
                    </p>
                    <!-- 作成ボタン　-->
                    <input type="submit" name="create" value="作成">
                </form>
        </div>
            <script>
                //変更した場合のみアラート表示
                <?php if($ok){ ?>  //$okがtrueの時だけアラート
                alert('アカウントを作成しました'); 
                location.href = 'login.php';
                <?php } ?>
            </script>
        </main>
     </div>
<?php
include('./commonParts/footer.php');
?>