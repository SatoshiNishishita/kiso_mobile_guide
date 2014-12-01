<?php

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());
// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");
// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);



//koen_guideのspotテーブルから全データを取得
$recordSet = mysql_query('SELECT * FROM spot',$db);
//$mapData = mysql_fetch_assoc($recordSet);

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

<!--googleマップを使うたまえのコード-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

</head>

<body>

<div id="top" data-role="page" data-theme="a" data-content-theme="a">
	<header data-role="header">
		<h1>木曽三川公園下見ガイド</h1>
		<!--更新ボタンをヘッダーにつける-->
		<a href="javascript:location.reload(true);" data-role="button" data-icon="refresh">更新</a>
	</header>
	
	<!--地図を表示するためのキャンパスの作成-->
	<div id="map_canvas" style="width:100%; height:300px"></div>

	<div data-role="content">
		<ul data-role="listview">
			<li><a href="spot.php?id=4" data-role="button" data-icon="star">住民のおすすめスポット</a></li>
			<div data-role="collapsible"> 
				<h3>解説スポット</h3>
				<!--解説スポットをデータベースから取得してリスト表示-->
				<?php
					while($data = mysql_fetch_assoc($recordSet)){
				?>
					<!--リストに表示したスポットを選択した場合そのスポットの解説ページへリンクさせるためにspot.phpにデータベースの情報を一緒に送る-->
					<ul data-role="listview">
						<li><a href="spot.php?id=<?php echo $data['spot_id']; ?>" data-role="button" data-icon="check"><?php echo $data['spot_name']; ?></a></li>
					</ul>
					<?php } ?>				
			</div>
		</ul>
	</div>

	<footer data-role="footer">
		<h4>&copy;YESLab, Nagoya University</h4>
	</footer>
</div>

<!--JavaScript-->
<script type="text/javascript" src="/../js/jquery.js"></script>
<script type="text/javascript">

	//地図を表示するためのjavascript
	var latlng = new google.maps.LatLng(35.14754717802414,136.6672718524933);//このパラメータで緯度経度を指定して表示する画面を指定している
	var myOptions = {
		zoom: 16,//最初のズームレベル
		center: latlng,//表示する場所の指定
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		sensor: true//GPSの起動を許可
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	//地図上にスポットのマーカーを立てる
		var marker1 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1474,136.666),
			});
			
		var marker2 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1462,136.668),
			});
		
		var marker3 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1443,136.668),
			});
		
		var marker4 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1431,136.668),
			});
			
		//マーカーに吹き出しを表示させて、リンクをつける
		var infowindow1 = new google.maps.InfoWindow({
			content: '<a href="spot.php?id=1">農家と水屋</a>'
			//<img src="img/spot_img1.jpg" width='50' height='50' />
			});
			infowindow1.open(map, marker1);
			
		var infowindow2 = new google.maps.InfoWindow({
			content: '<a href="spot.php?id=2">治水タワー</a>'
			});
			infowindow2.open(map, marker2);
			
		var infowindow3 = new google.maps.InfoWindow({
			content: '<a href="spot.php?id=3">治水神社</a>'
			});
			infowindow3.open(map, marker3);
		
		var infowindow4 = new google.maps.InfoWindow({
			content: '<a href="spot.php?id=4">締切堤</a>'
			});
			infowindow4.open(map, marker4);
			
</script>
</body>
</html>
