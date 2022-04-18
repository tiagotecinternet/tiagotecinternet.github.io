<?php

$headers = "Content-type:text/html; charset=iso-8859-1";

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');

$nome = $_POST[nome];
$email = $_POST[email];
$assunto = $_POST[assunto];
$mensagem=$_POST[mensagem];
$hora = date("d/m/Y, H:i:s");

//agora vamos enviar todos esses dados usando a função mail
mail("SEU EMAIL","$assunto","
Data: $hora
Nome: $nome
Email: $email
Assunto: $assunto
Mensagem: $mensagem","FROM:$nome<$email>");


echo "<script>alert('Enviado com sucesso!');document.location='index.html';</script>";

?>