<?php
session_start();

$conn = pg_connect(
    "host=db dbname=tabela_receita user=postgres password=postgres"
);

if (!$conn) {
    die("Erro na conexão");
}
