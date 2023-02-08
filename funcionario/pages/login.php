<!-- Formulário de Login -->
<?php
session_start();

if (isset($_SESSION["loggedin"])) {
    header("location: index.php?link=2&acaoLOGIN=3");
    exit;
}
// $acaoPC = 'recuperar';
// require_once './controller/pedido.controller.php';
?>
<div class="row justify-content-evenly">
    <div class="col-4">
        One of two columns
    </div>
    <div class="col-5">
    <form action="index.php?link=2&acaoLOGIN=1" method="post">
        <legend><h1>Bem Vindo</h1></legend>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="login" id="login" placeholder="0000-0000-0000-xx">
            <label for="floatingInput">Usuario</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="senha">
            <label for="floatingInput">Senha</label>
        </div>
        <input class="mx-auto" type="submit" value="Entrar" />
    </form>
    </div>
</div>