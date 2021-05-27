<?php
/*
 * changeMail.php :メールアドレス変更画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 *         2021.05.23 花岡//エラーメッセージにpタグ追加
 *         2021.05.24 花岡//セッション情報更新の処理追加
 * 
 * $user :セッションにあるユーザー情報
 * $pass :入力されたパスワード
 * $new_email :新しいパスワード
 * $new_email2 :新しいパスワード(確認)
 * $ok :成功した場合にtrueを入れ、trueの場合のみアラートを表示させるための変数
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    loginBi();//ログインしていなければログインページへ遷移
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $pass=filter_input(INPUT_POST, 'password');
    $new_email=filter_input(INPUT_POST, 'email');
    $new_email2=filter_input(INPUT_POST, 'email2');
    $error_message="";
    $user = $_SESSION['logined'];  //セッションにあるユーザー情報
    if(!empty($_POST['change'])){ //もしchangeにの値が空じゃなければ以下を実行する
        //↓↓↓セキュリティ↓↓↓
        if (!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))) {
            header('Content-Type: text/plain; charset=UTF-8', true, 400);
            die('CSRF validation failed.');
        }
        //↑↑↑セキュリティ↑↑↑
        $dbh = dbInit();  //functionsからデータベースとの接続関数を持ってくる
        $emailFromUsers="SELECT email FROM users";
        foreach($dbh->query($emailFromUsers) as $row){//DBに同じメアドがないか検索
            if($row['email']==filter_input(INPUT_POST,'email')){//usersテーブルのメールアドレスと入力されたメールアドレスが一致すれば
                $error_message.="そのメールアドレスは既に存在します。";//エラーメッセージの追加
            }
        }
        if(empty($error_message)){//エラーメッセージがなければ
            if(password_verify($pass,$user['pass'])){ //passwordを照合して一致すれば、以下を実行
                if(@$new_email == @$new_email2){ //新しいメールアドレスともう一度入力されたメールアドレスを照合して一致すれば、以下を実行
                $sth = $dbh-> prepare(  //idが同じならメールアドレスを変更する
                    'UPDATE users SET email = :email WHERE id = :id'
                );
                $ret = $sth->execute([
                     'email' => filter_input(INPUT_POST, 'email'),  //:nameは入力された値を入れる
                     'id' => $user["id"]  //:idはセッションにある値を入れる
                ]);
                $_SESSION['logined']['email']=filter_input(INPUT_POST,'email');//セッション情報の更新
                $ok=true; //成功したので、trueにする。
                }
                else{
                    $error_message .= '同じメールアドレスを入力してください。<br />';
                }
            }else{
                $error_message .= '変更に失敗しました。';
            }
        }
    }
    else{
        "";
    }
?>
<?php
$pageTitle = "メールアドレス変更";
$h1 ="メールアドレス変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>

         <div class="block">
            <h2>メールアドレス変更</h2>
            <p><?= $error_message ?></p>
                <form action="" method="post">
                    <p>新しいメールアドレス：<input type="email" name="email" placeholder="〇〇〇＠〇〇〇" required></p>
                    <p>新しいメールアドレス(確認用)： <input type="email" placeholder="〇〇〇＠〇〇〇" name="email2" required></p>
                    <p>パスワード：<input type="password" name="password" required></p>
                    <p><input type="submit" name="change" value="変更"></p>
                    <!-- ↓↓↓セキュリティ↓↓↓ -->
                    <input type="hidden" name="token" value="<?=CsrfValidator::generate()?>">
                    <!-- ↑↑↑セキュリティ↑↑↑ -->
                </form>
        </div>
        
                <script>
                    //変更した場合のみアラート表示
                    <?php if($ok){ ?>  //$okがtrueの時だけアラート
                    alert('変更しました'); 
                    location.href = 'myPage.php';
                    <?php } ?>
                </script>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>