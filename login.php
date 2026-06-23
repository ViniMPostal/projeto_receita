<?php
include("conexao.php");

$erro = "";

if ($_POST) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuario WHERE login='$login' AND senha='$senha'";
    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        $_SESSION['login'] = $login;
        header("Location: receitas.php");
        exit;
    } else {
        $erro = "Login inválido";
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="login-container">
        <div class="card-app">
            <h2 class="page-title">Sistema de Receitas</h2>

            <?php if (!empty($erro)) { ?>
            <div class="alert alert-danger">
                <?php echo $erro; ?>
            </div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" name="login" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>