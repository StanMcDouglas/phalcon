<!DOCTYPE html>
<html>
	<head>
		<title>Phalcon PHP Framework</title>
       {{ this.elements.getCss() }}
        <meta charset='utf-8'>
	</head>
	<body>
    <div id="page">
    <div class="header">
        <div class="siteTitle">Phalcon Test</div>
        <div class="menu">
        {{  this.elements.getMenu() }}
        </div>
    </div>
    <div class="content">
		{{ content() }}
    </div>
    </div>
{{ this.elements.getJs() }}
	</body>
</html>