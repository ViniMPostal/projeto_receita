<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/ReceitaValidator.php';

class ReceitaTest extends TestCase
{
    public function testNomeValido()
    {
        $this->assertTrue(ReceitaValidator::nomeValido('Coxinha'));
    }

    public function testNomeMuitoCurto()
    {
        $this->assertFalse(ReceitaValidator::nomeValido('A'));
    }

    public function testNomeVazio()
    {
        $this->assertFalse(ReceitaValidator::nomeValido(''));
    }

    public function testNomeComEspacos()
    {
        $this->assertFalse(ReceitaValidator::nomeValido('   '));
    }

    public function testDescricaoValida()
    {
        $this->assertTrue(ReceitaValidator::descricaoValida('Salgado de frango'));
    }

    public function testDescricaoVazia()
    {
        $this->assertFalse(ReceitaValidator::descricaoValida(''));
    }

    public function testDescricaoMuitoCurta()
    {
        $this->assertFalse(ReceitaValidator::descricaoValida('abc'));
    }

    public function testCustoValidoInteiro()
    {
        $this->assertTrue(ReceitaValidator::custoValido(10));
    }

    public function testCustoValidoDecimal()
    {
        $this->assertTrue(ReceitaValidator::custoValido(10.50));
    }

    public function testCustoZero()
    {
        $this->assertFalse(ReceitaValidator::custoValido(0));
    }

    public function testCustoNegativo()
    {
        $this->assertFalse(ReceitaValidator::custoValido(-5));
    }

    public function testCustoNaoNumerico()
    {
        $this->assertFalse(ReceitaValidator::custoValido('abc'));
    }

    public function testTipoDoceValido()
    {
        $this->assertTrue(ReceitaValidator::tipoValido('doce'));
    }

    public function testTipoSalgadaValido()
    {
        $this->assertTrue(ReceitaValidator::tipoValido('salgada'));
    }

    public function testTipoInvalido()
    {
        $this->assertFalse(ReceitaValidator::tipoValido('bebida'));
    }

    public function testTipoVazio()
    {
        $this->assertFalse(ReceitaValidator::tipoValido(''));
    }

    public function testDataValida()
    {
        $this->assertTrue(ReceitaValidator::dataValida('2026-06-22'));
    }

    public function testDataComFormatoBrasileiroInvalida()
    {
        $this->assertFalse(ReceitaValidator::dataValida('22/06/2026'));
    }

    public function testDataSemSeparadorInvalida()
    {
        $this->assertFalse(ReceitaValidator::dataValida('20260622'));
    }

    public function testDataVazia()
    {
        $this->assertFalse(ReceitaValidator::dataValida(''));
    }
}