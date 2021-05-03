<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<?php
	include ("configure.php");
	$link = new PDO('mysql:host='.$hostname.';dbname='.$database.';charset=utf8', $username, $password);
	$pwdkey = isset($_POST['pwdkey'])?$_POST['pwdkey']:"";
	if ($pwdkey == "07")
	{
		$book_fn = isset($_POST['book_fn'])?$_POST['book_fn']:"";
		$book_writer = isset($_POST['book_writer'])?$_POST['book_writer']:"";
		$book_store = isset($_POST['book_store'])?$_POST['book_store']:"";
		$book_type = isset($_POST['book_type'])?$_POST['book_type']:"";
		$book_pic = isset($_POST['book_pic'])?$_POST['book_pic']:"";
		if ($book_fn != "")
		{
			$add_db = "INSERT INTO `book_info`(`書名`, `作者`, `出版社`, `類型`, `圖片`) VALUES (\"$book_fn\", \"$book_writer\", \"$book_store\", \"$book_type\", \"$book_pic\")";
			$link->exec($add_db);
			echo "<script>";
			echo "alert(\"上傳成功\")";
			echo "</script>";
		}
		else
		{
			echo "<script>";
			echo "alert(\"請輸入書名\")";
			echo "</script>";
		}
	}
	else if($pwdkey == "")
	{
		;
	}
	else
	{
		echo "<script>";
		echo "alert(\"暗密錯誤，上傳失敗\")";
		echo "</script>";
	}
?>
	<head>
		<title>C-Book</title>
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
						<h1><a href='index.php'>回到書庫</a>
						</h1>
					</header>
				<!-- Main -->
					<!-- Thumbnails -->
						<div>
							<table>
								<tr>
									<th>書名：
									</th>
									<th>
										<input name='book_fn' style="background-color:transparent;border-width:1px; width:100%;">
									</th>
								</tr>
								<tr>
									<th>作者：
									</th>
									<th>
										<input name='book_writer' style='background-color:transparent;border-width:1px;width:100%;'>
									</th>
								</tr>
								<tr>
									<th>出版社：
									</th>
									<th>
										<input name='book_store' style='background-color:transparent;border-width:1px;width:100%;'>
									</th>
								</tr>
								<tr>
									<th>類型：
									</th>
									<th>
										<input name='book_type' style='background-color:transparent;border-width:1px;width:100%;'>
									</th>
								</tr>
								<tr>
									<th>圖片：
									</th>
									<th>
										<input name='book_pic' style='background-color:transparent;border-width:1px;width:100%;'>
									</th>
								</tr>
								<tr>
									<th>暗密：
									</th>
									<th>
										<input name='pwdkey' style='background-color:transparent;border-width:1px;width:100%;'>
									</th>
								</tr>
							</table>
						</div>
						<input type="submit" value="上傳">
		</form>
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