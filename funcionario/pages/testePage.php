<?php
function dataParaInteiro($data,$convBC)
{
    if ($convBC == true){
        $forRemove = array("-", ':', 't', 'T', ' ');
        $valorRetorno = intval(str_replace($forRemove, "", $data).'00');
        return $valorRetorno;
    }else{
        $forRemove = array("-", ':', 't', 'T', ' ');
        $valorRetorno = intval(str_replace($forRemove, "", $data));
        return $valorRetorno;
    }

}
?>
<div class='container'>
    <h5>Pedido de coleta</h5>
    <a href="index.php?link=3&sceneLogin=99&metodo=recuperarExpecifico">Click to update</a>
    <hr>
    <?php
    echo '<h5>todos os valores do pedido coleta</h5>';
    if (isset($_GET['metodo'])) {
        $metodo = $_GET['metodo'];
        $acaoPEDIDO = 'recuperar';
        //$idPEDIDO = $_GET['idPEDIDO'];
        require_once 'controller/pedidos.controller.php';
        foreach ($pedido as $index => $pedido) {
            $id = $pedido->id_pedido;
            $nome = $pedido->nome;
            $endereco = $pedido->endereco;
            $descricao = $pedido->descricao;
            echo '<br>id: ' . $id . '<br>nome: ' . $nome . '<br>endereco: ' . $endereco . '<br>descricao: ' . $descricao;
        }
    }
    echo '<hr>';

    echo '<h5>valor expecifico do pedido coleta</h5>';
    if (isset($_GET['metodo'])) {
        $metodo = $_GET['metodo'];
        $acaoPEDIDO = 'recuperarExpecifico';
        $idPEDIDO = 1;
        require_once 'controller/pedidos.controller.php';
        $id = $pedido->id_pedido;
        $nome = $pedido->nome;
        $endereco = $pedido->endereco;
        $descricao = $pedido->descricao;
        echo '<br>id: ' . $id . '<br>nome: ' . $nome . '<br>endereco: ' . $endereco . '<br>descricao: ' . $descricao;
    }
    echo '<hr>';
    ?>
    <h5>Formulario que altera valor expecifico do pedido coleta</h5>
    <form action="index.php?link=3&sceneLogin=103&acaoPEDIDO=alterar&idPEDIDO=<?= $idPEDIDO ?>" method="post">
        <input type="text" name="nome" id="nome" value="<?= $pedido->nome ?>">
        <input type="text" name="descricao" id="descricao" value="<?= $pedido->descricao ?>">
        <input type="hidden" name="endereco" id="endereco" value="<?= $pedido->endereco ?>">
        <input type="hidden" name="material" id="material" value="<?= $pedido->material ?>">
        <input type="hidden" name="telefone" id="telefone" value="<?= $pedido->telefone ?>">
        <input type="hidden" name="data_hora" id="data_hora" value="<?= $pedido->data_hora ?>">
        <input type="hidden" name="aceita" id="aceita" value="<?= $pedido->aceita ?>">
        <input type="hidden" name="enderecoURL" id="enderecoURL" value="<?= $pedido->enderecoURL ?>">
        <input type='hidden' name='URLBack' id='URLBack'
            value='index.php?link=3&sceneLogin=99&metodo=recuperarExpecifico'>
        <input type="submit" value="Enviar">
    </form>



    <?php
    echo '<hr>';
    echo '<h5>Fazer um agendamento para de pedido coleta</h5>';
    if (isset($_GET['metodo'])) {
        $metodo = $_GET['metodo'];
        $acaoFUNCIONARIO = 'recuperar';
        require_once 'controller/funcionario.controller.php';
        require_once 'controller/agenda_funcionario.controller.php';
    }
    if (isset($_GET['datefinido']) == "truef") {
        ?>
        <form action="index.php?link=3&sceneLogin=103&acaoAGENDA=inserir" method="POST">
            <input type="hidden" name="id_pedido" id="id_pedido" value='1'>
            <input type="hidden" name="veiculo" id="veiculo" value='0'>
            <p>horario_inicio</p>
            <input type="datetime-local" name="horario_inicio" id="horario_inicio" value="<?= $_POST['horario_inicio'] ?>">
            <p>horario_fim</p>
            <input type="datetime-local" name="horario_fim" id="horario_fim" value="<?= $_POST['horario_fim'] ?>">
            <br>
            <p>funcionario</p>
            <select name="id_funcionario" id="id_funcionario">
                <?php foreach ($funcionario as $index => $funcionario) {
                    $funcPASS = true;
                    foreach (recuperarFuncionarioExpecifico($funcionario->id_funcionario) as $index => $agendamento) {

                        if ($funcPASS == true and dataParaInteiro($agendamento->horario_fim,false) >= dataParaInteiro($_POST['horario_inicio'],true) and dataParaInteiro($agendamento->horario_fim,false) <= dataParaInteiro($_POST['horario_fim'],true)) {
                            $funcPASS = false;
                        }
                        if ($funcPASS == true and dataParaInteiro($agendamento->horario_inicio,false) >= dataParaInteiro($_POST['horario_inicio'],true) and dataParaInteiro($agendamento->horario_inicio,false) <= dataParaInteiro($_POST['horario_fim'],true)) {
                            $funcPASS = false;
                        }
                    }

                    if ($funcPASS) {
                        echo '<option value="' . $funcionario->id_funcionario . '">' . $funcionario->id_funcionario . ' - ' . $funcionario->nome . '</option>';
                    }
                } ?>
            </select>
            <br>
            <?php
            echo $_POST['horario_inicio'] . '<br>';
            echo $_POST['horario_fim'] . '<br>'; ?>
            <input type="submit" value="Enviar">
        </form>
        <br>
    <?php } else { ?>
        <form action="index.php?link=3&sceneLogin=99&metodo=recuperar&datefinido=truef" method="POST">
            <input type="hidden" name="id_pedido" id="id_pedido" value='1'>
            <input type="hidden" name="veiculo" id="veiculo" value='0'>
            <p>horario_inicio</p>
            <input type="datetime-local" name="horario_inicio" id="horario_inicio">
            <p>horario_fim</p>
            <input type="datetime-local" name="horario_fim" id="horario_fim">
            <br>
            <input type="submit" value="Enviar">
        </form>
        <?php
    } ?>
</div>