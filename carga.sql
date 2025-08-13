-- Tabela: usuario
INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `password`, `tipo`) VALUES
('1001', 'Admin', 'admin@chaveiro.com', 'senha_criptografada', 'admin'),
('1002', 'Bia', 'bia@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1003', 'Carlos', 'carlos@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1004', 'Dani', 'dani@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1005', 'Edu', 'edu@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1006', 'Fernanda', 'fernanda@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1007', 'Gustavo', 'gustavo@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1008', 'Heloisa', 'heloisa@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1009', 'Igor', 'igor@chaveiro.com', 'senha_criptografada', 'funcionario'),
('1010', 'Julia', 'julia@chaveiro.com', 'senha_criptografada', 'funcionario');

-- Tabela: servico
INSERT INTO `servico` (`id_servico`, `tipo`, `nome`, `valor`) VALUES
('2001', 'Cópia', 'Cópia de Chave Yale', 15.00),
('2002', 'Emergência', 'Abertura de Porta Residencial', 120.00),
('2003', 'Instalação', 'Instalação de Fechadura Digital', 250.00),
('2004', 'Manutenção', 'Troca de Segredo de Fechadura', 80.50),
('2005', 'Codificação', 'Cópia de Chave Codificada Auto', 350.00),
('2006', 'Emergência', 'Abertura de Porta de Carro', 150.00),
('2007', 'Instalação', 'Instalação de Mola Aérea', 90.00),
('2008', 'Reparo', 'Reparo de Ignição Automotiva', 280.00),
('2009', 'Cópia', 'Cópia de Chave Tetra', 45.00),
('2010', 'Manutenção', 'Manutenção de Fechadura Digital', 180.00);

-- Tabela: cliente
INSERT INTO `cliente` (`id_cliente`, `nome`, `cpf`) VALUES
('3001', 'Ana Silva', '11122233344'),
('3002', 'Bruno Costa', '22233344455'),
('3003', 'Carla Dias', '33344455566'),
('3004', 'Daniel Faria', '44455566677'),
('3005', 'Elisa Gomes', '55566677788'),
('3006', 'Fábio Lima', '66677788899'),
('3007', 'Gisele Matos', '77788899900'),
('3008', 'Heitor Nunes', '88899900011'),
('3009', 'Iris Paiva', '99900011122'),
('3010', 'João Viana', '00011122233');

-- Tabela: categoria
INSERT INTO `categoria` (`id_cat`, `nome`, `marca`) VALUES
('4001', 'Cadeados', 'Papaiz'),
('4002', 'Fechaduras', 'Pado'),
('4003', 'Chaves Virgens', 'Gold'),
('4004', 'Controles de Portão', 'PPA'),
('4005', 'Fechaduras Digitais', 'Intelbras'),
('4006', 'Cilindros', 'Stam'),
('4007', 'Molas Aéreas', 'Soprano'),
('4008', 'Transponders', 'JMA'),
('4009', 'Cofres', 'Safewell'),
('4010', 'Acessórios', 'Diversos');

-- Tabela: fornecedor
INSERT INTO `fornecedor` (`id_forn`, `nome`, `cnpj`, `email`) VALUES
('5001', 'Distribuidora Pado', '12345678000199', 'contato@pado.com'),
('5002', 'Gold Chaves Atacado', '23456789000188', 'vendas@gold.com'),
('5003', 'Intelbras Security', '34567890000177', 'comercial@intelbras.com'),
('5004', 'Papaiz Brasil', '45678901000166', 'dist@papaiz.com.br'),
('5005', 'PPA Controles', '56789012000155', 'contato@ppa.com.br'),
('5006', 'Fornecedor Geral A', '67890123000144', 'contato@fornecedorA.com'),
('5007', 'Fornecedor Geral B', '78901234000133', 'contato@fornecedorB.com'),
('5008', 'Fornecedor Geral C', '89012345000122', 'contato@fornecedorC.com'),
('5009', 'Fornecedor Geral D', '90123456000111', 'contato@fornecedorD.com'),
('5010', 'Fornecedor Geral E', '01234567000100', 'contato@fornecedorE.com');

-- ============================================================
-- 2. TABELAS COM UMA DEPENDÊNCIA
-- ============================================================

-- Tabela: produto (depende de categoria)
INSERT INTO `produto` (`id_produto`, `nome`, `id_cat`) VALUES
('6001', 'Cadeado de Latão 40mm', '4001'),
('6002', 'Fechadura Externa Stam', '4002'),
('6003', 'Chave Yale Virgem n.12', '4003'),
('6004', 'Controle Remoto Tok PPA', '4004'),
('6005', 'Fechadura Digital FR101', '4005'),
('6006', 'Cilindro Pado 55mm', '4006'),
('6007', 'Mola Aérea Soprano A3', '4007'),
('6008', 'Chip Transponder T42', '4008'),
('6009', 'Cofre Digital Pequeno', '4009'),
('6010', 'Argola para Chaveiro', '4010');

-- Tabela: funcionario (depende de usuario)
INSERT INTO `funcionario` (`id_usuario`, `nome`, `email`, `password`, `especialidade`, `salario`, `data_admissao`) VALUES
('1002', 'Bia', 'bia@chaveiro.com', 'senha_criptografada', 'Chaveira Residencial', 2800.00, '2022-01-10 08:00:00'),
('1003', 'Carlos', 'carlos@chaveiro.com', 'senha_criptografada', 'Técnico Eletrônico', 3200.00, '2021-05-20 08:00:00'),
('1004', 'Dani', 'dani@chaveiro.com', 'senha_criptografada', 'Atendente de Balcão', 1800.00, '2023-02-15 08:00:00'),
('1005', 'Edu', 'edu@chaveiro.com', 'senha_criptografada', 'Chaveiro Automotivo', 3500.00, '2020-11-01 08:00:00'),
('1006', 'Fernanda', 'fernanda@chaveiro.com', 'senha_criptografada', 'Atendente de Balcão', 1850.00, '2023-03-20 08:00:00'),
('1007', 'Gustavo', 'gustavo@chaveiro.com', 'senha_criptografada', 'Chaveiro Residencial', 2900.00, '2022-08-11 08:00:00'),
('1008', 'Heloisa', 'heloisa@chaveiro.com', 'senha_criptografada', 'Técnica Eletrônica', 3300.00, '2023-01-05 08:00:00'),
('1009', 'Igor', 'igor@chaveiro.com', 'senha_criptografada', 'Chaveiro Automotivo', 3600.00, '2021-09-30 08:00:00'),
('1010', 'Julia', 'julia@chaveiro.com', 'senha_criptografada', 'Atendente de Balcão', 1900.00, '2023-06-18 08:00:00');

-- Tabela: itemServico (depende de produto)
INSERT INTO `itemServico` (`id_produto`, `nome`) VALUES
('6002', 'Fechadura Stam para Instalação'),
('6003', 'Chave Virgem para Cópia'),
('6005', 'Fechadura Digital para Instalar'),
('6006', 'Cilindro para Troca de Segredo'),
('6007', 'Mola Aérea para Instalação'),
('6008', 'Chip Transponder para Codificar');

-- Tabela: itemVenda (depende de produto)
INSERT INTO `itemVenda` (`id_produto`, `nome`) VALUES
('6001', 'Cadeado Papaiz 40mm'),
('6002', 'Fechadura Externa Pado'),
('6003', 'Chave Yale Virgem Gold'),
('6004', 'Controle Remoto PPA Tok'),
('6005', 'Fechadura Digital Intelbras'),
('6006', 'Cilindro Stam 55mm'),
('6007', 'Mola Aérea Soprano'),
('6009', 'Cofre Pequeno Safewell'),
('6010', 'Argola de Aço');


-- ============================================================
-- 3. TABELAS COM MÚLTIPLAS DEPENDÊNCIAS
-- ============================================================

-- Tabela: ordemServico (depende de cliente e funcionario)
INSERT INTO `ordemServico` (`id_os`, `nome`, `tipo_serviço`, `data_serviço`, `status`, `id_cliente`, `id_funcionario`) VALUES
('7001', 'Abertura Apto 101', 'Emergência', '2023-10-25 10:00:00', 'Concluído', '3001', '1002'),
('7002', 'Cópia Chave Fiat', 'Codificação', '2023-10-26 14:30:00', 'Em Andamento', '3002', '1005'),
('7003', 'Instalar Fechadura Digital', 'Instalação', '2023-10-27 09:00:00', 'Agendado', '3003', '1003'),
('7004', 'Trocar Segredo Porta', 'Manutenção', '2023-10-28 11:00:00', 'Aguardando', '3004', '1002'),
('7005', '5 Cópias Chave Casa', 'Cópia', '2023-10-29 16:00:00', 'Concluído', '3005', '1004'),
('7006', 'Abertura Ford Ka', 'Emergência', '2023-11-01 12:00:00', 'Concluído', '3006', '1009'),
('7007', 'Instalar Mola Aérea Portão', 'Instalação', '2023-11-02 15:00:00', 'Agendado', '3007', '1007'),
('7008', 'Reparo Ignição Celta', 'Reparo', '2023-11-03 18:00:00', 'Em Andamento', '3008', '1005'),
('7009', '10 Cópias Chave Tetra', 'Cópia', '2023-11-04 10:30:00', 'Concluído', '3009', '1010'),
('7010', 'Manutenção Fechadura Hotel', 'Manutenção', '2023-11-05 11:00:00', 'Aguardando', '3010', '1008');

-- Tabela: venda (depende de cliente e funcionario)
INSERT INTO `venda` (`id_venda`, `nome`, `valor`, `id_cliente`, `id_funcionario`) VALUES
('8001', 'Venda Cadeado', 35.50, '3001', '1004'),
('8002', 'Venda Controle Portão', 60.00, '3002', '1004'),
('8003', 'Venda Fechadura', 180.00, '3003', '1002'),
('8004', 'Venda Chave Virgem', 5.00, '3001', '1004'),
('8005', 'Venda Cadeado Pequeno', 25.00, '3004', '1004'),
('8006', 'Venda Cilindro', 75.00, '3006', '1006'),
('8007', 'Venda Mola Aérea', 95.80, '3007', '1007'),
('8008', 'Venda Cofre', 450.00, '3008', '1008'),
('8009', 'Venda Argolas', 10.00, '3009', '1010'),
('8010', 'Venda Fechadura Digital', 899.90, '3010', '1003');

-- Tabela: relatorio (depende de ordemServico e usuario)
INSERT INTO `relatorio` (`id_relatorio`, `descrição`, `id_os`, `id_usuario`) VALUES
('9001', 'Relatório Final OS 7001', '7001', '1001'),
('9002', 'Relatório Parcial OS 7002', '7002', '1001'),
('9003', 'Orçamento OS 7003', '7003', '1003'),
('9004', 'Diagnóstico OS 7004', '7004', '1002'),
('9005', 'Conclusão OS 7005', '7005', '1004'),
('9006', 'Relatório Final OS 7006', '7006', '1001'),
('9007', 'Orçamento OS 7007', '7007', '1007'),
('9008', 'Diagnóstico OS 7008', '7008', '1005'),
('9009', 'Conclusão OS 7009', '7009', '1010'),
('9010', 'Relatório Inicial OS 7010', '7010', '1008');


-- ============================================================
-- 4. TABELAS (N-N)
-- ============================================================

-- Tabela: ordemServicoServico
INSERT INTO `ordemServicoServico` (`id_os`, `id_servico`) VALUES
('7001', '2002'), ('7002', '2005'), ('7003', '2003'), ('7004', '2004'), ('7005', '2001'),
('7006', '2006'), ('7007', '2007'), ('7008', '2008'), ('7009', '2009'), ('7010', '2010');

-- Tabela: servicoItemServico
INSERT INTO `servicoItemServico` (`id_servico`, `id_ItServ`) VALUES
('2003', '6005'), ('2001', '6003'), ('2004', '6002'), ('2007', '6007'), ('2005', '6008');

-- Tabela: fornece
INSERT INTO `fornece` (`id_fornecedor`, `id_produto`) VALUES
('5004', '6001'), ('5001', '6002'), ('5002', '6003'), ('5005', '6004'), ('5003', '6005'),
('5006', '6006'), ('5007', '6007'), ('5008', '6008'), ('5009', '6009'), ('5010', '6010');

-- Tabela: vendaItemVenda
INSERT INTO `vendaItemVenda` (`id_ItVenda`, `id_venda`) VALUES
('6001', '8001'), ('6004', '8002'), ('6002', '8003'), ('6003', '8004'), ('6001', '8005'),
('6006', '8006'), ('6007', '8007'), ('6009', '8008'), ('6010', '8009'), ('6005', '8010');




