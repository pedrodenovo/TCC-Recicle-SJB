<?php
if ($_SESSION["func"] == 'admin' || $_SESSION["func"] == 'coordenador') {
require_once './controller/pedidos.controller.php';

function ifFuncao($pedao, $valor, $return)
{
    if ($pedao == $valor) {
        return $return;
    }
}
function orderTipoGet(){
    if (isset($_GET['orderTipo']) and $_GET['orderTipo'] == 'ASC'){
        return "DESC";
    }elseif (isset($_GET['orderTipo']) and $_GET['orderTipo'] == 'DESC'){
        return "ASC";
    }else{
        return "DESC";
    }
}
function addEditarPedido($id)
{
    $nome = "";
    $telefone = "";
    $descricao = "";
    $data_hora = "";
    $material = "";
    $enderecoURL = "";
    $endereco = "";
    foreach (recuperarPedidoExpecifico($id) as $index => $ped) {
        $nome = $ped->nome;
        $telefone = $ped->telefone;
        $descricao = $ped->descricao;
        $data_hora = $ped->data_hora;
        $material = $ped->material;
        $enderecoURL = $ped->enderecoURL;
        $endereco = $ped->endereco;
    }
    echo '<div class="modal fade" id="editarPedido' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarPedidoLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=100&acaoPEDIDO=alterar&reSceneLogin=4" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editarPedidoLabel">Editar Pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $id . '">
        <input class="form-control" type="hidden" id="enderecoURL" name="enderecoURL" value="' . $enderecoURL . '">
        <input class="form-control" type="hidden" id="aceita" name="aceita" value="0">
        <label class="form-label" for="nome">Nome</label>
        <input class="form-control" type="text" id="nome" name="nome" value="' . $nome . '">
        <label class="form-label" for="telefone">telefone</label>
        <input class="form-control" type="text" id="telefone" name="telefone" value="' . $telefone . '">
        <label class="form-label" for="endereco">Endereço</label>
        <input class="form-control" type="text" id="endereco" name="endereco" value="' . $endereco . '">
        <label class="form-label" for="descricao">Descrição</label>
        <textarea class="form-control" type="text" id="descricao" name="descricao" rows="4" cols="50">' . $descricao . '</textarea>
        <label class="form-label" for="data_hora"> Data e hora</label>
        <input disabled class="form-control" type="text" id="data_hora" name="data_hora" value="' . $data_hora . '">
        <label class="form-label" for="material">Materiais</label>
        <input class="form-control" type="text" id="material" name="material" value="' . $material . '">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
    </div>
    </form>
</div>
</div>';
    echo '<div class="modal fade" id="viewPedido' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewPedidoLabel" aria-hidden="true">
<div class="modal-dialog">
<form method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewPedidoLabel">Pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input disabled class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $id . '">
        <input disabled class="form-control" type="hidden" id="enderecoURL" name="enderecoURL" value="' . $enderecoURL . '">
        <input disabled class="form-control" type="hidden" id="aceita" name="aceita" value="0">
        <label class="form-label" for="nome">Nome</label>
        <input disabled class="form-control" type="text" id="nome" name="nome" value="' . $nome . '">
        <label class="form-label" for="telefone">telefone</label>
        <input disabled class="form-control" type="text" id="telefone" name="telefone" value="' . $telefone . '">
        <label class="form-label" for="endereco">Endereço</label>
        <input disabled class="form-control" type="text" id="endereco" name="endereco" value="' . $endereco . '">
        <label class="form-label" for="descricao">Descrição</label>
        <textarea disabled class="form-control" type="text" id="descricao" name="descricao" rows="4" cols="50">' . $descricao . '</textarea>
        <label class="form-label" for="data_hora"> Data e hora</label>
        <input disabled disabled class="form-control" type="text" id="data_hora" name="data_hora" value="' . $data_hora . '">
        <label class="form-label" for="material">Materiais</label>
        <input disabled class="form-control" type="text" id="material" name="material" value="' . $material . '">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>
    
    </form>
</div>
</div>';
    echo '<div class="modal fade" id="ExcluirPedido' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ExcluirPedidoLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=100&acaoPEDIDO=deletar&reSceneLogin=4" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="ExcluirPedidoLabel">Excluir Pedido</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <h1 class="mx-auto modal-title fs-5" id="ExcluirPedidoLabel">Tem certeza?</h1>
        <p class="mx-auto fs-5">Isso é uma ação sem volta.</p>
        <input class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $id . '">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
    </div>
    </form>
</div>
</div>';
}
function funcao($valor)
{
    if ($valor == 'agenteR') {
        return 'Agente Reciclador';
    } else if ($valor == 'admin') {
        return 'Administrador';
    } else if ($valor == 'coordenador') {
        return 'Coordenador';
    }
}
function podeDirigir($valor)
{
    if ($valor == '0') {
        return 'Não';
    } else if ($valor == '1') {
        return 'Sim';
    }
}
?>
<div class="modal fade" id="addPedido" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPedidoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/index.php?link=3&sceneLogin=4&tratar=1" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPedidoLabel">Adicionar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <h6>Endereço</h6>
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
                    <div class="row">
                            <p>Selecione um dia e um horario conveniente para realizar a coleta</p>
                        <div class="col-6">
                                <div class="input-field col s12 m12 l12">
                                    <label class="form-label" for="FORM_dataDesejada">Data desejada</label>
                                    <input name="FORM_dataDesejada" id="FORM_dataDesejada" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-field col s12 m12 l12">
                                    <label class="form-label" for="FORM_horaDesejada">Hora desejada</label>
                                    <input name="FORM_horaDesejada" id="FORM_horaDesejada" type="time" class="form-control">
                                </div>
                            </div>
                        </div>
                    <h6>Residos</h6>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <label class="form-label" for="FORM_descricao">Descriva os residuos</label>
                            <textarea name="FORM_descricao" id="FORM_descricao" type="text" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <h6 class="form-label" for="material">Materiais</h6>
                            <p>Selecione as opções que melhor descrevem os materiais que serão coletados</p>
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
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
        </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="container mx-auto row row-md">
        <div class="mx-auto">
            <h2>Lista de pedidos</h2>
            
            <div classe="d-flex align-items-end flex-column">
            <button class="p-2 btn btn-success noprint" onclick="window.print()">Imprimir
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg>
                </button>
                <button type="button" class="p-2 btn btn-success justify-content-end noprint" data-bs-toggle="modal" data-bs-target="#addPedido">
                    Adicionar Pedido
                </button>
            </div>
        </div>
        <div class=" noprint">
        </div>
        <div class="scrollmenu">
            <table class="table">
                <thead>
                    <tr>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=4&orderTipo=<?=orderTipoGet()?>&orderValor=id_pedido">Id</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=4&orderTipo=<?=orderTipoGet()?>&orderValor=nome">Nome</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=4&orderTipo=<?=orderTipoGet()?>&orderValor=telefone">Telefone</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=4&orderTipo=<?=orderTipoGet()?>&orderValor=endereco">Endereço</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=4&orderTipo=<?=orderTipoGet()?>&orderValor=data_hora">Hora do pedido</a></td>
                    </tr>
                    <br>
                    <tr>
                        <input class="form-control noprint" id="gfg" type="text" placeholder="Procurar na tabela">
                    </tr>
                </thead>
                <tbody id="listaPedidos" class="table-group-divider">
                    <?php foreach (recuperarPedido() as $index => $ped) {
                        if ($ped->aceita == "0") {
                            addEditarPedido($ped->id_pedido);
                            echo '<tr><td>' . $ped->id_pedido . '</td><td>' . $ped->nome . '</td><td>' . $ped->telefone . '</td><td>' . $ped->endereco . '</td><td>' . $ped->data_hora . '</td><td></td><markNoprint class="noprint"><td>
                <a data-bs-toggle="modal" data-bs-target="#editarPedido' . $ped->id_pedido . '" class="noprint" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                  </svg></a></td>
                  <td>            
                  <a class="noprint" data-bs-toggle="modal" data-bs-target="#ExcluirPedido' . $ped->id_pedido . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg></a></td
                ><td>            
                <a class="noprint" data-bs-toggle="modal" data-bs-target="#viewPedido' . $ped->id_pedido . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              </a></td></markNoprint>
              </tr>';
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form class="col s12" action="/index.php?link=3&sceneLogin=100&acaoPEDIDO=inserir&reSceneLogin=6" name='newForm' method="post">
    <?php

    if (isset($_GET['tratar']) == "1") {
        // echo "<a href='https://www.google.com/maps/place/$enderecoURL'>CLICK2</a><br>";
        $nome = $_POST['FORM_nome'];
        $telefone = $_POST['FORM_telefone'];
        $material = $_POST['FORM_papel'] . $_POST['FORM_plastico'] . $_POST['FORM_vidro'] . $_POST['FORM_metal'] . $_POST['FORM_eletronicos'] . $_POST['FORM_outros'];
        $complemento =  $_POST['FORM_complemento'];
        $descricao = $_POST['FORM_descricao'];
        $horaDesejada = $_POST['FORM_horaDesejada'];
        $dataDesejada = $_POST['FORM_dataDesejada'];
        $endereco = $_POST['FORM_rua'] . ', ' . $_POST['FORM_numero'] . ', ' .  $_POST['FORM_bairro'] . ', são joaquim da barra, SP';
        $enderecoURL = urlencode($_POST['FORM_rua'] . ', ' . $_POST['FORM_numero'] . ', sao joaquim da barra, SP');
        $aceita = 0;
        echo "<input type='hidden' name='nome' value='$nome'>";
        echo "<input type='hidden' name='telefone' value='$telefone'>";
        echo "<input type='hidden' name='material' value='$material'>";
        echo "<input type='hidden' name='descricao' value='$descricao'>";
        echo "<input type='hidden' name='endereco' value='$endereco'>";
        echo "<input type='hidden' name='aceita' value='$aceita'>";
        echo "<input type='hidden' name='enderecoURL' value='$enderecoURL'>";
        echo "<input type='hidden' name='horaDesejada' value='$horaDesejada'>";
        echo "<input type='hidden' name='dataDesejada' value='$dataDesejada'>";
    ?>
        <script type="text/javascript">
            document.newForm.submit()
        </script>
    <?php }
    ?>
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#gfg").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#listaPedidos tr").filter(function() {
                $(this).toggle($(this).text()
                    .toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<style>
    @media print {
        .noprint {
            opacity: 0%;
            display: none;
        }

        body {
            background: #fff;
            width: 100%;
        }

        div.scrollmenu {
            opacity: 100%;
        }
        table {
        font-size: 9px;
    }
    @page {
    size: landscape;
}
}

    

    div.scrollmenu {
        overflow: auto;
        white-space: nowrap;
    }
</style>
<?php } ?>