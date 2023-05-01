<?php

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};

include 'conexao.php';
include 'procedimento.php';
require 'mail/src/Exception.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Criador de QRCode para Avaliação NPS">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,QRCode,gerador,criador,imprimir">
  <meta name="robots" content="index, follow">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="stylo.css">
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
  <title>Gerador de QRCode NPS</title>
</head>

<body>
  <?php
  menu();
  ?>
  <form action="gerador.php" method="post">

    <?php
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $email = $_POST['email'];
    $qr_publico = codigo();
    ?>















<div class="displays">

<div class="display_QR">

    <h1>Token: <span style="color:#00ff00"><span style="background-color:#000000"><?php echo $qr_publico ?></span></span></h1>
    <?php

    if (isset($qr_publico)) {

      $qr_compartilhar = "https://www.atendometro.me/avaliar.php?empresa=".$qr_publico;
      $imagem_expositor = '<img src="' . (new QRCode)->render($qr_compartilhar) . '" alt="QR Code" width="350"/>';
    }
    if (isset($imagem_expositor)) {
    ?>
      <br>
      <p style="text-align:center"><strong>Instru&ccedil;&otilde;es de uso</strong></p>

<ol>
	<li><strong>Enviamos seu&nbsp;<span style="color:#00ff00"><span style="background-color:#000000">Token</span></span>&nbsp;para seu email.</strong></li>
	<li><strong>Imprima o display ao lado.</strong></li>
	<li><strong>Recorte na linha pontilhada.</strong></li>
	<li><strong>Exponha no seu caixa, balc&atilde;o </strong><strong>ou mesa de atendimento</strong>.</li>
</ol>

<p style="text-align:center"><strong>Exemplo</strong></p>

      <center><img src="img/exemplo.png" alt="Exemplo" height="250">
        <center>
        <?php
      }
        ?>
</div>
<?php
if (isset($imagem_expositor)) {
?>
  <div class="display_exemplo">
    <h1>O que achou do nosso atendimento?</h1>
    <center><?php if (isset($imagem_expositor)) {
              echo $imagem_expositor;
            } ?></center>
    <h1>Pesquisa Rápida</h1>
  </div>

<?php
}
?>
</div>


























    <?php

    $comando = $pdo->prepare("INSERT INTO tb_empresa(emp_nome,emp_descricao,emp_email,emp_qr_publico) VALUES (:a,:b,:c,:d)");
    $comando->bindValue(":a", $nome);
    $comando->bindValue(":b", $descricao);
    $comando->bindValue(":c", $email);
    $comando->bindValue(":d", $qr_publico);
    $comando->execute();

    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8';
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'newsmartwan@gmail.com';
      $mail->Password = 'ocebsyxiszgjrmxw';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;
      $mail->isHTML(true);

      $mail->setFrom('newsmartwan@gmail.com', 'SmartWan');
      $mail->addAddress($email, $nome);

      $mail->Subject = 'NPS - Nova Campanha';
      $mail->Body    = '<h1>Parab&eacute;ns, seu QR Code foi criado com <span style="color:#00FF00"><span style="background-color:#000000">SUCESSO</span></span>!</h1>

                <h2>Nome do NPS: ' . $nome . '</h2>
                
                <h2>Token: ' . $qr_publico . '</h2>
                
                <h2>Email: ' . $email . '</h2>
                
                <h2>&nbsp;</h2>
                
                <p>&nbsp;</p>';
      $mail->AltBody = 'Este é o corpo em texto puro para clientes de email não-HTML';
      $mail->send();
      //echo 'Mensagem foi enviada';
    } catch (Exception $e) {
      echo "Mensagem não pôde ser enviada. Erro do Mailer: {$mail->ErrorInfo}";
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>