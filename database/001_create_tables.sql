CREATE TABLE IF NOT EXISTS usuario (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    login VARCHAR(50),
    senha VARCHAR(255),
    situacao BOOLEAN DEFAULT true
);

CREATE TABLE IF NOT EXISTS receita (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT,
    data_registro DATE,
    custo DECIMAL(10,2),
    tipo_receita VARCHAR(10)
);