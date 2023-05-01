<?php
function codigo()
{
  $alphabet = "HECKOUT";
  $code = "";
  for ($i = 0; $i < 4; $i++) {
    $code .= $alphabet[rand(0, strlen($alphabet) - 1)];
  }
  return $code;
}

function avaliar()
{
?>
  <div class="resultado">
    <div class="estrelas">
      <input type="radio" id="vazio" name="estrela" value="" checked>
      <label for="estrela_um"><i class="fa"></i></label>
      <input type="radio" id="estrela_um" name="estrela" value="1">
      <label for="estrela_dois"><i class="fa"></i></label>
      <input type="radio" id="estrela_dois" name="estrela" value="2">
      <label for="estrela_tres"><i class="fa"></i></label>
      <input type="radio" id="estrela_tres" name="estrela" value="3">
      <label for="estrela_quatro"><i class="fa"></i></label>
      <input type="radio" id="estrela_quatro" name="estrela" value="4">
      <label for="estrela_cinco"><i class="fa"></i></label>
      <input type="radio" id="estrela_cinco" name="estrela" value="5">
    </div>



  </div>
<?php
}


function menu()
{
?>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="img/logo2.svg" alt="Logo" width="100px" height="40"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/whats.php">O que é NPS</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ferramentas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/painel.php">Indicadores</a></li>
              <li><a class="dropdown-item" href="/qr.php">Expositor</a></li>
              <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/faq.php">Como usar</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://wa.me/5511932061605" target="_blank">Suporte <img src="img/suporte.png" alt="Logo" height="20"></a>

          </li>
        </ul>
        <form action="avaliar.php" method="get" class="d-flex" role="search">
          <input class="form-control me-2" type="search" name="empresa" placeholder="Token" required minlength="4" maxlength="4" autocomplete="off" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Avaliar</button>
        </form>
      </div>
    </div>
  </nav>
<?php
}

function classifica($nps)
{

  if ($nps < 0) {
    return '<font color="#ff392f">Ruim</font> <img src="img/1.png" alt="ruim">';
  } elseif ($nps < 50) {
    return '<font color="#f79e1d">Razoavel</font> <img src="img/2.png" alt="razoavel">';
  } elseif ($nps < 75) {
    return '<font color="#c3df22">Muito Bom</font> <img src="img/promotor.png" alt="muito bom">';
  } else {
    return '<font color="#80d63e">Excelente</font> <img src="img/4.png" alt="excelente">';
  }
}

function nota($nota)
{

  if ($nota < 2) {
    return 'Péssimo 😭';
  } elseif ($nota < 3) {
    return 'Ruim 😞';
  } elseif ($nota < 4) {
    return 'Regular 😥';
  } elseif ($nota < 5) {
    return 'Muito Bom 🙂';
  } else {
    return 'Excelente 😀';
  }
}

?>