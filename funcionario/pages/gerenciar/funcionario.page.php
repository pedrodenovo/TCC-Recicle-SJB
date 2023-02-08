<?php
if ($_SESSION["func"] == 'admin') {

    require_once './controller/funcionario.controller.php';
    require_once './controller/login.controller.php';
    require_once './controller/agenda_funcionario.controller.php';
    

    if (isset($_GET['acaoPage']) and $_GET['acaoPage'] == 'alterar') {
        alterarLogin($_POST['id_login'], $_POST['funcao'], $_POST['login'], $_POST['senha'], $_POST['id_funcionario']);
        alterarFuncionario($_POST['id_funcionario'], $_POST['nome'], $_POST['telefone'], $_POST['funcao'], $_POST['motorista']);
        echo '<script>window.location.href = "/index.php?link=3&sceneLogin=2";</script>';
    } elseif (isset($_GET['acaoPage']) and $_GET['acaoPage'] == 'inserir') {

        $id_f = inserirFuncionario($_POST['nome'], $_POST['telefone'], $_POST['funcao'], $_POST['motorista']);
        echo $id_f;
        inserirLogin($_POST['funcao'], $_POST['login'], $_POST['senha'], $id_f);
        echo '<script>window.location.href = "/index.php?link=3&sceneLogin=2";</script>';

    } elseif (isset($_GET['acaoPage']) and $_GET['acaoPage'] == 'deletar') {
        deletarLoginFuncionario($_POST['id_login']);
        deletarFuncionario($_POST['id_funcionario']);
        echo '<script>window.location.href = "/index.php?link=3&sceneLogin=2";</script>';
    } else {

        function ifFuncao($funcao, $valor, $return)
        {
            if ($funcao == $valor) {
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
        function addEditarFuncionario($id)
        {
            $login = "";
            $senha = "";
            $id_login = "";
            $nome = "";
            $telefone = "";
            $funcao = "";
            $motorista = "";
            foreach (recuperarExpecificoFuncionario($id) as $index => $func) {
                $nome = $func->nome;
                $telefone = $func->telefone;
                $funcao = $func->funcao;
                $motorista = $func->motorista;
            }
            foreach (recuperarLoginFuncionario($id) as $index => $Login) {
                $login = $Login->login;
                $senha = $Login->senha;
                $id_login = $Login->id_login;
            }
            echo '<div class="modal fade" id="editarFuncionario' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarFuncionarioLabel" aria-hidden="true"><div class="modal-dialog"><form action="/index.php?link=3&sceneLogin=2&acaoPage=alterar" method="post"><div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editarFuncionarioLabel">Editar Funcionario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input class="form-control" type="hidden" id="id_funcionario" name="id_funcionario" value="' . $id . '">
        <input class="form-control" type="hidden" id="id_login" name="id_login" value="' . $id_login . '">
        <label class="form-label" for="nome">Nome</label>
        <input class="form-control" type="text" id="nome" name="nome" value="' . $nome . '">
        <label class="form-label" for="telefone">telefone</label>
        <input class="form-control" type="text" id="telefone" name="telefone" value="' . $telefone . '">
        <label class="form-label" for="funcao">funcao</label>
        <select class="form-select" name="funcao" id="funcao">
        <option ' . ifFuncao($funcao, "agenteR", "selected") . ' value="agenteR">Agente Reciclador</option>
        <option ' . ifFuncao($funcao, "coordenador", "selected") . ' value="coordenador">Coordenador</option>
        <option ' . ifFuncao($funcao, "admin", "selected") . ' value="admin">Admin</option>
    </select>
    <label class="form-label" for="motorista">Pode dirigir? </label>
    <select class="form-select" name="motorista" id="motorista">
        <option ' . ifFuncao($motorista, "0", "selected") . ' value="0">Não</option>
        <option ' . ifFuncao($motorista, "1", "selected") . ' value="1">Sim</option>
    </select>
    <hr>
    
    <label class="form-label" for="login">Login</label>
    <input class="form-control" type="text" id="login" name="login" value="' . $login . '">
    <label class="form-label" for="senha">Senha</label>
    <input class="form-control" type="text" id="senha" name="senha" value="' . $senha . '">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </div>
    </div>
    </form>
</div>
</div>';
            echo '<div class="modal fade" id="viewFuncionario' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewFuncionarioLabel" aria-hidden="true">
<div class="modal-dialog">
<form method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewFuncionarioLabel">Funcionario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
        <input disabled class="form-control" type="hidden" id="id" name="id" value="' . $id . '">
        <label class="form-label" for="nome">Nome</label>
        <input disabled class="form-control" type="text" id="nome" name="nome" value="' . $nome . '">
        <label class="form-label" for="telefone">telefone</label>
        <input disabled class="form-control" type="text" id="telefone" name="telefone" value="' . $telefone . '">
        <label class="form-label" for="funcao">funcao</label>
        <select class="form-select" disabled name="funcao" id="funcao">
        <option ' . ifFuncao($funcao, "agenteR", "selected") . ' value="agenteR">Agente Reciclador</option>
        <option ' . ifFuncao($funcao, "coordenador", "selected") . ' value="coordenador">Coordenador</option>
        <option ' . ifFuncao($funcao, "admin", "selected") . ' value="admin">Admin</option>
    </select>
    <label class="form-label" for="motorista">Pode dirigir? </label>
    <select class="form-select" disabled name="motorista" id="motorista">
        <option ' . ifFuncao($motorista, "0", "selected") . ' value="0">Não</option>
        <option ' . ifFuncao($motorista, "1", "selected") . ' value="1">Sim</option>
    </select>
    <hr>
    
    <label class="form-label" for="login">Login</label>
    <input disabled class="form-control" type="text" id="login" name="login" value="' . $login . '">
    <label class="form-label" for="senha">Senha</label>
    <input disabled class="form-control" type="text" id="senha" name="senha" value="' . $senha . '">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>
    
    </form>
</div>
</div>';
            echo '<div class="modal fade" id="ExcluirFuncionario' . $id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ExcluirFuncionarioLabel" aria-hidden="true">
<div class="modal-dialog">
<form action="/index.php?link=3&sceneLogin=2&acaoPage=deletar" method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="ExcluirFuncionarioLabel">Excluir Funcionario</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        ';
        $pendencias = false;
        foreach (recuperarAgendamentoExpecificoFuncionario($id) as $index => $agendamento){
            $pendencias = true;
            }
        if ($pendencias){
            echo '<h1 class="mx-auto modal-title fs-5" id="ExcluirFuncionarioLabel">Não é possivel excluir esse funcionario</h1>
            <p class="mx-auto fs-5">Ainda a agendamentos relacionados a esse funcionario</p>
            Troque o funcionario responsavel ou exclua o agendamento antes de continuar
            <p class="mx-auto fs-5"><a href="/index.php?link=3&sceneLogin=5">Clique aqui</a> para gerenciar os agendamentos</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
        </form>
    </div>
    </div>';
        }else{
            echo '<h1 class="mx-auto modal-title fs-5" id="ExcluirFuncionarioLabel">Tem certeza?</h1>
            <p class="mx-auto fs-5">Isso é uma ação sem volta.</p>
            <input class="form-control" type="hidden" id="id_login" name="id_login" value="' . $id_login . '">
            <input class="form-control" type="hidden" id="id_funcionario" name="id_funcionario" value="' . $id . '">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Continuar</button>
            </div>
        </div>
        </form>
    </div>
    </div>';
        }
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
        <div class="modal fade" id="addFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addFuncionarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/index.php?link=3&sceneLogin=2&acaoPage=inserir" method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addFuncionarioLabel">Adicionar Funcionario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label" for="nome">Nome</label>
                            <input class="form-control" type="text" id="nome" name="nome" value="">
                            <label class="form-label" for="telefone">Telefone</label>
                            <input class="form-control" type="text" id="telefone" name="telefone" value="">
                            <label class="form-label" for="funcao">Função: </label>
                            <select class="form-select" name="funcao" id="funcao">
                                <option value="agenteR">Agente Reciclador</option>
                                <option value="coordenador">Coordenador</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label class="form-label" for="motorista">Pode dirigir? </label>
                            <select class="form-select" name="motorista" id="motorista">
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                            <hr>

                            <label class="form-label" for="login">Login</label>
                            <input class="form-control" type="text" id="login" name="login">
                            <label class="form-label" for="senha">Senha</label>
                            <input class="form-control" type="text" id="senha" name="senha">
                            <div>

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
                    <h2>Lista de funcionarios</h2>
                    <div classe="d-flex align-items-end flex-column">
                        <button class="p-2 btn btn-success noprint" onclick="window.print()">Imprimir
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                            </svg>
                        </button>
                        <button type="button" class="p-2 btn btn-success justify-content-end noprint" data-bs-toggle="modal" data-bs-target="#addFuncionario">
                            Adicionar Funcionario
                        </button>
                    </div>
                </div>
                <div class=" noprint">
                </div>
                <div class="scrollmenu">
                    <table class="table">
                        <thead>
                            <tr>
                                <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=2&orderTipo=<?=orderTipoGet()?>&orderValor=id_funcionario">id</a></td>
                                <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=2&orderTipo=<?=orderTipoGet()?>&orderValor=nome">Nome</a></td>
                                <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=2&orderTipo=<?=orderTipoGet()?>&orderValor=funcao">Função</a></td>
                                <td><a class="text-decoration-none" href="/index.php?link=3&sceneLogin=2&orderTipo=<?=orderTipoGet()?>&orderValor=telefone">Telefone</a></td>
                            </tr>
                            <br>
                    <tr>
                        <input class="form-control noprint" id="gfg" type="text" placeholder="Procurar na tabela">
                    </tr>
                        </thead>
                        <tbody id="listaFuncionarios" class="table-group-divider">
                            <?php foreach (recuperarFuncionario() as $index => $funcionario) {
                                addEditarFuncionario($funcionario->id_funcionario);
                                echo '<tr><td>' . $funcionario->id_funcionario . '</td><td>' . $funcionario->nome . '</td><td>' . funcao($funcionario->funcao) . '</td><td>' . $funcionario->telefone . '</td><td></td><markNoprint class="noprint"><td>
                <a data-bs-toggle="modal" data-bs-target="#editarFuncionario' . $funcionario->id_funcionario . '" class="noprint" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                  </svg></a></td>
                  <td>            
                  <a class="noprint" data-bs-toggle="modal" data-bs-target="#ExcluirFuncionario' . $funcionario->id_funcionario . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg></a></td
                ><td>            
                <a class="noprint" data-bs-toggle="modal" data-bs-target="#viewFuncionario' . $funcionario->id_funcionario . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
              </a></td></markNoprint>
              </tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


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
<?php }
} ?>