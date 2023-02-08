<?php
if ($_SESSION["func"] == 'admin') {
require_once './controller/Veiculo.controller.php';
function ifFuncao($modelo, $valor, $return)
{
    if ($modelo == $valor) {
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
    }}
function addEditarVeiculo($id)
{
    $placa_veiculo = "";
    $estado_veiculo = "";
    $modelo = "";
    $tipo = "";
    foreach (recuperarExpecificoVeiculo($id) as $index => $consulta) {
        $placa_veiculo = $consulta->placa_veiculo;
        $estado_veiculo = $consulta->estado_veiculo;
        $modelo = $consulta->modelo;
        $tipo = $consulta->tipo;
    }
    echo '<div class="modal fade" id="editarVeiculo' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarVeiculoLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=101&acaoVEICULO=alterar&reSceneLogin=3" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editarVeiculoLabel">Editar Veiculo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input class="form-control" type="hidden" id="idVEICULO" name="idVEICULO" value="' . $id . '">
        <label class="form-label" for="placa_veiculo">Placa do veiculo</label>
        <input class="form-control" type="text" id="placa_veiculo" name="placa_veiculo" value="' . $placa_veiculo . '">
        <label class="form-label" for="modelo">Modelo</label>
        <input class="form-control" type="text" id="modelo" name="modelo" value="' . $modelo . '">
        <label class="form-label" for="tipo">Tipo</label>
        <input class="form-control" type="text" id="tipo" name="tipo" value="' . $tipo . '">
        <label class="form-label" for="estado_veiculo">Estado do veiculo</label>
        <select class="form-select" name="estado_veiculo" id="estado_veiculo">
        <option ' . ifFuncao($estado_veiculo, "0", "selected") . ' value="0">'.estado('0').'</option>
        <option ' . ifFuncao($estado_veiculo, "1", "selected") . ' value="1">'.estado('1').'</option>
        <option ' . ifFuncao($estado_veiculo, "2", "selected") . ' value="2">'.estado('2').'</option>
    </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
    </div>
    </form>
</div>
</div>';
    echo '<div class="modal fade" id="viewVeiculo' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewVeiculoLabel" aria-hidden="true">
<div class="modal-dialog">
<form method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewVeiculoLabel">Veiculo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input disabled class="form-control" type="hidden" id="id" name="id" value="' . $id . '">
        <label disabled class="form-label" for="placa_veiculo">Placa do veiculo</label>
        <input disabled class="form-control" type="text" id="placa_veiculo" name="placa_veiculo" value="' . $placa_veiculo . '">
        <label disabled class="form-label" for="modelo">Modelo</label>
        <input disabled class="form-control" type="text" id="modelo" name="modelo" value="' . $modelo . '">
        <label disabled class="form-label" for="tipo">Tipo</label>
        <input disabled  class="form-control" type="text" id="tipo" name="tipo" value="' . $tipo . '">
        <label class="form-label" for="estado_veiculo">Estado do veiculo</label>
        <select disabled class="form-select" name="estado_veiculo" id="estado_veiculo">
        <option ' . ifFuncao($estado_veiculo, "0", "selected") . ' value="0">'.estado('0').'</option>
        <option ' . ifFuncao($estado_veiculo, "1", "selected") . ' value="1">'.estado('1').'</option>
        <option ' . ifFuncao($estado_veiculo, "2", "selected") . ' value="2">'.estado('2').'</option>
    </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>
    
    </form>
</div>
</div>';
    echo '<div class="modal fade" id="ExcluirVeiculo' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ExcluirVeiculoLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=101&acaoVEICULO=deletar&reSceneLogin=3" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="ExcluirVeiculoLabel">Excluir Veiculo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <h1 class="mx-auto modal-title fs-5" id="ExcluirVeiculoLabel">Tem certeza?</h1>
        <p class="mx-auto fs-5">Isso é uma ação sem volta.</p>
        <input class="form-control" type="hidden" id="idVEICULO" name="idVEICULO" value="' . $id . '">
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
<div class="modal fade" id="addVeiculo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addVeiculoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/index.php?link=3&sceneLogin=101&acaoVEICULO=inserir&reSceneLogin=3" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addVeiculoLabel">Adicionar Veiculo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="estado_veiculo" id="estado_veiculo" value="0">
                    <label class="form-label" for="placa_veiculo">Placa do veiculo</label>
                    <input class="form-control" type="text" id="placa_veiculo" name="placa_veiculo">
                    <label class="form-label" for="modelo">Modelo</label>
                    <input class="form-control" type="text" id="modelo" name="modelo">
                    <label class="form-label" for="tipo">Tipo</label>
                    <input class="form-control" type="text" id="tipo" name="tipo">
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
            <h2>Lista de Veiculos</h2>
            <div classe="d-flex align-items-end flex-column">
                <button class="p-2 btn btn-success noprint" onclick="window.print()">Imprimir
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                    </svg>
                </button>
                <button type="button" class="p-2 btn btn-success justify-content-end noprint" data-bs-toggle="modal" data-bs-target="#addVeiculo">
                    Adicionar Veiculo
                </button>
            </div>
        </div>
        <div class=" noprint">
        </div>
        <div class="scrollmenu">
            <table class="table">
                <thead>
                    <tr>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=3&orderTipo=<?=orderTipoGet()?>&orderValor=id_veiculo">id</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=3&orderTipo=<?=orderTipoGet()?>&orderValor=placa_veiculo">Placa veiculo</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=3&orderTipo=<?=orderTipoGet()?>&orderValor=estado_veiculo">Estado veiculo</a></td>
                        <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=3&orderTipo=<?=orderTipoGet()?>&orderValor=tipo">Tipo</a></td>
                    </tr>
                    <br>
                    <tr>
                        <input class="form-control noprint" id="gfg" type="text" placeholder="Procurar na tabela">
                    </tr>
                </thead>
                <tbody id="listaVeiculos" class="table-group-divider">
                    <?php foreach (recuperarVeiculo() as $index => $veiculo) {
                        if ($veiculo->id_veiculo >= 0){                        echo '<tr><td>' . $veiculo->id_veiculo . '</td><td>' . $veiculo->placa_veiculo . '</td><td>' . estado($veiculo->estado_veiculo) . '</td><td>' . $veiculo->tipo . '</td><td></td><markNoprint class="noprint"><td>
                            <a data-bs-toggle="modal" data-bs-target="#editarVeiculo' . $veiculo->id_veiculo . '" class="noprint" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                              </svg></a></td>
                              <td>            
                              <a class="noprint" data-bs-toggle="modal" data-bs-target="#ExcluirVeiculo' . $veiculo->id_veiculo . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg></a></td
                            ><td>            
                            <a class="noprint" data-bs-toggle="modal" data-bs-target="#viewVeiculo' . $veiculo->id_veiculo . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>
                          </a></td></markNoprint>
                          </tr>';
                          addEditarVeiculo($veiculo->id_veiculo);}
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
            $("#listaVeiculos tr").filter(function() {
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