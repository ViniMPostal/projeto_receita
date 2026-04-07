<?php
    include("conexao.php");
    
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $tipo = $_POST['tipo'];
    
    $query = "UPDATE receita 
    SET nome='$nome', descricao='$descricao', custo=$custo, tipo_receita='$tipo'
    WHERE id=$id";
    
    pg_query($conn, $query);
    
    header("Location: receitas.php");
?>