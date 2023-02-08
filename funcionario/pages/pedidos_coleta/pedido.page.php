<?php
require_once './controller/pedidos.controller.php';
require_once './controller/funcionario.controller.php';
require_once './controller/agenda_funcionario.controller.php';
require_once './controller/veiculo.controller.php';
if ($_SESSION["func"] == 'admin' || $_SESSION["func"] == 'coordenador') {
    function dataParaInteiro($data, $convBC)
    {
        if ($convBC == true) {
            $forRemove = array("-", ':', 't', 'T', ' ');
            $valorRetorno = intval(str_replace($forRemove, "", $data) . '00');
            return $valorRetorno;
        } else {
            $forRemove = array("-", ':', 't', 'T', ' ');
            $valorRetorno = intval(str_replace($forRemove, "", $data));
            return $valorRetorno;
        }
    }

    if (isset($_GET['criarAgendamento']) == true) {
        criarAgedamento();
        alterarSituacaoPedido($_POST['id_pedido'],1);
        echo '<script>window.location.href = "/index.php?link=3&sceneLogin=6";</script>';
    }
?>
    <form class="col s12" action="/index.php?link=3&sceneLogin=100&acaoPEDIDO=inserir&reSceneLogin=6" name='newForm' method="post">
        <?php

        if (isset($_GET['tratar']) == "1") {
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

    <div class="container-fluid">
        <div class="container mx-auto row row-md">
            <div class="mx-auto">
                <h2>Novos pedidos</h2>
                <?php
                if (isset($_GET['formSelected'])) {
                    foreach (recuperarPedidoExpecifico($_POST['id_pedido']) as $index => $ped) {
                        if (isset($_GET['timeSelected']) == true) {
                            if (dataParaInteiro($_POST['horario_inicio'], true) < 1 || dataParaInteiro($_POST['horario_fim'], true) < 1) {
                                echo '  <script>
                                    alert("Selecione um horario valido, por favor escolha outra hora.");
                                    window.location.href = "/index.php?link=3&sceneLogin=6";
                                    </script>';
                            };
                ?>
                            <div class=" card text-bg-light col-12 mb-3">
                                <div class="card-body row">
                                    <div class="col-6">
                                        <p><b>Nome:</b> <?= $ped->nome ?></p>
                                        <p><b>Endereco:</b> <?= $ped->endereco ?></p>
                                        <p><a target="_blank" href='https://www.google.com/maps/place/<?= $ped->enderecoURL ?>'><b>Ver endereço no google maps</b></a></p>
                                        <p><b>Telefone:</b> <?= $ped->telefone ?></p>
                                        <p class=""><b>Materiais:</b> <?= $ped->material ?></p>

                                    </div>
                                    <div class="col-6">

                                        <div class="">
                                            <p><b>Horario desejado:</b> <?= $ped->horaDesejada ?></p>
                                            <p><b>Data desejado:</b> <?= $ped->dataDesejada ?></p>
                                            <p><b>Descricao:</b></p>
                                            <div class="scrollmenu"><textarea disabled value="" cols="50" rows="3"><?= $ped->descricao ?></textarea></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/index.php?link=3&sceneLogin=6&formSelected=true&timeSelected=true&criarAgendamento=true" method="post">
                                <div class="card-body row">
                                    <div class="col-6 row">
                                        <p><b>Horario inicio:</b> <input value="<?= $_POST['horario_inicio'] ?>" class="form-control" disabled type="datetime-local" name="horario_inicio" id="horario_inicio"></p>
                                        <input class="form-control" value="<?= $_POST['horario_inicio'] ?>" type="hidden" name="horario_inicio" id="horario_inicio">
                                    </div>
                                    <div class="col-6 row">
                                        <p><b>Horario previsto para fim:</b> <input value="<?= $_POST['horario_fim'] ?>" class="form-control" disabled type="datetime-local" name="horario_fim" id="horario_fim"></p>
                                        <input class="form-control" value="<?= $_POST['horario_fim'] ?>" type="hidden" name="horario_fim" id="horario_fim">
                                    </div>
                                    <hr>
                                    <div class="col-6 row">
                                        <p><b>Selecione um funcionario disponivel:</b> <select class="form-control" name="id_funcionario" id="id_funcionario">
                                                <?php $qntFuncionario = 0;
                                                foreach (recuperarFuncionario() as $index => $funcionario) {
                                                    $funcPASS = true;
                                                    if ($funcPASS == true and $_POST['precisa_veiculo'] == 'true' and $funcionario->motorista == 0) {
                                                        $funcPASS = false;
                                                        foreach (recuperarAgendamentoExpecificoFuncionario($funcionario->id_funcionario) as $index => $agendamento) {
                                                        }
                                                        if ($funcPASS == true and dataParaInteiro($agendamento->horario_fim, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_fim, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                            $funcPASS = false;
                                                        }
                                                        if ($funcPASS == true and dataParaInteiro($agendamento->horario_inicio, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_inicio, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                            $funcPASS = false;
                                                        }
                                                    }

                                                    if ($funcPASS) {
                                                        $qntFuncionario += 1;
                                                        echo '<option value="' . $funcionario->id_funcionario . '">' . $funcionario->id_funcionario . ' - ' . $funcionario->nome . '</option>';
                                                    }
                                                }
                                                if ($qntFuncionario == 0) {
                                                    echo '<script>
                                                alert("Sem funcionario disponiveis para esse horario, por favor escolha outra hora.");
                                                window.location.href = "/index.php?link=3&sceneLogin=6";
                                                </script>';
                                                }
                                                ?>
                                            </select></p>
                                    </div>
                                    <div class="col-6 row">
                                        <?php if ($_POST['precisa_veiculo'] == 'true') {
                                        ?>
                                            <p><b>Selecione um veiculo disponivel:</b> <select class="form-control" name="id_veiculo" id="id_veiculo">
                                                    <?php $qntVeiculo = 0;
                                                    foreach (recuperarVeiculo() as $index => $veiculo) {
                                                        if ($veiculo->id_veiculo >= 0) {
                                                            $veiculoPASS = true;
                                                            foreach (recuperarAgendamentoExpecificoVeiculo($veiculo->id_veiculo) as $index => $agendamento) {
                                                                if ($veiculoPASS == true and dataParaInteiro($agendamento->horario_fim, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_fim, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                                    $veiculoPASS = false;
                                                                }
                                                                if ($veiculoPASS == true and dataParaInteiro($agendamento->horario_inicio, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_inicio, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                                    $veiculoPASS = false;
                                                                }
                                                            }
                                                            if ($veiculoPASS) {
                                                                $qntVeiculo += 1;
                                                                echo '<option value="' . $veiculo->id_veiculo . '">' . $veiculo->placa_veiculo . ' - ' . $veiculo->modelo . '</option>';
                                                            }
                                                        }
                                                    }
                                                    if ($qntVeiculo == 0) {
                                                        echo '<script>
                                                              alert("Sem veiculos disponiveis, por favor escolha outra hora.");
                                                              window.location.href = "/index.php?link=3&sceneLogin=6";
                                                              </script>';
                                                    }
                                                    ?>
                                                </select></p>
                                        <?php
                                        } else {
                                            echo '<input value="-1" type="hidden" name="id_veiculo" id="id_veiculo">';
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <input type="hidden" value="<?= $ped->id_pedido ?>" name="id_pedido">
                                        <input type="submit" value="Criar agendamento" class="p-2 btn btn-dark">
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="card text-bg-light col-12 mb-3">
                                <div class=" card-body row">
                                    <div class="col-6">
                                        <p><b>Nome:</b> <?= $ped->nome ?></p>
                                        <p><b>Endereco:</b> <?= $ped->endereco ?></p>
                                        <p><a target="_blank" href='https://www.google.com/maps/place/<?= $ped->enderecoURL ?>'><b>Ver endereço no google maps</b></a></p>
                                        <p><b>Telefone:</b> <?= $ped->telefone ?></p>
                                        <p><b> <a target="_blank" href="https://wa.me/<?= $ped->telefone ?>">Clique aqui para entrar em contato via whatsapp.</a></b></p>

                                        <p class=""><b>Materiais:</b> <?= $ped->material ?></p>

                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <p><b>Horario desejado:</b> <?= $ped->horaDesejada ?></p>
                                            <p><b>Data desejado:</b> <?= $ped->dataDesejada ?></p>
                                            <p><b>Descricao:</b></p>
                                            <div class="scrollmenu"><textarea disabled value="" cols="50" rows="3"><?= $ped->descricao ?></textarea></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/index.php?link=3&sceneLogin=6&formSelected=true&timeSelected=true" method="post">
                                <div class=" card-body row">
                                    <div class="col-6 row">
                                        <p><b>Horario inicio:</b> <input class="form-control" type="datetime-local" name="horario_inicio" id="horario_inicio"></p>
                                    </div>
                                    <div class="col-6 row">
                                        <p><b>Horario previsto para fim:</b> <input class="form-control" type="datetime-local" name="horario_fim" id="horario_fim"></p>
                                    </div>
                                    <div class="col-6 row">
                                        <p><b>Precisa de veiculo?</b> <select class="form-control" name="precisa_veiculo" id="precisa_veiculo">
                                                <option value="false">Não</option>
                                                <option value="true">Sim</option>
                                            </select></p>
                                    </div>
                                    <div>
                                        <input type="hidden" value="<?= $ped->id_pedido ?>" name="id_pedido">
                                        <input type="submit" value="Continuar" class="p-2 btn btn-dark" data-bs-toggle="modal" data-bs-target="#addPedido">
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    <?php }
                } else { ?>
                    <div classe="d-flex align-items-end flex-column">
                        <button type="button" class="p-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#addPedido">
                            Adicionar Pedido
                        </button>
                    </div>
                    <div classe="d-flex align-items-end flex-column">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>
                                        <h5>Lista de pedidos</h5>
                                        <input class="form-control" id="gfg" type="text" placeholder="Procurar na lista">
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="listaFuncionarios" class="table-group-divider">
                                <?php foreach (recuperarPedido() as $index => $ped) {
                                    if ($ped->aceita == "0") {
                                        echo '<tr><td><div>
                                <div class="card text-bg-light col-12 mb-3">
                                    <div class="card-body">
                                        <div class="">
                                            <p><b>Nome:</b> ' . $ped->nome . '</p>
                                            <p><b>Endereco:</b> ' . $ped->endereco . '</p>
                                            <p class="col-8"><b>Descricao:</b>  ' . $ped->descricao . '</p>
                                            <p class="col-auto"><b>Telefone:</b> ' . $ped->telefone . '</p>
                                            <form action="/index.php?link=3&sceneLogin=6&formSelected=true" method="post">
                                                <input type="hidden" value="' . $ped->id_pedido . '" name="id_pedido">
                                               <div classe="d-flex align-items-end flex-column">
                                               <input type="submit" value="Aceitar Solicitação" class="p-2 btn btn-dark">
                                               <a class="p-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#ExcluirPedido' . $ped->id_pedido . '">Negar Solicitação</a>
                                           </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                               </div></td><tr>';
                                        echo '<div class="modal fade" id="ExcluirPedido' . $ped->id_pedido . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ExcluirPedidoLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <form action="/index.php?link=3&sceneLogin=100&acaoPEDIDO=negarPedido&reSceneLogin=6" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ExcluirPedidoLabel">Excluir Pedido</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <h1 class="mx-auto modal-title fs-5" id="ExcluirPedidoLabel">Tem certeza?</h1>
                                                    <p class="mx-auto fs-5">Isso é uma ação sem volta.</p>
                                                    <p class="mx-auto fs-5"><a href="https://wa.me/' . $ped->telefone . '">Clique aqui para entrar em contato via whatsapp.</a></p>
                                                    
                                                    <input class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $ped->id_pedido . '">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Continuar</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            </div>';
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>




    <div class="modal fade" id="addPedido" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPedidoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/index.php?link=3&sceneLogin=6&tratar=1" method="post">
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
                        <h6>Residos</h6>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <label class="form-label" for="FORM_descricao">Descriva os residuos</label>
                                <textarea name="FORM_descricao" id="FORM_descricao" type="text" class="form-control"></textarea>
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

            <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#gfg").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#listaFuncionarios tr").filter(function() {
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
                    }

                    div.scrollmenu {
                        opacity: 100%;
                    }
                }

                div.scrollmenu {
                    overflow: auto;
                    white-space: nowrap;
                }
            </style>
        <?php } ?>