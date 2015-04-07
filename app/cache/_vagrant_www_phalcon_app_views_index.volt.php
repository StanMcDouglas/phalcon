<!DOCTYPE html>
<html>
	<head>
		<title>Phalcon PHP Framework</title>
       <?php echo $this->elements->getCss(); ?>
        <meta charset='utf-8'>
	</head>
	<body>
    <div id="page">
    <div class="header">
        <div class="siteTitle">Phalcon Test</div>
        <div class="menu">
        <?php echo $this->elements->getMenu(); ?>
        </div>
    </div>
    <div class="content">
        <div class="sidebar">
            <?php echo $this->elements->getNav(); ?>
        </div>
        <div class="middle">
	    	<?php echo $this->getContent(); ?>

        </div>
        <br style="clear:both;" />
    </div>
    </div>
<?php echo $this->elements->getJs(); ?>
	</body>
</html>