<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <form method="GET">
        Data: <input type="date" name="data">

        Tipo:
        <select name="tipo">
            <option value="">Todos</option>
            <option value="doce">Doce</option>
            <option value="salgada">Salgada</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <a href="exportar_pdf.php">Exportar PDF</a>

    <?php
        include("conexao.php");
        
        if (!isset($_SESSION['login'])) {
            header("Location: login.php");
        }
    ?>

    <h2>Receitas</h2>

    <a href="cadastrar.php">Nova Receita</a> |
    <a href="logout.php">Sair</a>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Custo</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>

        <?php
            $result = pg_query($conn, "SELECT * FROM receita");

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

            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['descricao']}</td>
                    <td>{$row['custo']}</td>
                    <td>{$row['tipo_receita']}</td>
                    <td>
                        <a href='editar.php?id={$row['id']}'>Editar</a> |
                        <a href='excluir.php?id={$row['id']}'>Excluir</a>
                    </td>
                </tr>";
            }

            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['descricao']}</td>
                    <td>{$row['custo']}</td>
                    <td>{$row['tipo_receita']}</td>
                    <td>
                        <a href='editar.php?id={$row['id']}'>Editar</a> |
                        <a href='excluir.php?id={$row['id']}'>Excluir</a>
                    </td>
                </tr>";
            }
        ?>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>