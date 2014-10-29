<!DOCTYPE html>
<html lang="<?php echo $this->getLangage();?>">
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $pageTitle;?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT."views/layout/"; ?>css/style.css">
		<?php
			foreach ($cssLoaded as $key => $value) {
				?>
		<link rel="stylesheet" type="text/css" href="<?php echo $value;?>">
				<?php
			}
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT."views/layout/"; ?>css/responsive.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php echo $content_for_header;?>
		<?php echo $content_for_layout;?>
		<?php echo $content_for_footer;?>
		<?php
			foreach ($jsLoaded as $key => $value) {
				?>
		<script type="text/javascript" src="<?php echo $value;?>"></script>
				<?php
			}
		?>
	</body>
</html>