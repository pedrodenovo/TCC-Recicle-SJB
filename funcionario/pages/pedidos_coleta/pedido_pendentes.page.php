<?php
require_once './controller/pedidos.controller.php';
require_once './controller/funcionario.controller.php';
require_once './controller/agenda_funcionario.controller.php';
require_once './controller/veiculo.controller.php';

if (isset($_GET['finalizar'])) {
    alterarSituacaoPedido($_POST['idPEDIDO'],3);
    foreach (recuperarAgendamentoExpecificoPedido($_POST['idPEDIDO']) as $index => $agendamento) {
        deletarAgedamento($agendamento->id_agendamento);
    }
    echo '<script>window.location.href = "/index.php?link=3&sceneLogin=7";</script>';
}

if ($_SESSION["func"] == 'admin' || $_SESSION["func"] == 'coordenador') {
?>

    <div class="container-fluid">
        <div class="container mx-auto row row-md">
            <div class="mx-auto">
                <div classe="d-flex align-items-end flex-column">
                    <table class="table">
                        <thead>
                            <tr>
                                <h5>Lista de pedidos pendentes</h5>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" id="gfg" type="text" placeholder="Procurar na lista">
                                </td>
                            </tr>
                            <br>
                        </thead>
                        <tbody id="listaFuncionarios" class="table-group-divider">
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
                                            <form action="/index.php?link=3&sceneLogin=7&formSelected=true" method="post">
                                                <input type="hidden" value="' . $pedido->id_pedido . '" name="id_pedido">
                                               <div classe="d-flex align-items-end flex-column">
                                               
                                               <a class="p-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#FinalizarPedido' . $pedido->id_pedido . '">Finalizar pedido</a>
                                           </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                               </div>
                               </td>
                               <tr>';
                                                echo '<div class="modal fade" id="FinalizarPedido' . $pedido->id_pedido . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FinalizarPedidoLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <form action="/index.php?link=3&sceneLogin=7&finalizar=true" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="FinalizarPedidoLabel">Finalizar pedido</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <h1 class="mx-auto modal-title fs-5" id="FinalizarPedidoLabel">Tem certeza?</h1>
                                                    <p class="mx-auto fs-5">Finalize o pedido apenas se ele foi realmente realizado.</p>
                                                    
                                                    <input class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $pedido->id_pedido . '">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Finalizar</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            </div>';
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
    </div>

<?php } elseif ($_SESSION["func"] == 'agenteR') {
?>

    <div class="container-fluid">
        <div class="container mx-auto row row-md">
            <div class="mx-auto">
                <div classe="d-flex align-items-end flex-column">
                    <table class="table">
                        <thead>
                            <tr>
                                <h5>Lista de pedidos pendentes</h5>
                            </tr>
                            <tr>
                                <td>
                                    <input class="form-control" id="gfg" type="text" placeholder="Procurar na lista">
                                </td>
                            </tr>
                            <br>
                        </thead>
                        <tbody id="listaFuncionarios" class="table-group-divider">
                            <?php foreach (recuperarAgendamentoExpecificoFuncionario($_SESSION["id_funcionario"]) as $index => $agendamento) {
                                foreach (recuperarPedidoExpecifico($agendamento->id_pedido) as $index => $pedido) {
                                    foreach (recuperarExpecificoFuncionario($_SESSION["id_funcionario"]) as $index => $funcionario) {
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
                                            <p class="col-8"><b>Veiculo associado:</b> ' . $veiculo->placa_veiculo . ' - ' . $veiculo->modelo . '</p>
                                            <p class="col-8"><b>Horario do agenamento:</b>  <input class="" type="datetime-local"  disabled name="horario_inicio" id="horario_inicio" value="' . $agendamento->horario_inicio . '"></p>
                                            <p class="col-auto"><b>Horario estimadao para fim do pedido:</b> <input class="" type="datetime-local" disabled name="horario_fim" id="horario_fim" value="' . $agendamento->horario_fim . '"></p>
                                            <form action="/index.php?link=3&sceneLogin=7&formSelected=true" method="post">
                                                <input type="hidden" value="' . $pedido->id_pedido . '" name="id_pedido">
                                               <div classe="d-flex align-items-end flex-column">
                                               
                                               <a class="p-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#FinalizarPedido' . $pedido->id_pedido . '">Finalizar pedido</a>
                                           </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                               </div>
                               </td>
                               <tr>';
                                                echo '<div class="modal fade" id="FinalizarPedido' . $pedido->id_pedido . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="FinalizarPedidoLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <form action="/index.php?link=3&sceneLogin=7&finalizar=true" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="FinalizarPedidoLabel">Finalizar pedido</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                    </div>
                                                    <h1 class="mx-auto modal-title fs-5" id="FinalizarPedidoLabel">Tem certeza?</h1>
                                                    <p class="mx-auto fs-5">Finalize o pedido apenas se ele foi realmente realizado.</p>
                                                    
                                                    <input class="form-control" type="hidden" id="idPEDIDO" name="idPEDIDO" value="' . $pedido->id_pedido . '">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Finalizar</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            </div>';
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
    </div>

<?php } ?>

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