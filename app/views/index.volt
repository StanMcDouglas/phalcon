<!DOCTYPE html>
<html>
	<head>
		<title>Phalcon PHP Framework</title>
       {{ this.elements.getCss() }}
	</head>
	<body>
    <div id="page">
    <div class="header">
{{  this.elements.getMenu() }}
    </div>
    <div class="content">
		{{ content() }}
    </div>
    </div>
{{ this.elements.getJs() }}
	</body>
</html>