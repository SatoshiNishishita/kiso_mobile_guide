<?php

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());
// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");
// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);


//spot.phpもしくはinputdo.phpから送られてきたIDの情報を変数に代入する
$id = $_GET['id'];

//IDの情報を元にspotカラムとpostカラムをリレーショナルさせて対象のスポットの全ての情報をデータベースから取得する
//取得した情報を変数に代入する
$recordSet = mysql_query("SELECT * FROM post WHERE spot_id='$id' ORDER BY id DESC",$db);

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
		<h1>タイムライン</h1>
		<a href="javascript:location.reload(true);" data-role="button" data-icon="refresh">更新</a>
	</header>
	
	<div data-role="content">
		<?php while($data = mysql_fetch_assoc($recordSet)){ ?>
		<ul data-role="listview">
			<li>
				名前：<?php echo $data['user_name'];?><br />
				コメント：<?php echo $data['post_comment'];?>
			</li>
		</ul>
		<?php } ?>
	</div>

	<footer data-role="footer">
		<h4>&copy;YESLab, Nagoya University</h4>
	</footer>
</div>

</body>
</html>
