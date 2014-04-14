<!DOCTYPE html>
<html lang="en">
	<head>
		<title>404 Page Not Found</title>
		<style type="text/css">

			::selection{ background-color: #E13300; color: white; }
			::moz-selection{ background-color: #E13300; color: white; }
			::webkit-selection{ background-color: #E13300; color: white; }

			body {
				background-color: #fff;
				margin: 40px;
				font: 13px/20px Consolas, Monaco, Courier New, Courier, monospace;
				color: #4F5155;
			}

			a {
				color: #003399;
				background-color: transparent;
				font-weight: normal;
				text-decoration: none;
			}

			a:hover {
				text-decoration: underline;
			}

			h1 {
				color: #444;
				background-color: transparent;
				font-size: 19px;
				font-weight: normal;
				margin: 0;
				padding: 14px 15px 10px 15px;
			}

			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				color: #444;
				display: block;
				margin: 0;
				padding: 12px 10px 12px 10px;
				border-radius: 5px;
			}

			#container {
				margin: 10px;
				border: 1px solid #FF0000;
				padding: 10px;
				border-radius: 5px;
			}

			p {
				margin: 12px 15px 12px 15px;
			}
		</style>
	</head>

	<body>
		<div id="container">
			<h1><?php echo $heading; ?></h1>
			<code>
				please contact the development team (<a href="http://jogjania.com/">Jogjania</a>) <?php echo $message; ?>
			</code>
		</div>
	</body>
</html>