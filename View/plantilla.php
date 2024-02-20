<!DOCTYPE html>
<html lang="es">
<head>
	<title><?=COMPANY?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?=APP_URL?>View/css/main.css">
</head>
<body>
	<?php
		session_start();

		require_once "./Controller/viewsController.php";

		$vt = new viewsController();
		$viewsR = $vt->obtener_views_controller();

		if($viewsR == "login" || $viewsR == "404"):
			if($viewsR == "login"){
				require_once "./View/content/login-view.php";
			}else{
				require_once "./View/content/404-view.php";
			}
		else:
			session_start()
	?>
	<!-- SideBar -->
    <?php include "module/navlateral.php" ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
        <?php include "module/navbar.php" ?>
		<!-- Content page -->
		<?php require_once $viewsR; ?>
	</section>
	<?php
		endif;
	?>
	<!--====== Scripts -->
	<?php include "module/script.php" ?>
</body>
</html>