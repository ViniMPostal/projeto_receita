<?php
    include("conexao.php");
    require 'email.php';
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $tipo = $_POST['tipo'];
    
    $query = "INSERT INTO receita (nome, descricao, data_registro, custo, tipo_receita)
    VALUES ('$nome', '$descricao', CURRENT_DATE, $custo, '$tipo')";
    
    pg_query($conn, $query);

    $mensagem = "Nova receita cadastrada: $nome";
    enviarEmail($mensagem);
    
    header("Location: receitas.php");
    exit;
?>