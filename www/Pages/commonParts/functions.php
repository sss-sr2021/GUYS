<?php
/*

function.php:共通関数

Author:秦伊吹
Version:0.0.1
Created:2021.05.20（）
updated:2021.05.21（loginout関数、logout関数の追加）

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
            $_SESSION['logined'] = $rows[0];    
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