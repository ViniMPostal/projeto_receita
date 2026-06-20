INSERT INTO usuario (nome, login, senha, situacao)
VALUES ('admin', 'admin', '123', true);

INSERT INTO receita (nome, descricao, data_registro, custo, tipo_receita) VALUES
('Brigadeiro', 'Doce de chocolate', CURRENT_DATE, 10.00, 'doce'),
('Coxinha', 'Salgado de frango', CURRENT_DATE, 15.00, 'salgada'),
('Pudim', 'Sobremesa', CURRENT_DATE, 20.00, 'doce'),
('Empada', 'Frango com massa', CURRENT_DATE, 12.00, 'salgada'),
('Bolo de cenoura', 'Com cobertura de chocolate', CURRENT_DATE, 25.00, 'doce'),
('Pastel', 'Salgado de carne', CURRENT_DATE, 8.00, 'salgada'),
('Beijinho', 'Doce de coco', CURRENT_DATE, 10.00, 'doce'),
('Quibe', 'Salgado de carne moída', CURRENT_DATE, 14.00, 'salgada'),
('Mousse', 'Sobremesa de chocolate', CURRENT_DATE, 18.00, 'doce'),
('Esfiha', 'Salgado de carne temperada', CURRENT_DATE, 9.00, 'salgada');