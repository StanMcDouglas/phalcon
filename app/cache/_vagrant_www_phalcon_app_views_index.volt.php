<!DOCTYPE html>
<html>
	<head>
		<title>Phalcon PHP Framework</title>
       <?php echo $this->elements->getCss(); ?>
	</head>
	<body>
    <div id="page">
    <div class="header">
<?php echo $this->elements->getMenu(); ?>
    </div>
    <div class="content">
		<?php echo $this->getContent(); ?>
    </div>
    </div>
<?php echo $this->elements->getJs(); ?>
	</body>
</html>