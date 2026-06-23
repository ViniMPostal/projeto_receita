<?php
include("conexao.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$result = pg_query($conn, "SELECT * FROM receita WHERE id=$id");
$receita = pg_fetch_assoc($result);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de edição</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-container">
        <div class="card-app">
            <h2 class="page-title">Editar Receita</h2>

            <form action="atualizar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $receita['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" value="<?php echo $receita['nome']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="descricao" class="form-control"
                        value="<?php echo $receita['descricao']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Custo</label>
                    <input type="number" step="0.01" name="custo" class="form-control"
                        value="<?php echo $receita['custo']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="doce" <?php if ($receita['tipo_receita'] == 'doce') echo 'selected'; ?>>
                            Doce
                        </option>

                        <option value="salgada" <?php if ($receita['tipo_receita'] == 'salgada') echo 'selected'; ?>>
                            Salgada
                        </option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="receitas.php" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>