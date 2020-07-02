<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <title><?php echo "SVG Automation"; ?> </title>
	
	<style>
	
		html {
			font-family: "Righteous";
		}
	
		#svgMadeByPHP {
			border-style: solid;
			padding: 2%;
		}
	
	</style>
	
  </head>
  <body>
  
	<div>
		<h1>SVG Automation</h1>
		<p>Below will be an attempt at SVG automation.</p>
		<hr/>
<?php
	
	require_once("render_engine.php");
	
	$re = new RenderEngine("./words/words.txt");
	$re->MakeSVG();
	
?>

	</div>

	
  </body>
</html>
