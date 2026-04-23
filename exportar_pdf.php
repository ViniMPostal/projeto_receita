<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include("conexao.php");

$dompdf = new Dompdf();

$html = "<h2>Lista de Receitas</h2><table border='1' width='100%'>
<tr><th>Nome</th><th>Tipo</th><th>Custo</th></tr>";

$result = pg_query($conn, "SELECT * FROM receita");

while ($row = pg_fetch_assoc($result)) {
    $html .= "<tr>
        <td>{$row['nome']}</td>
        <td>{$row['tipo_receita']}</td>
        <td>{$row['custo']}</td>
    </tr>";
}

$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("receitas.pdf");
?>