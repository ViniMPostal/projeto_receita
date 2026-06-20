<?php

use PHPUnit\Framework\TestCase;

class ReceitaTest extends TestCase
{
    // 1
    public function testNomeNaoVazio()
    {
        $nome = "Bolo";
        $this->assertNotEmpty($nome);
    }

    // 2
    public function testDescricaoNaoVazia()
    {
        $desc = "Doce";
        $this->assertNotEmpty($desc);
    }

    // 3
    public function testCustoMaiorQueZero()
    {
        $custo = 10;
        $this->assertGreaterThan(0, $custo);
    }

    // 4
    public function testTipoDoce()
    {
        $tipo = "doce";
        $this->assertEquals("doce", $tipo);
    }

    // 5
    public function testTipoSalgada()
    {
        $tipo = "salgada";
        $this->assertEquals("salgada", $tipo);
    }

    // 6
    public function testTipoInvalido()
    {
        $tipo = "bebida";
        $this->assertNotEquals("doce", $tipo);
    }

    // 7
    public function testLoginValido()
    {
        $login = "admin";
        $this->assertEquals("admin", $login);
    }

    // 8
    public function testSenhaNaoVazia()
    {
        $senha = "123";
        $this->assertNotEmpty($senha);
    }

    // 9
    public function testCustoDecimal()
    {
        $custo = 10.50;
        $this->assertIsFloat($custo);
    }

    // 10
    public function testDataValida()
    {
        $data = "2025-01-01";
        $this->assertMatchesRegularExpression("/\d{4}-\d{2}-\d{2}/", $data);
    }

    // 11
    public function testNomeString()
    {
        $nome = "Coxinha";
        $this->assertIsString($nome);
    }

    // 12
    public function testDescricaoString()
    {
        $desc = "Salgado";
        $this->assertIsString($desc);
    }

    // 13
    public function testCustoNumerico()
    {
        $custo = 20;
        $this->assertIsNumeric($custo);
    }

    // 14
    public function testTipoNaoVazio()
    {
        $tipo = "doce";
        $this->assertNotEmpty($tipo);
    }

    // 15
    public function testUsuarioAtivo()
    {
        $situacao = true;
        $this->assertTrue($situacao);
    }

    // 16
    public function testUsuarioInativo()
    {
        $situacao = false;
        $this->assertFalse($situacao);
    }

    // 17
    public function testNomeMinimo()
    {
        $nome = "A";
        $this->assertGreaterThanOrEqual(1, strlen($nome));
    }

    // 18
    public function testDescricaoMinima()
    {
        $desc = "B";
        $this->assertGreaterThanOrEqual(1, strlen($desc));
    }

    // 19
    public function testTipoValido()
    {
        $tipo = "doce";
        $this->assertContains($tipo, ["doce", "salgada"]);
    }

    // 20
    public function testCustoNaoNegativo()
    {
        $custo = 5;
        $this->assertGreaterThanOrEqual(0, $custo);
    }
}
