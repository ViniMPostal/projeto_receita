<?php
    include("conexao.php");
    
    $id = $_GET['id'];
    
    pg_query($conn, "DELETE FROM receita WHERE id=$id");
    
    header("Location: receitas.php");
?>