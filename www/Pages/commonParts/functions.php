<?php
/*

function.php:共通関数

Author:秦伊吹
Version:0.0.1
Created:2021.05.20（）
updated:2021.05.21（loginout関数、logout関数、myPageBi関数の追加）
        2021.05.22 花岡//(dbExe関数の追加)
        2021.05.23 花岡//getLoginUserのエラー回避処理の追加
                    //myPageBi関数にsession_start追加
                    //loginBi関数の追加：ログインしていなければログインページへ遷移する
        2021.05.24 花岡//userRank関数の追加：ユーザーの階級を返す
        2021.05.26 花岡//ログアウト時session_destroy()の追加
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
            if(!empty($rows3)){//$rows3が空じゃなければ（エラー回避処理）
                $_SESSION['logined'] = @$rows[0] + @$rows3;  
                return @$_SESSION['logined'];
            }
            else{
                $_SESSION['logined'] = @$rows[0];
                return @$_SESSION['logined'];
            }
        
    }else{                                      //もしセッション変数の中身が存在したら、セッション変数から中身を取り出す。
        return @$_SESSION['logined'];
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
    $_SESSION['span']=null;
    $_SESSION['theme']=null;
    $_SESSION['logined'] = null; //セッション変数の値をnullにする。
    session_destroy();
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
    @session_start();
    if(!empty($_SESSION['logined'])){           //セッションの中身があったら
        header('Location:../myPage.php');       //myPage.phpに移動
    }else{                                      //セッションの中身がなければ
    header('Location:../login.php');            //login.phpに移動
    }
}


/*
loginBi関数：ログインしていなければログインページへ
*/
function loginBi(){
    @session_start();
    if(empty($_SESSION['logined'])){    //ログインしていなければ
        header('Location:./login.php');//ログインページへ
    }
}

/*
userRank関数：ユーザーの階級を返す
*$a:合計マイレージ
*return $rank:ユーザーの階級
*/


function userRank($a){
    $arrRank=["お散歩級","フルマラソン級","琵琶湖１周級","北海道１周級","四国１周級","日本縦断級","アマゾン川級","万里の長城級","日本１周級","地球１周級","月まで級"];
    if($a<42){
        $rank=$arrRank[0];
    }
    elseif($a>=42&&$a<200){
        $rank=$arrRank[1];
    }
    elseif($a>=200&&$a<500){
        $rank=$arrRank[2];
    }
    elseif($a>=500&&$a<1200){
        $rank=$arrRank[3];
    }
    elseif($a>=1200&&$a<2500){
        $rank=$arrRank[4];
    }
    elseif($a>=2500&&$a<6400){
        $rank=$arrRank[5];
    }
    elseif($a>=6400&&$a<8800){
        $rank=$arrRank[6];
    }
    elseif($a>=8800&&$a<12000){
        $rank=$arrRank[7];
    }
    elseif($a>=12000&&$a<40000){
        $rank=$arrRank[8];
    }
    elseif($a>=40000&&$a<360000){
        $rank=$arrRank[9];
    }
    elseif($a>=360000){
        $rank=$arrRank[10];
    }
    return $rank;
}