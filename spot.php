<?php
//解説ページのphpファイル
//解説文、解説動画、解説スポットに体するコメント投稿もできる機能をつける

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());
// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");
// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);

//index.phpのスポットリストからの受け取った情報を変数に代入
$id = $_GET["id"];




//index.phpから取得したidに該当するスポットのデータをspotテーブルから全て入手する
//それを$recordSet変数に代入して$dataで全て取り出す
//この2行でスポット名、解説文、スポット画像、予告動画を出力するための情報をデータベースから取得する
$recordSet = mysql_query("SELECT * FROM spot WHERE spot_id='$id'",$db);
$data = mysql_fetch_assoc($recordSet);

//解説動画を取得するためのPHP及びSQL文
//index.phpから取得したspot_idに該当する全ての解説動画をmovieテーブルから取得する
//取得した動画の情報は$recordSet1変数に代入する
$recordSet1 = mysql_query("SELECT * FROM movie WHERE spot_id='$id'",$db);


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

<!--cssファイルの読み込み-->


</head>

<body>

<div id="top" data-role="page" data-theme="a" data-content-theme="a">
	<header data-role="header">
		<a href="../mobile_guide/" data-role="button" data-icon="home">トップへ</a>
		<!--取得したspot_idのspot_nameを表示-->
		<h1><?php echo $data['spot_name']; ?></h1>
		<a href="javascript:location.reload(true);" data-role="button" data-icon="refresh">更新</a>
	</header>

	<div data-role="content">
		<div>
			<!--取得したspot_idのspot_photoを表示-->
			<img src="img/spot_img<?php echo $id; ?>.jpg" width="100%">
		</div>
	
		<div data-role="collapsible">
			<h3>予告ビデオ</h3>
				<!--yokoku_movieフォルダの中にある予告ビデオを再生させる-->
				<!--spot_idに該当する予告ビデオを選択する-->
				<p><video src="yokoku_movie/spot_yokoku<?php echo $id; ?>.mp4" width='100%'  controls preload='none'</p>
		</div>
		<div data-role="collapsible">
			<h3>解説ビデオ</h3>
				<p>
					<ul data-role="listview">
						<?php while($movie_data = mysql_fetch_assoc($recordSet1)){ ?>
							<li><video src="spot_movie/<?php echo $movie_data['movie_url']; ?>.mp4" width='100%' controls preload='none'</li>
						<?php } ?>
					</ul>
				</p>
		</div>
		<div data-role="collapsible">
			<h3>解説文</h3>
				<p><?php echo $data['spot_text'];?></p>
		</div>
		<div data-role="collapsible">
			<h3>コメント</h3>
						<form action="inputdo.php" method="post" enctype="multipart/form-data">

					<input type="hidden" name="id" value="<?php echo $id;?>" />	
					
					<dt>写真を投稿する</dt>
					<input name="my_img" type="file" id="my_img" size="50" accept="image/*" />
					
					<fieldset data-role="controlgroup" data-mini="true">
						<legend>名前</legend>

    					<input type="radio" name="user_name" id="radio-mini-1" value="小学校の先生" checked="checked" />
    					<label for="radio-mini-1">小学校の先生</label>
    					
    					<input type="radio" name="user_name" id="radio-mini-2" value="小学生"  />
    					<label for="radio-mini-2">小学生</label>
    					
    					<input type="radio" name="user_name" id="radio-mini-3" value="近隣住民"  />
    					<label for="radio-mini-3">近隣住民</label>	
					</fieldset>
					
					<dt>コメント入力</dt>
					<textarea name="comment" cols="50" rows="5"></textarea>			
						
					<input type="submit" value="コメントを送信する" />
				</form>
			</div>
		<div data-role="collapsible">
			<h3>コメントを見る</h3>
				<a href="post_view.php?id=<?php echo $id; ?>">コメント投稿を見るにはこちらから</a>
		</div>
	</div>


	<footer data-role="footer">
		<h4>&copy;YESLab, Nagoya University</h4>
	</footer>
</div>
</body>
</html>
