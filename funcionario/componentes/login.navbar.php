<nav class="navbar navbar-dark bg-dark noprint">
  <div class="container-fluid">
    <button class="btn border" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<?php
if ($_SESSION["func"] == 'admin') {
?>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLeftLabel"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body col-auto">
      <a class="btn-dark btn col-12 mb-3" href="/index.php?link=3&sceneLogin=1">
        <div class="d-flex justify-content-end">
          <h6>Painel</h6>
        </div>
      </a>

      <div class="col-12 mb-3  dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Pedidos e coleta</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=6">
              <div class="d-flex justify-content-start">
                Novos pedidos
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=7">
              <div class="d-flex justify-content-start">
                Pedidos pendentes
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=4">
              <div class="d-flex justify-content-start">
                Gerenciar pedidos
              </div>
            </a></li>
        </ul>
      </div>
      <div class="col-12 mb-3  dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Agendamentos</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=5">
              <div class="d-flex justify-content-start">
                Gerenciar agendamentos
              </div>
            </a></li>
        </ul>
      </div>

      <div class="col-12 mb-3 dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Gerenciar</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=4">
              <div class="d-flex justify-content-start">
                Gerenciar pedidos
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=5">
              <div class="d-flex justify-content-start">
                Gerenciar agendamentos
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=2">
              <div class="d-flex justify-content-start">
                Gerenciar funcionarios
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=3">
              <div class="d-flex justify-content-start">
                Gerenciar veiculos
              </div>
            </a></li>
        </ul>
      </div>

      <a class="btn-danger btn position-absolute bottom-0 start-50 translate-middle-x col-11" href="/index.php?link=1">
        <div class="d-flex justify-content-end">
          <h6>Sair</h6>
        </div>
      </a>
    </div>
  </div>
<?php }
?>
<?php
if ($_SESSION["func"] == 'coordenador') {
?>
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLeftLabel"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body col-auto">
      <a class="btn-dark btn col-12 mb-3" href="/index.php?link=3&sceneLogin=1">
        <div class="d-flex justify-content-end">
          <h6>Painel</h6>
        </div>
      </a>

      <div class="col-12 mb-3  dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Pedidos e coleta</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=6">
              <div class="d-flex justify-content-start">
                Novos pedidos
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=7">
              <div class="d-flex justify-content-start">
                Pedidos pendentes
              </div>
            </a></li>
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=4">
              <div class="d-flex justify-content-start">
                Gerenciar pedidos
              </div>
            </a></li>
        </ul>
      </div>

      <div class="col-12 mb-3  dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Agendamentos</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/index.php?link=3&sceneLogin=5">
              <div class="d-flex justify-content-start">
                Gerenciar agendamentos
              </div>
            </a></li>
        </ul>
      </div>

      <a class="btn-danger btn position-absolute bottom-0 start-50 translate-middle-x col-11" href="/index.php?link=1">
        <div class="d-flex justify-content-end">
          <h6>Sair</h6>
        </div>
      </a>
    </div>
  </div>
<?php } ?>
<?php
if ($_SESSION["func"] == 'agenteR') {
?>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasLeftLabel"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body col-auto">
      <a class="btn-dark btn col-12 mb-3" href="/index.php?link=3&sceneLogin=1">
        <div class="d-flex justify-content-end">
          Painel
        </div>
      </a>
      <div class="col-12 mb-3  dropdown-center">
        <button type="button" class="btn-dark col-12 btn" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="d-flex justify-content-end">
            <h6 class="">Pedidos e coleta</h6>
          </div>
        </button>
        <ul class="dropdown-menu">
          <a class="dropdown-item" href="/index.php?link=3&sceneLogin=7">
              <div class="d-flex justify-content-start">
                Pedidos pendentes
              </div>
            </a></li>
        </ul>
      </div>
      <a class="btn-danger btn position-absolute bottom-0 start-50 translate-middle-x col-11" href="/index.php?link=1">
        <div class="d-flex justify-content-end">
          Sair
        </div>
      </a>
    </div>
  </div>
<?php }
?>