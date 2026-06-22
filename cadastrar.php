<?php
include("conexao.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de cadastro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <h2>Nova Receita</h2>

    <form action="salvar.php" method="POST">

        Nome:
        <input type="text" name="nome">
        <br>

        Descrição:
        <input type="text" name="descricao">
        <br>

        Custo:
        <input type="number" step="0.01" name="custo">
        <br>

        Tipo:
        <select name="tipo">
            <option value="doce">Doce</option>
            <option value="salgada">Salgada</option>
        </select>

        <br>

        <button type="submit">Salvar</button>

    </form>

    <br>

    <a href="receitas.php">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>