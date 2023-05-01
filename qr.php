<?php

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};

include 'procedimento.php';
include 'conexao.php';
require 'vendor/autoload.php';
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Crie seu QRCode agora mesmo! Display e Expositores para NPS">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,QRCode,Expositor,Display,Avaliar,Ranking">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://www.atendometro.me/qr.php">
  <link rel="stylesheet" type="text/css" href="stylo.css">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
  <title>NPS - Display e Expositor</title>
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
</head>

<body>
  <?php
  menu();
  ?>
  <div class="displays">

    <div class="display_QR">
      <form action="" method="GET">
        <input type="text" id="token" name="token" autocomplete="off" required minlength="4" maxlength="4" autofocus placeholder="Digite seu Token">
        <input type="submit" value="Pesquisar">
        <?php

        if (isset($_GET['token'])) {

          $qr_compartilhar = "https://www.atendometro.me/avaliar.php?empresa=" . $_GET['token'];
          $imagem_expositor = '<img src="' . (new QRCode)->render($qr_compartilhar) . '" alt="QR Code" width="350"/>';
        }
        if (isset($imagem_expositor)) {
        ?>
          <p style="text-align:center"><strong>Instru&ccedil;&otilde;es de uso</strong></p>

          <ol>
            <li><strong>Imprima o display ao lado.</strong></li>
            <li><strong>Recorte na linha pontilhada.</strong></li>
            <li><strong>Exponha no seu caixa, balc&atilde;o </strong><strong>ou mesa de atendimento</strong></li>
          </ol>

          <p style="text-align:center"><strong>Exemplo</strong></p>
          <center><img src="img/exemplo.png" alt="Exemplo" height="250">
            <center>
            <?php
          }
            ?>
      </form>
    </div>
    <?php
    if (isset($imagem_expositor)) {
    ?>
      <div class="display_exemplo">
        <h1><br>O que achou do nosso atendimento?</h1>
        <center><?php if (isset($imagem_expositor)) {
                  echo $imagem_expositor;
                } ?></center>
        <h1>Pesquisa Rápida</h1>
      </div>

    <?php
    }
    ?>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>