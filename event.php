<?php 

header('Content-Type: application/json');


//db接続
try {
  $pdo = new PDO('mysql:dbname=tutors;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('DBConnectError:'.$e->getMessage());
}


//2．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM calendar_table");
$status = $stmt->execute();


//3．データ登録処理後（基本コピペ使用でOK)
$view='';
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //selectデータの数だけ自動でループしてくれる
$r = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($r);
}
 


// try{
//   $pdo = new PDO('mysql:dbname=tutors;charset=utf8;host=localhost','root','root');
// }catch(PDOException $e){
//   exit('エラーです'.$e->getMessage());
// }

// //データ登録SQL作成
// $sql = 'SELECT * FROM calendar_table';
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute();//このexecuteで上で処理した内容を実行している


// $view='';
// if($status==false){
//   $error = $stmt->errorInfo();
//   exit('SQLエラー:'.$error[2]);

// }else{
//   $r = $sql->fetchAll(PDO::FETCH_ASSOC);
//   echo json_encode($r);
// }
?>