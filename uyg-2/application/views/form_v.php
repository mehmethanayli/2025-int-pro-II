<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Uygulama - 1 </title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding: 0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>

<body>

	<div id="container">
		<h1>Kullanıcı Kayıt Uygulaması</h1>

		<div id="body">
			<p>Lütfen aşağıdaki formu doldurunuz!</p>
			<form action="<?php echo base_url("form_app/insert") ?>" method="post">
				<code>
					<label for="name">Adınız: </label>
					<!-- Value Değeri İçin Repopulate İşlemi Gerçekleştirildi -->
					<input type="text" name="name" id="name" 
					value="<?php echo isset($form_error) ? set_value("name") : "" ?>">
					<?php
					/* İlgili Input için hata mesajı hazırlandı. */
					if (isset($form_error)) {
						echo form_error("name");
					}
					?>

				</code>

				<code>
					<label for="surname">Soyadınız: </label>
					<input type="text" name="surname" id="surname"
					value="<?php echo isset($form_error) ? set_value("surname") : "" ?>">
					<?php
					if (isset($form_error)) {
						echo form_error("surname");
					}
					?>
				</code>


				<code>
					<label for="uname">Kullanıcı Adı:</label>
					<input type="text" name="username" id="uname">
				</code>

				<code>
					<label for="pass">Şifre:</label>
					<input type="password" name="password" id="pass">
					<?php
					if (isset($form_error)) {
						echo form_error("password");
					}
					?>
				</code>

				<input type="submit" value="Kullanıcı Kaydet">
			</form>
		</div>

	</div>

</body>

</html>