<?php
if ($_SESSION["func"] == 'admin' || $_SESSION["func"] == 'coordenador') {
    require_once './controller/agenda_funcionario.controller.php';
    require_once './controller/pedidos.controller.php';
    require_once './controller/funcionario.controller.php';
    require_once './controller/veiculo.controller.php';



    if (isset($_GET['excluir'])) {
        alterarSituacaoPedido($_POST['id_pedido'], 0);
        foreach (recuperarAgendamentoExpecificoPedido($_POST['id_pedido']) as $index => $agendamento) {
            deletarAgedamento($agendamento->id_agendamento);
            echo '  <script>window.location.href = "/index.php?link=3&sceneLogin=5";</script>';
        }
    } elseif (isset($_GET['alterarAgendamento'])) {
        alterarAgedamento($_POST['id_agendamento']);
        echo '  <script>window.location.href = "/index.php?link=3&sceneLogin=5";</script>';
    } elseif (isset($_GET['formSelected'])) {
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
        foreach (recuperarPedidoExpecifico($_POST['id_pedido']) as $index => $ped) {
            if (isset($_GET['timeSelected']) == true) {
                if (dataParaInteiro($_POST['horario_inicio'], true) < 1 || dataParaInteiro($_POST['horario_fim'], true) < 1) {
                    echo '  <script>
                            alert("Selecione um horario valido, por favor escolha outra hora.");
                            window.location.href = "/index.php?link=3&sceneLogin=5";
                            </script>';
                }; ?>
                <div class="container mx-auto row row-md mb-3">
                    <br>
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
                    <form action="/index.php?link=3&sceneLogin=5&formSelected=true&timeSelected=true&alterarAgendamento=true" method="post">
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

                                                    if ($funcPASS == true and dataParaInteiro($agendamento->horario_fim, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_fim, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                        $funcPASS = false;
                                                    }
                                                    if ($funcPASS == true and dataParaInteiro($agendamento->horario_inicio, false) >= dataParaInteiro($_POST['horario_inicio'], true) and dataParaInteiro($agendamento->horario_inicio, false) <= dataParaInteiro($_POST['horario_fim'], true)) {
                                                        $funcPASS = false;
                                                    }
                                                    if ($agendamento->id_agendamento = $_POST['id_agendamento']) {
                                                        $funcPASS = true;
                                                    }
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
                                        window.location.href = "/index.php?link=3&sceneLogin=5";
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
                                                      window.location.href = "/index.php?link=3&sceneLogin=5";
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
                                <input type="hidden" id="id_agendamento" name="id_agendamento" value="<?= $_POST['id_agendamento'] ?>">
                                <input type="hidden" value="<?= $ped->id_pedido ?>" name="id_pedido">
                                <input type="submit" value="Criar agendamento" class="p-2 btn btn-dark">
                            </div>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
                <div class="container mx-auto row row-md mb-3">
                    <br>
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
                    <form action="/index.php?link=3&sceneLogin=5&formSelected=true&timeSelected=true" method="post">
                        <input class="form-control" type="hidden" id="id_pedido" name="id_pedido" value="<?= $_POST['id_pedido'] ?>">
                        <input class="form-control" type="hidden" id="id_agendamento" name="id_agendamento" value="<?= $_POST['id_agendamento'] ?>">

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
                </div>
            <?php } ?>
        <?php }
    } else {
        function ifFuncao($modelo, $valor, $return)
        {
            if ($modelo == $valor) {
                return $return;
            }
        }
        function addEditarAgendamento($id)
        {
            echo '<div class="modal fade" id="ExcluirAgendamento' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ExcluirAgendamentoLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=5&excluir=true" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="ExcluirAgendamentoLabel">Excluir Agendamento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <h1 class="mx-auto modal-title fs-5" id="ExcluirAgendamentoLabel">Tem certeza?</h1>
        <p class="mx-auto fs-5">Isso é uma ação sem volta.</p>
        <input class="form-control" type="hidden" id="id_pedido" name="id_pedido" value="' . $id . '">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
    </div>
    </form>
</div>
</div>';
        }


        function estado($valor)
        {
            if ($valor == '0') {
                return 'Funcionando';
            } else if ($valor == '1') {
                return 'Impossibilitado';
            } else if ($valor == '2') {
                return 'Em manutenção';
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
        <div class="container-fluid">
            <div class="container mx-auto row row-md">
                <div class="mx-auto">
                    <h2>Lista de Agendamentos</h2>
                    <div classe="d-flex align-items-end flex-column">
                        <button class="p-2 btn btn-success noprint" onclick="window.print()">Imprimir
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class=" noprint">
                </div>
                <div class="scrollmenu">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Pedido e agendamento</td>
                            </tr>
                            <br>
                            <tr>
                                <input class="form-control noprint" id="gfg" type="text" placeholder="Procurar na tabela">
                            </tr>
                        </thead>
                        <tbody id="listaAgendamentos" class="table-group-divider">
                            <?php foreach (recuperarPedido() as $index => $pedido) {
                                foreach (recuperarAgendamentoExpecificoPedido($pedido->id_pedido) as $index => $agendamento) {
                                    foreach (recuperarExpecificoFuncionario($agendamento->id_funcionario) as $index => $funcionario) {
                                        foreach (recuperarExpecificoVeiculo($agendamento->id_veiculo) as $index => $veiculo) {
                                            if ($pedido->aceita == "1") {
                                                echo '<tr><td><div>
                                <div class="card text-bg-light col-12 mb-3">
                                    <div class="card-body">
                                        <div class="">
                                            <p><b>Nome:</b>' . $pedido->nome . '</p>
                                            <p><b>Endereco:</b>' . $pedido->endereco . '</p>
                                            <p><a target="_blank" href="https://www.google.com/maps/place/' . $pedido->enderecoURL . '"><b>Ver endereço no google maps</b></a></p>
                                            <p class="col-8"><b>Descricao:</b> ' . $pedido->descricao . '</p>
                                            <p class="col-auto"><b>Telefone:</b>' . $pedido->telefone . '</p>
                                            <p class="col-8"><b>Materiais:</b> ' . $pedido->material . '</p>
                                            <p class="col-8"><b>Funcionario associado: </b>' . $funcionario->id_funcionario . ' - ' . $funcionario->nome . '</p>
                                            <p class="col-8"><b>Veiculo associado:</b> ' . $veiculo->placa_veiculo . ' - ' . $veiculo->modelo . '</p>
                                            <p class="col-8"><b>Horario do agenamento:</b>  <input class="" type="datetime-local"  disabled name="horario_inicio" id="horario_inicio" value="' . $agendamento->horario_inicio . '"></p>
                                            <p class="col-auto"><b>Horario estimadao para fim do pedido:</b> <input class="" type="datetime-local" disabled name="horario_fim" id="horario_fim" value="' . $agendamento->horario_fim . '"></p>
                                        </div>
                                    </div>
                                </div>
                               </div>
                               </td>
                               <td>    
                               <form action="/index.php?link=3&sceneLogin=5&formSelected=true" method="post">
                               <input class="form-control" type="hidden" id="id_pedido" name="id_pedido" value="' .  $pedido->id_pedido . '">
                               <input class="form-control" type="hidden" id="id_agendamento" name="id_agendamento" value="' .  $agendamento->id_agendamento . '">

                               <button type="submit" data-bs-toggle="modal" class="btn noprint" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                   <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                 </svg></button></form></td>
                                 <td>            
                                 <a class="btn noprint" data-bs-toggle="modal" data-bs-target="#ExcluirAgendamento' . $pedido->id_pedido . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                 <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                               </svg></a></td
                               >
                               <tr>';
                                                addEditarAgendamento($pedido->id_pedido);
                                            }
                                        }
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>

        <script>
            $(document).ready(function() {
                $("#gfg").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#listaAgendamentos tr").filter(function() {
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
<?php }
} ?>