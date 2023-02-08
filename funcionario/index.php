<!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Recicle SJB</title>
</head>
    <body>
		<?php
			@$link = @$_GET['link'];
			$pagI[1]='pages/login.php';
      $pagI[2]='controller/login.controller.php';
      $pagI[3]='login.index.php';
			
			if(!empty($link)){
					if(file_exists($pagI[$link])){
						include $pagI[$link];
					}
			}else{
				trim(include 'pages/login.php');
			}
		?>
    <hr>
    </body>
  </html>