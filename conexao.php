<?php
    $conn = pg_connect("host=localhost dbname=tabela_receita user=postgres password=postgres");
    
    if (!$conn) {
        die("Erro na conexão");
    }
    
    session_start();
?>