<?php
/*
 * createAccount.php :アカウント作成画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.19
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
    session_start();
    $email=filter_input(INPUT_POST, 'email');
    $pass0=filter_input(INPUT_POST, 'password');
    $pass=password_hash($pass0,PASSWORD_DEFAULT);
    $name=filter_input(INPUT_POST, 'name');
    $gender=filter_input(INPUT_POST, 'gender');
    if(!empty($_POST['create'])){
        $dbh = dbInit();
        // $op = "INSERT INTO users(email,pass,name,gender)VALUES('$email','$pass','$name','$gender')";
        // var_dump($op);
        $sth = $dbh->prepare("INSERT INTO users(email,pass,name,gender)VALUES('$email','$pass','$name','$gender')"); 
        
        $exc = $sth->execute();
        $rows = $sth->fetchAll();
    }
?>
<?php
$pageTitle = "アカウント作成";
$h1 ="アカウント作成";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>アカウント作成</h2>
                <form action="createAccount.php" method="post">
                    <p>メールアドレス：<input type="email" name="email" required></p>
                    <p>パスワード：<input type="password" name="password" required></p>
                    <p>お名前：<input type="text" name="name" required></p>
                    <p>性別：
                    <label><input type="radio" name="gender" value="M" required/>男</label>
                    <label><input type="radio" name="gender" value="F" />女</label>
                    <label><input type="radio" name="gender" value="O" />その他</label>
                    </p>
                    <!-- 作成ボタン　-->
                    <input type="submit" name="create" value="作成">
                </form>
         </main>
     </div>
<?php
include('./commonParts/footer.php');
?>