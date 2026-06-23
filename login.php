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
</head>

<body>

    <h2>Login</h2>

    <?php if (!empty($erro)) { ?>
    <p style="color:red;"><?php echo $erro; ?></p>
    <?php } ?>

    <form method="POST">
        Login: <input type="text" name="login"><br>
        Senha: <input type="password" name="senha"><br>
        <button type="submit">Entrar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>