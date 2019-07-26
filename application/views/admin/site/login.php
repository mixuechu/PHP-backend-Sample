<!DOCTYPE html>

<html>

<head>

<title>Tinco</title>

<!-- meta_tags-->

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="keywords" content="connective login form a Flat Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);

function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Meta_tag_Keywords -->

<link href="<?php echo base_url(); ?>assets/login/css/style.css" rel="stylesheet" type="text/css" media="all"><!--style_sheet-->

<link href="<?php echo base_url(); ?>assets/login/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"><!--font_awesome_icons-->

<!--web_fonts-->

<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext" rel="stylesheet">

<!--//web_fonts-->

</head>

<body>

<div class="form">

<h1>Tinco</h1>

	<div class="form-content">

		<form action="<?php echo base_url(); ?>admin/index" method="post">

			<!-- <div class="form-info">

				<h2>Login</h2>

			</div> -->

			<div style="color: #ff0e0e;font-size: 17px;">

			<?= alertWidget($this->session->flashdata('success'),0);?>

            <?= alertWidget($this->session->flashdata('error'));?>

            <?= alertWidget(validation_errors());?>

            <?php if (isset($error)) {echo alertWidget($error);}?>

            </div>

			<div class="email-w3l">

				<span class="i1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>

				<input class="email" type="email" name="email" placeholder="Email" required="" autocomplete="off">

			</div>

			<div class="pass-w3l">

			

			<span class="i2"><i class="fa fa-unlock" aria-hidden="true"></i></span>

				<input class="pass" type="password" name="password" placeholder="Password" required="" autocomplete="off">

			</div>

			<div class="submit-agileits">

				<input class="login" type="submit" value="login">

			</div>

		</form>

	</div>

</div>



<footer>&copy; <?php echo date('Y'); ?> All rights reserved by brahmaslabs</footer>



</body>

</html>