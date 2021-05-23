<?php
/*

function.php:共通関数

Author:秦伊吹
Version:0.0.1
Created:2021.05.20（）
updated:2021.05.21（loginout関数、logout関数、myPageBi関数の追加）
        2021.05.22 花岡//(dbExe関数の追加)

*/


/*
定数↓
*/
define('DB_DRIVER','pgsql');    //
define('DB_HOST','localhost');  //
define('DB_PORT',5432);         //
define('DB_DBNAME','GUYS');     //データベース名
define('DB_USER','postgres');   //データベースの所有者
define('DB_PASS','');           // 

//dbInit関数：データベースへの接続

function dbInit(){
            global $dbh;
            $dbh = new PDO(
                DB_DRIVER.':host='.DB_HOST. ' port='.DB_PORT. ' dbname='.DB_DBNAME,
                DB_USER,
                DB_PASS,//本来はパスワード
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
                return $dbh;
}

/*
*dbExe($sql)//SQL文を実行する。$sql:SQL文
*return $rows:実行結果
*Author:花岡
*
*/

function dbExe($sql){
    $dbh=dbInit();
    $sth=$dbh->prepare($sql);
    $exc=$sth->execute();
    $rows=$sth->fetchAll();
    return $rows;
}

/*
getLoginUser関数：データベースへの接続
$_SESSION['logined']：セッション変数
*/

function getLoginUser($where=[]){
    $rows=[];
    $dbh = dbInit();
    if(empty($_SESSION['logined'])){                                          //もしセッション変数の中身が存在しなかったら、データベースへアクセスする。
        foreach($where as $key => $value){
            //users
            //var_dump($key);
            $sql = "SELECT * FROM users WHERE $key=:$key";
            $sth = $dbh->prepare($sql);     //usersテーブルの中のすべての列の中からemailの列を検索している
            $exc = $sth->execute([$key => $value]);
            $rows = $sth->fetchAll();
        }
            //mileageテーブルの値も取得
            @$User_id = @$rows[0]['id']; 

            $sth = $dbh->prepare(
                "SELECT * FROM mileage WHERE user_id=:user_id"
            );
            $exc = $sth->execute(
                ["user_id" => $User_id]
            );
            $rows2 = $sth -> fetchALL();
    
            $rows3 = [];  // $rows3を空の配列として設定
            foreach($rows2 as $row) {
                $key = $row['date'];    //dateを渡す
                $value = $row['mileage'];  //mileageを渡す
                $rows3[$key] = $value;  //dateをkeyとしてmileageを渡す
            }

        $_SESSION['logined'] = @$rows[0] + @$rows3;    
        return $_SESSION['logined'];
    }else{                                      //もしセッション変数の中身が存在したら、セッション変数から中身を取り出す。
        return $_SESSION['logined'];
    }
}

function createAccount(){
    $dbh = dbInit();
    $sth = $dbh->prepare($sql);     //usersテーブルの中のすべての列の中からemailの列を検索している
            $exc = $sth->execute([$key => $value]);
            $rows = $sth->fetchAll();
}


/*
getMileage関数：データベースへの接続
$_SESSION['mileage']：セッション変数
$User_id : usersのid
*/
/* 一回封印
function getMileage(){
    @$User_id = @$rows[0]['id']; 

    $sth = $dbh->prepare(
        "SELECT * FROM mileage WHERE user_id=:user_id"
    );
    $exc = $sth->execute(
        ["user_id" => $User_id]
    );
    $rows2 = $sth -> fetchALL();

   $rows3 = [];  // $rows3を空の配列として設定
    foreach($rows2 as $row) {
        $key = $row['date'];    //dateを渡す
        $value = $row['mileage'];  //mileageを渡す
        $rows3[$key] = $value;  //dateをkeyとしてmileageを渡す
    }

    $_SESSION["mileage"] = @$rows3;  //セッション変数に保持
    return $_SESSION["mileage"];
}
*/

/*
logout関数：ログアウト、セッションの中身を空にする。
*/

function logout(){
    $_SESSION['logined'] = null; //セッション変数の値をnullにする。
}

/*
loginout関数：ログアウト、セッションの中身を空にする。
*/

function loginout(){
    if(!empty($_SESSION['logined'])){
        logout();
        header('Location:../top.php');
    }else{
        header('Location:../login.php');
    }
}


/*
myPageBi関数：マイページを押したときの分岐
*/

function myPageBi(){
    if(!empty($_SESSION['logined'])){           //セッションの中身があったら
        header('Location:../myPage.php');       //myPage.phpに移動
    }else{                                      //セッションの中身がなければ
    header('Location:../login.php');            //login.phpに移動
    }
}