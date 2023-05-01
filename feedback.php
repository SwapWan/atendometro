<?php
include 'conexao.php';
include 'procedimento.php';
session_start();

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

  <meta name="description" content="Obrigado por avaliar usando NPS">
  <meta name="author" content="Wan Matos, NPS">
  <meta name="keywords" content="NPS,smartwan,avaliar">
  <meta name="robots" content="index, follow">
  <link rel="icon" type="image/x-icon" href="/img/ico.ico">
  <link rel="stylesheet" href="stylo.css">
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
  <title>Obrigado por Avaliar!</title>
</head>

<body>
  <?php
  menu();
  ?>
  <form action="" method="post">
    <?php
    $_SESSION['feedback'] = $_POST['feedback'];
    $_SESSION['estrela'] = $_POST['estrela'];
    ?>
    <div class="form_avaliar">
      <h1><?php echo $_SESSION['emp_nome'] . ',' ?></h1>
      <h1>agradecemos sua avaliação!</h1>
      <center><a href="https://www.smartwan.live/"><img src="img/logo.svg" alt="SmartWan NPS" width="300px"></a></center>
    </div>
    <?php
    if ($_SESSION['estrela'] < 4) {
      $comando = $pdo->prepare("UPDATE tb_empresa set emp_detratores=emp_detratores+1,emp_quantidade=emp_quantidade+1 where emp_id = :i;");
      $comando->bindValue(":i", $_SESSION['emp_id']);
      $comando->execute();
    } else if ($_SESSION['estrela'] < 5) {
      $comando = $pdo->prepare("UPDATE tb_empresa set emp_neutros=emp_neutros+1,emp_quantidade=emp_quantidade+1 where emp_id = :i;");
      $comando->bindValue(":i", $_SESSION['emp_id']);
      $comando->execute();
    } else {
      $comando = $pdo->prepare("UPDATE tb_empresa set emp_promotores=emp_promotores+1,emp_quantidade=emp_quantidade+1 where emp_id = :i;");
      $comando->bindValue(":i", $_SESSION['emp_id']);
      $comando->execute();
    }

    $comando = $pdo->prepare("UPDATE tb_empresa set emp_nps=(((emp_promotores-emp_detratores)/emp_quantidade)*100) where emp_id = :i;");
    $comando->bindValue(":i", $_SESSION['emp_id']);
    $comando->execute();


    $comando = $pdo->prepare("INSERT INTO tb_score(sco_id_empresa,sco_empresa,sco_nota,sco_feedback) VALUES (:i,:c,:n,:f)");
    $comando->bindValue(":i", $_SESSION['emp_id']);
    $comando->bindValue(":c", $_SESSION['emp_nome']);
    $comando->bindValue(":n", $_SESSION['estrela']);
    $comando->bindValue(":f", $_SESSION['feedback']);


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
      $mail->addAddress($_SESSION['emp_email'], $_SESSION['emp_nome']);

      $mail->Subject = 'NPS - Nova Avaliação';
      $mail->Body    = '<h1>Ol&aacute;, voc&ecirc; tem uma nova avalia&ccedil;&atilde;o!</h1>

                <h2>' . $_SESSION['emp_nome'] . ', foi avaliada com nota ' . nota($_SESSION['estrela']) . '.</h2>
                
                <h2>Coment&aacute;rio:</h2>

                <p>' . $_SESSION['feedback'] . '</p>';
      $mail->AltBody = 'Este é o corpo em texto puro para clientes de email não-HTML';
      $mail->send();
    } catch (Exception $e) {
      echo "Mensagem não pôde ser enviada. Erro do Mailer: {$mail->ErrorInfo}";
    }






    ?>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>