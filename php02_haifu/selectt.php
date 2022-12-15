<?php

function h($str){
   return htmlspecialchars($str,ENT_QUOTES);
}
//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table;");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    // elseの中は、SQL実行成功した場合
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>' . $result['id'] . ' : ' . $result['date'] . ' / ' . h($result['bookname']) . ' / ' . h($result['URL']) . ' / ' . h($result['comment']) . '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DATA HISTORY</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="select.php" style="backgorund= #999 color: white">MORE DETAIL</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron" style="background: linear-gradient(rgba(53, 82, 66, 0.5), rgba(47, 80, 63, 0.6)),
    url(images/bg.jpg) center no-repeat; color: white"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>










