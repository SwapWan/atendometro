<?php
include 'conexao.php';
include 'procedimento.php';
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
  
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Avalie empresas de forma rapído e fácil">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,avaliar,votar,ranking">
  <meta name="robots" content="index, follow">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
  <link rel="stylesheet" href="stylo.css">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
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
  <title>Queremos saber sua opinião</title>
</head>

<body>
  <?php
  menu();
  ?>
  <form action="feedback.php" method="post">
    <?php
    $qr_publico = $_GET['empresa'];
    $comando = $pdo->prepare("SELECT * FROM tb_empresa where emp_qr_publico = :a");
    $comando->bindValue(":a", $qr_publico);
    $comando->execute();

    $resultado = $comando->fetch(PDO::FETCH_ASSOC);
    if(!empty($resultado)){
    $_SESSION['emp_id'] = $resultado['emp_id'];
    $_SESSION['emp_nome'] = $resultado['emp_nome'];
    $_SESSION['emp_descricao'] = $resultado['emp_descricao'];
    $_SESSION['emp_email'] = $resultado['emp_email'];
    ?>
    <div class="form_avaliar">
      <h1><?php echo $_SESSION['emp_nome'] ?></h1>
      <h1><b>O que você achou do nosso atendimento?</h1>

      <?php
      avaliar();
      ?>
      <textarea id="feedback" name="feedback" placeholder="Adicione um comentário para <?php echo $_SESSION['emp_nome'] ?>..." cols="50" rows="3"></textarea><br>
      <input type="submit" value="Enviar">
    </div>
    <?php
    }else {
        echo "<h4><center><a href='https://www.atendometro.me/'><br>Criar um Token</a></center></h4>";
      }
    ?>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>