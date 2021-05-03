<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<?php
include ("configure.php");
$select_type = isset($_POST['select_type'])?$_POST['select_type']:"全部";
$keyword = isset($_POST['keyword'])?$_POST['keyword']:"";
$link = new PDO('mysql:host='.$hostname.';dbname='.$database.';charset=utf8', $username, $password);


//總筆數
$select_num = "SELECT COUNT(*) AS 'num' FROM `book_info` WHERE `書名` NOT LIKE '%R18%' ";

	
//有沒有類別
$select = "SELECT * FROM `book_info` WHERE 1 AND `書名` NOT LIKE '%R18%' ";
//$select = "SELECT * FROM `book_info` WHERE 1 --AND `書名` NOT LIKE '%R18%' ";

if ($select_type == "書名") {
	$select_num.= "AND `書名` LIKE '%$keyword%'";
	$select.= "AND `書名` LIKE '%$keyword%'";
}
else if ($select_type == "作者") {
	$select_num.= "AND `作者` LIKE '%$keyword%'";
	$select.= "AND `作者` LIKE '%$keyword%'";
}
else if ($select_type == "出版社") {
	$select_num.= "AND `出版社` LIKE '%$keyword%'";
	$select.= "AND `出版社` LIKE '%$keyword%'";
}

$select_num_result = $link->query($select_num);
foreach ($select_num_result as $row)
	$num_of_book = $row['num'];

//確認頁數
$pages = ceil($num_of_book/20); //取得不小於值的下一個整數
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
  $page=1; //則在此設定起始頁數
} 
else {
  $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start = ($page-1)*20;

//$select.=" AND `級數` IN ('', '0', '1')";
$select.= " ORDER BY `書名` ASC LIMIT $start, 20";
$book_cover_list = $link->query($select);


	
?>
<html>
	<head>
		<title>C-Book</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<form action="index.php" method="post">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="https://michaelchen.tech/img/c-prog/c-lang.png" alt="" /></span>
						<h1>	 無聊寫的書庫-共<?php echo $num_of_book;?>本書
						<a href="book_add.php"><i class="fa fa-plus-square"></i></a>
						</h1>
						<ul class="icons">
							<li><input style="text-align:center;" type="text" placeholder="請輸入關鍵字" name="keyword"></li>
							<li>
								<select style="color:pink; text-align:center;" name="select_type">
									<option value="全部">全部</option>
									<option value="書名">書名</option>
									<option value="作者">作者</option>
									<option value="出版社">出版社</option>
								</select>
							</li>
							<li><input type="submit"></li>
						</ul>
					</header>
		</form>
				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
							<section class="thumbnails">
								<div>
								<?php
									$i = 0;
									foreach($book_cover_list as $row)
									{
								?>
									<a href="<?php echo $row['圖片'];?>">
										<img src="<?php echo $row['圖片']?>" alt="<?php echo $row['書名'];?>" height="350" />
									</a>
									<input type="button" value="<?php echo $row['書名'];?>"></input><br>
								<?php
										if (++$i == 5)
										{
											echo "</div>";
											$i = 0;
											echo "<div>";
										}
									}
								?>
								</div>
							</section>

					</section>
					
					<?php
							//分頁頁碼
							echo '共 '.$num_of_book.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
							echo "<br /><a href=?page=1>首頁</a> ";
							$last_page = $page - 1;
							$next_page = $page + 1;
							if ($page != 1)
								echo "<a href=?page=". $last_page .">上一頁</a> ";
							echo "第 ";
							for( $i=1 ; $i<=$pages ; $i++ ) {
									if ( $page-3 < $i && $i < $page+3 ) {
											echo "<a href=?page=".$i.">".$i."</a> ";
									}
							}
							echo "頁 ";
							if ($page != $pages)
								echo " <a href=?page=". $next_page .">下一頁</a> ";
							echo "<a href=?page=".$pages.">末頁</a><br /><br />";
					?>

				<!-- Footer -->
					<footer id="footer">
						<p>此網站不做營利使用<br>網站來源：<a href="http://templated.co">TEMPLATED</a>. Demo Images: <a href="http://unsplash.com">Unsplash</a>.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>