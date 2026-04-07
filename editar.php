<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de edição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <?php
        include("conexao.php");
        
        $id = $_GET['id'];
        $result = pg_query($conn, "SELECT * FROM receita WHERE id=$id");
        $receita = pg_fetch_assoc($result);
    ?>

    <h2>Editar Receita</h2>

    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $receita['id']; ?>">

        Nome: <input type="text" name="nome" value="<?php echo $receita['nome']; ?>"><br>
        Descrição: <input type="text" name="descricao" value="<?php echo $receita['descricao']; ?>"><br>
        Custo: <input type="number" step="0.01" name="custo" value="<?php echo $receita['custo']; ?>"><br>

        Tipo:
        <select name="tipo">
            <option value="doce" <?php if($receita['tipo_receita']=="doce") echo "selected"; ?>>Doce</option>
            <option value="salgada" <?php if($receita['tipo_receita']=="salgada") echo "selected"; ?>>Salgada</option>
        </select><br>

        <button type="submit">Atualizar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>