<?php
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/vendor/autoload.php';

function enviarEmail($mensagem) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vinicius.postal@universo.univates.br';
    $mail->Password = 'bmjr hbvv gsnw emix';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('SEU_EMAIL@gmail.com', 'Sistema Receitas');
    $mail->addAddress('SEU_EMAIL@gmail.com');

    $mail->Subject = 'Atualização de Receita';
    $mail->Body = $mensagem;

    $mail->send();
}
?>