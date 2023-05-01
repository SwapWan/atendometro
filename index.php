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
  <meta name="description" content="Sistema NPS Gratis - Crie QRCode para seus clientes avaliarem sua loja. Receba alertas em tempo real com comentários!">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,Net Promoter Score,promotores,detratores,atendometro,QRCode,encantometro,pesquisa,ranking,gratis,qualidade,alerta">
  <meta name="robots" content="index, follow">
  <link rel="stylesheet" type="text/css" href="stylo.css">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Google tag (gtag.js) -->
  <link rel="canonical" href="https://www.atendometro.me/">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-J0JGNYF2SG"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2380014168430991"
     crossorigin="anonymous"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-J0JGNYF2SG');
  </script>
  <title>NPS - Net Promoters Score</title>
</head>

<body>
  <?php
  menu();
  ?>
  <div class="dashboard">
    <div class="lado_a">
      <div class="mensagem">
        <h3>Receba em Tempo Real avaliações dos seus clientes sobre o seu negócio!</h3>
        <center><img src="img/banner.svg" alt="escala nps" height="150" width="500"></center>
      </div>
      <br>
      <form action="gerador.php" method="post">
        <h1>Crie seu NPS Token</h1>
        <input type="text" id="nome" name="nome" placeholder="Título ou Marca" autocomplete="off" required minlength="3" autofocus><br>
        <textarea id="descricao" name="descricao" placeholder="Endereço ou Filial" autocomplete="off" required minlength="3"></textarea><br>
        <input type="text" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" placeholder="Email de Alerta" autocomplete="off"><br>

        <input type="submit" value="Gerar QR Code">
        <div class="breve">
        <center><img src="img/banner.svg" alt="Banner" height="100" width="300"></center>
        <center><a class="nav-link" href="https://wa.me/5511932061605" target="_blank">© SmartWan 2023<a></center>


        </div>

      </form>
    </div>
    <div class="lado_b">
    <iframe width="700" height="394" src="https://www.youtube.com/embed/_MUC_89Owu0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>