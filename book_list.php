<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<?php
include ("configure.php");
$select_type = isset($_POST['select_type'])?$_POST['select_type']:"全部";
$link = new PDO('mysql:host='.$hostname.';dbname='.$database.';charset=utf8', $username, $password);
$select = "SELECT * FROM `book_cover`";
$book_cover_list = $link->query($select);

?>
<html>
	<head>
		<title>C-BookStore</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<form action="book_add.php" method="post">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="https://michaelchen.tech/img/c-prog/c-lang.png" alt="" /></span>
						<h1><strong>CPlus</strong> 無聊寫的書庫<br />
						</h1>
						<ul class="icons">
							<li><input style="text-align:center;" type="text" placeholder="請輸入關鍵字"></li>
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
										<img src="<?php echo $row['圖片']?>" alt="<?php echo $row['書名'];?>" />
									</a>
									<input type="button" onclick="javascript:location.href='./book_list.php?book=<?php echo $row['書名'];?>'" value="<?php echo $row['書名'];?>"></input><br>
								<?php
										if ($i++ == 3)
										{
											echo "</div><div>";
											$i = 0;
										}
									}
								?>
								</div>
							</section>

					</section>

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