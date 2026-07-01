CREATE TABLE IF NOT EXISTS categoria (
    id SERIAL PRIMARY KEY,
    id_receita INTEGER,
    acao VARCHAR(50) NOT NULL,
    descricao TEXT,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
