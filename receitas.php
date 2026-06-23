<?php
include("conexao.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$where = [];

if (!empty($_GET['data'])) {
    $data = $_GET['data'];
    $where[] = "data_registro = '$data'";
}

if (!empty($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $where[] = "tipo_receita = '$tipo'";
}

$query = "SELECT * FROM receita";

if (count($where) > 0) {
    $query .= " WHERE " . implode(" AND ", $where);
}

$result = pg_query($conn, $query);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Receitas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="page-container">
        <div class="card-app">
            <div class="top-actions">
                <h2>Receitas</h2>

                <div>
                    <a href="cadastrar.php" class="btn btn-success btn-sm">Nova Receita</a>
                    <a href="exportar_pdf.php" class="btn btn-secondary btn-sm">Exportar PDF</a>
                    <a href="logout.php" class="btn btn-danger btn-sm">Sair</a>
                </div>
            </div>

            <form method="GET" class="filter-form">
                <div>
                    <label class="form-label">Data</label>
                    <input type="date" name="data" class="form-control">
                </div>

                <div>
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="">Todos</option>
                        <option value="doce">Doce</option>
                        <option value="salgada">Salgada</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Custo</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>

                <?php
                while ($row = pg_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['nome']}</td>
                            <td>{$row['descricao']}</td>
                            <td>R$ {$row['custo']}</td>
                            <td>{$row['tipo_receita']}</td>
                            <td class='table-actions'>
                                <a href='editar.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='excluir.php?id={$row['id']}' class='btn btn-danger btn-sm'>Excluir</a>
                            </td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>