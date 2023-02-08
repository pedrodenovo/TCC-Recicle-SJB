<html lang="pt-br">

<head>

</head>

<body>

    <!-- CONTEUDO DO SITE -->
    <main role="main">
        <div class="d-flex justify-content-evenly">


        </div>
        <div class="text-dark">
            <h1 class="d-flex justify-content-evenly" style="color: #000;">RECICLE SJB</h1>
            <p class="d-flex justify-content-evenly">Associação dos agentes recicladores joaquinenses.</p>
        </div>

        <div class="container marketing">

            <hr class="featurette-divider">

            <div class="row featurette">
                <h1>Cadastro de pedido</h1>
                <div class="row">
                    <div></div>
                    <div class="row">
                        <form class="col s12" action="index.php?link=2&tratar=1" method="post">
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <label class="form-label" for="FORM_nome">Nome</label>
                                    <input name="FORM_nome" id="FORM_nome" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <label class="form-label" for="FORM_telefone">Telefone</label>
                                    <input name="FORM_telefone" id="FORM_telefone" type="text" class="form-control">
                                </div>
                            </div>
                            <h2>Endereço</h2>
                            <div class="row">
                                <div class="col-8">
                                    <div class="input-field col s12 m12 l12">
                                        <label class="form-label" for="FORM_rua">Rua</label>
                                        <input name="FORM_rua" id="FORM_rua" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field col s12 m12 l12">
                                        <label class="form-label" for="FORM_numero">Nº</label>
                                        <input name="FORM_numero" id="FORM_numero" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-field col s12 m12 l12">
                                        <label class="form-label" for="FORM_bairro">Bairro</label>
                                        <input name="FORM_bairro" id="FORM_bairro" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-field col s12 m12 l12">
                                        <label class="form-label" for="FORM_complemento">Complemento</label>
                                        <input name="FORM_complemento" id="FORM_complemento" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h2>Residos</h2>
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <label class="form-label" for="FORM_descricao">Descriva seus residuos</label>
                                    <textarea name="FORM_descricao" id="FORM_descricao" type="text" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <h2 class="form-label" for="material">Materiais</h2>
                                    <p>Selecione a opção que melhor descreve os materiais que serão coletados</p>
                                    <div class="d-flex justify-content-around">
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_papel" value="Papel, " id="FORM_papel">
                                            <label class="form-check-label" for="FORM_papel">
                                                Papel
                                            </label>
                                        </div>
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_plastico" value="plastico, " id="FORM_plastico">
                                            <label class="form-check-label" for="FORM_plastico">
                                                Plastico
                                            </label>
                                        </div>
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_vidro" value="vidro, " id="FORM_plastico">
                                            <label class="form-check-label" for="FORM_plastico">
                                                Vidro
                                            </label>
                                        </div>
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_metal" value="metal, " id="FORM_metal">
                                            <label class="form-check-label" for="FORM_metal">
                                                Metais
                                            </label>
                                        </div>
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_eletronico" value="eletronicos, " id="FORM_eletronico">
                                            <label class="form-check-label" for="FORM_eletronico">
                                                Eletronicos
                                            </label>
                                        </div>
                                        <div> <input class="form-check-input" type="checkbox" name="FORM_outros" value="outros" id="FORM_outros">
                                            <label class="form-check-label" for="FORM_outros">
                                                Outros
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="input-field col-4 s12 mx-auto">
                                    <input class="form-control btn btn-success" type="submit" name="FORM_submit">
                                </div>
                            </div>
                        </form>
                        <form class="col s12" action="index.php?link=3&acaoPC=inserir" name='newForm' method="post">
                            <?php

                            if (isset($_GET['tratar']) == "1") {
                                // echo "<a href='https://www.google.com/maps/place/$enderecoURL'>CLICK2</a><br>";
                                $nome = $_POST['FORM_nome'];
                                $telefone = $_POST['FORM_telefone'];
                                $material = $_POST['FORM_papel'] . $_POST['FORM_plastico'] . $_POST['FORM_vidro'] . $_POST['FORM_metal'] . $_POST['FORM_eletronicos'] . $_POST['FORM_outros'];
                                $complemento =  $_POST['FORM_complemento'];
                                $descricao = $_POST['FORM_descricao'];
                                $endereco = $_POST['FORM_rua'] . ', ' . $_POST['FORM_numero'] .  $_POST['FORM_bairro'] . ', são joaquim da barra, SP';
                                $enderecoURL = urlencode($_POST['FORM_rua'] . ', ' . $_POST['FORM_numero'] . ', sao joaquim da barra, SP');
                                $aceita = 0;
                                echo "<input type='hidden' name='nome' value='$nome'>";
                                echo "<input type='hidden' name='telefone' value='$telefone'>";
                                echo "<input type='hidden' name='material' value='$material'>";
                                echo "<input type='hidden' name='descricao' value='$descricao'>";
                                echo "<input type='hidden' name='endereco' value='$endereco'>";
                                echo "<input type='hidden' name='aceita' value='$aceita'>";
                                echo "<input type='hidden' name='enderecoURL' value='$enderecoURL'>";
                            ?>
                                <script type="text/javascript">
                                    document.newForm.submit()
                                </script>
                            <?php }
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>