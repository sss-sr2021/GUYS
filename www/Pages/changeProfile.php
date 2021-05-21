<?php
/*
 * changeProfile.php :プロフィール情報変更画面
 * 
 * Author:伊藤明洋
 * Version :0.1.1
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 * $user :セッションにあるユーザー情報
 * $ok :成功した場合にtrueを入れ、trueの場合のみアラートを表示させるための変数
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    $ok=false; //falseとしてまず置いておく、成功したらtrueになる。
    $user = $_SESSION['logined'];  //セッションにあるユーザー情報

    //セッションのIDとDBのIDを基準にして名前と性別を変更
    if(!empty($_POST['change'])){  //もしsubmitにの値が空じゃなければ以下を実行する
        $dbh = dbInit();  //functionsからデータベースとの接続関数を持ってくる
        $sth = $dbh-> prepare(  //idが同じなら名前と性別を変更する
            'UPDATE users SET name = :name , gender = :gender WHERE /*pass = :pass and*/ id = :id'
        );
        $ret = $sth->execute([
             'name' => (string)filter_input(INPUT_POST,'name'),  //:nameは入力された値を入れる
             'gender' => filter_input(INPUT_POST,'gender'), //:genderは選択された値を入れる
             //パスワードの確認欄は削除
             //'pass' => password_hash(filter_input(INPUT_POST,'password'),PASSWORD_DEFAULT), //:pass入力された値を入れる、暗号化も
             'id' => filter_input(INPUT_POST,'id')  //:idはhiddenで取ってきた値を入れる
         ]);
        $ok=true; //成功したので、trueにする。
    }
    else{
        "";
    }

?>
<?php
$pageTitle = "プロフィール情報変更";
$h1 ="プロフィール情報変更";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>プロフィール情報変更</h2>
                <form action="" method="post">
                    <p>お名前：<input type="text" name="name" required></p>
                    <p>性別：
                    <label><input type="radio" name="gender" value="M" required/>男</label>
                    <label><input type="radio" name="gender" value="F" />女</label>
                    <label><input type="radio" name="gender" value="O" />その他</label>
                    </p>
                    <!-- <p>パスワード：<input type="password" name="password" required></p> -->
                    <p><input type="submit" name="change" value="変更"></p>
                    <!-- セッションのユーザーIDをhiddenで取ってくる -->
                    <p><br />
                    <input type="hidden" name="id" value="<?= $user["id"] ?>"/></p>
                </form>
                <script>
                    //変更した場合のみアラート表示
                    <?php if($ok){ ?>  //$okがtrueの時だけアラート
                    alert('変更しました'); 
                    <?php } ?>
                </script>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>