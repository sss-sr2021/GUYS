<?php
/*
 * login.php :アカウント削除画面
 * 
 * Author:伊藤明洋
 * Version :0.0.1
 * create :2021.05.20
 * Update :2021.05.20 伊藤
 * 
 * 
*/

    require_once './commonParts/functions.php';
?>
<?php
$pageTitle = "アカウント削除";
$h1 ="アカウント削除";
include('./commonParts/header.php');
?>
     <div class='container'>
         <main>
            <h2>アカウント削除</h2>
                <form action="" method="post">
                    <p>アカウントを削除します。</p>
                    <p><input type="submit" name="delete" value="削除"></p>
                </form>
         </main>
     </div>
     <script>
     </script>
<?php
include('./commonParts/footer.php');
?>