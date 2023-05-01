<?php
include 'conexao.php';
include 'procedimento.php';
?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="Indicadores NPS para Empresas">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,indicador,Net Promoter Score,promotores,detratores,atendometro,encantometro,pesquisa,ranking,gratis,qualidade,alerta">
  <meta name="robots" content="index, follow">

  <link rel="stylesheet" type="text/css" href="stylo.css">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-J0JGNYF2SG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-J0JGNYF2SG');
  </script>
  <title>Indicadores NPS</title>
</head>

<body>
  <?php
  menu();
  ?>
  <div class="painel">
    <form action="" method="post">
      <input type="text" id="token" name="token" autocomplete="off" required minlength="4" maxlength="4" autofocus placeholder="Digite seu Token">
      <input type="submit" value="Pesquisar">
      <?php

      if (isset($_POST['token'])) {
        $token = $_POST['token'];
        $comando = $pdo->prepare("SELECT * FROM tb_empresa where emp_qr_publico = :a");
        $comando->bindValue(":a", $token);
        $comando->execute();
        $dados_clientes = $comando->fetch(PDO::FETCH_ASSOC);

        if (!empty($dados_clientes)) {
      ?>
          <h1><?php echo $dados_clientes['emp_nome'] ?></h1>
          <h1><?php echo 'NPS ' . $dados_clientes['emp_nps'] . ' ' . classifica($dados_clientes['emp_nps']) ?></h1>
          <h2><?php echo $dados_clientes['emp_descricao'] . ' ' ?><span class="material-symbols-outlined">my_location</span></h1>
            <h2><?php echo $dados_clientes['emp_detratores'] . ' ' ?><img src="img/detrator.png" alt="detrator"></h2>
            <h2><?php echo $dados_clientes['emp_neutros'] . ' ' ?><img src="img/neutro.png" alt="neutro"></h2>
            <h2><?php echo $dados_clientes['emp_promotores'] . ' ' ?><img src="img/promotor.png" alt="promotor"></h2>
            <h2><?php echo $dados_clientes['emp_quantidade'] . ' avaliações ' ?><span class="material-symbols-outlined">bubble_chart</span></h2>
            <h2><a href="https://www.atendometro.me/qr.php?token=<?php echo $dados_clientes['emp_qr_publico'] ?>"><?php echo $dados_clientes['emp_qr_publico'] . ' ' ?><span class="material-symbols-outlined">qr_code_scanner</span></a></h2>
        <?php
        } else {
          echo "<h4><center><a href='https://www.atendometro.me/'><br>Criar um Token</a></center></h4>";
        }
      }
        ?>
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>