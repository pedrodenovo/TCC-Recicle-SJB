<!-- Formulário de Login -->
<?php
session_start();

if (isset($_SESSION["loggedin"])) {
    header("location: index.php?link=2&acaoLOGIN=3");
    exit;
}
?>
<div class="container text-center">
    <div class="row">
    <div class="col-md-12 col-lg-6">
        
    </div>

    <div class="col-md-12 col-lg-6 d-flex">
        <legend><h1>Bem Vindo</h1>
     <form action="index.php?link=2&acaoLOGIN=1" method="post">
        <div class="form-floating mb-3
        ">
            <input type="text" class="form-control" name="login" id="login" placeholder="0000-0000-0000-xx">
            <label for="floatingInput">Usuario</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="senha" id="senha" placeholder="senha">
            <label for="floatingInput">Senha</label>
        </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input class="btn btn-primary" type="submit" value="Entrar" />
            </div>
    </form>
    </legend>
       
    </div>
    </div>
</div>