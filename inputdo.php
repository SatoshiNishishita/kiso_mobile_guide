<?php
//コメント投稿されたデータをデータベースの保存するphpファイル

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());
// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");
// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);

//spot.phpから送られてきた情報を変数に代入する
$id = $_POST['id'];
$name = $_POST['user_name'];
$comment = $_POST['comment'];

//spot.phpから送られてきたコメント投稿の情報をデータベースに保存する
//spot_idカラムにはIDの情報を挿入
//user_nameカラムには投稿したユーザーのジャンルを挿入
//post_commentにはユーザーの投稿した内容を挿入する
$data_insert = ("INSERT INTO post(spot_id, user_name, post_comment) VALUES('$id', '$name', '$comment')");
mysql_query($data_insert,$db);
?>

<?php
$file = $_FILES['my_img'];
// ファイルアップロードの処理をする
$ext = substr($file['name'], -4);
if ($ext == '.gif' || $ext == '.jpg' || $ext == '.png') {
	$filePath = './userimg/' . $file['name'];
	move_uploaded_file($file['tmp_name'], $filePath);
	print('<img src="' . $filePath . '" />');
} else {
	print('※拡張子が.gif, .jpg, .pngのいずれかのファイルをアップロードしてください');
}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>木曽三川公園社会科見学ガイド</title>

<!--jquery mobileを組み込むためのコード-->
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>

<!--スマートフォンで表示する際に文字が小さくならないようにするためのコード-->
<meta name="viewport" content="initial-scale=1.0, user-scale=no" />

</head>

<body>

<div id="top" data-role="page" data-theme="a" data-content-theme="a">
	<header data-role="header">
		<a href="../mobile_guide/" data-role="button" data-icon="home">トップへ</a>
		<h1>送信完了</h1>
		<a href="javascript:location.reload(true);" data-role="button" data-icon="refresh">更新</a>
	</header>
	<div data-role="content">
	<p>以下の情報を送信しました</p>
	<ul data-role="listview">
		<li>名前：<?php echo $name; ?></li>
		<li>投稿内容：<?php echo $comment; ?></li>
		<li><a href="post_view.php?id=<?php echo $id; ?>">投稿したコメントを見る</a></li>
	</ul>
	</p>	
</div>
	
	<footer data-role="footer">
		<h4>&copy;YESLab, Nagoya University</h4>
	</footer>
</div>

<!--JavaScript-->ß

</body>
</html>
