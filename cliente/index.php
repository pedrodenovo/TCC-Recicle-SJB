<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Recicle SJB</title>
</head>

<body>
  <?php include 'componentes/navbar.php' ?>
  <div class="container">
    <?php if (isset($_GET['EnvSucesso'])){?>
    <script>
        alert("Pedido enviado com sucesso");
    </script>
    <?php
    }
    @$link = @$_GET['link'];
    $pag[1] = './pages/home_page.php';
    $pag[2] = './pages/pedido_coleta.php';
    $pag[3] = './controller/pedido.controller.php';

    if (!empty($link)) {
      if (file_exists($pag[$link])) {
        include $pag[$link];
      }
    } else {
      trim(include 'home_page.controller.php');
    }
    ?>
    <hr>
    <?php include 'componentes/footer.php' ?>
  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>

</html>