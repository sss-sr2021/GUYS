<?php
/*
 * changePassword.php :パスワード変更画面
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
 * $new_password :新しいパスワード
 * $new_password2 :新しいパスワード(確認)
 * $ok :成功した場合にtrueを入れ、trueの場合のみアラートを表示させるための変数
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    loginBi();//ログインしていなければログインページへ遷移
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $pass=filter_input(INPUT_POST, 'password');
    $new_password=filter_input(INPUT_POST, 'new_password');
    $new_password2=filter_input(INPUT_POST, 'new_password2');
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
            if(password_verify($pass,$user['pass'])){ //passwordを照合して一致すれば、以下を実行
                if(@$new_password == @$new_password2){ //新しいパスワードともう一度入力されたパスワードを照合して一致すれば、以下を実行
                $sth = $dbh-> prepare(  //idが同じならメールアドレスを変更する
                    'UPDATE users SET pass = :pass WHERE id = :id'
                );
                $ret = $sth->execute([
                     'pass' => password_hash($new_password,PASSWORD_DEFAULT), //入力された値を入れる、暗号化も
                     'id' => $user["id"]  //:idはセッションにある値を入れる
                ]);
                $_SESSION['logined']['pass']=password_hash($new_password,PASSWORD_DEFAULT);//セッション情報更新
                $ok=true; //成功したので、trueにする。
                }
                else{
                    $error_message .= '同じパスワードを入力してください。';
                }
            }else{
                $error_message .= '変更に失敗しました。';
            }
    }
    else{
        "";
    }
?>
<?php
$pageTitle = "パスワード変更";
$h1 ="パスワード変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>

                <div class="block">
                    <h2>パスワード変更</h2>
                    <p><?= $error_message ?></p>
                    <form action="" method="post">
                        <p>現在のパスワード：<input type="password" name="password" required></p>
                        <p>新しいパスワード：<input type="password" name="new_password" placeholder="半角英数字8～16文字" required></p>
                        <p>新しいパスワード(確認用)：<input type="password" name="new_password2" placeholder="半角英数字8～16文字" required></p>
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