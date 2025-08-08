SHOW datestyle; 

SET datestyle = "ISO, DMY";

DROP TABLE usuario CASCADE;
DROP TABLE servico CASCADE;
DROP TABLE  cliente CASCADE;
DROP TABLE  categoria CASCADE;
DROP TABLE  fornecedor CASCADE;
DROP TABLE  produto CASCADE;
DROP TABLE  funcionario CASCADE;
DROP TABLE  ordemServico CASCADE;
DROP TABLE  relatorio CASCADE;
 DROP TABLE  ordemServicoServico CASCADE;
 DROP TABLE  venda CASCADE;
 DROP TABLE  itemServico CASCADE;
 DROP TABLE  itemVenda CASCADE;
 DROP TABLE  servicoItemServico CASCADE;
 DROP TABLE  vendaItemVenda CASCADE;
 DROP TABLE  fornece CASCADE;

CREATE TABLE usuario(
  id_usuario varchar(4), 
  nome varchar(255),
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  tipo ENUM('admin', 'funcionario') NOT NULL,
  PRIMARY KEY(id_usuario)
);

CREATE TABLE servico(
  id_servico varchar(4),
  tipo varchar(30),
  nome varchar(30),
  valor float,
  PRIMARY KEY(id_servico)
);

CREATE TABLE cliente(
  id_cliente varchar(4),
  nome varchar(30),
  cpf varchar(11),
  PRIMARY KEY(id_cliente)
);

CREATE TABLE categoria(
  id_cat varchar(4),
  nome varchar(30),
  marca varchar(10),
  PRIMARY KEY(id_cat)
);

CREATE TABLE fornecedor(
  id_forn varchar(4),
  nome varchar(30),
  cnpj varchar(15),
  email varchar(30),
  PRIMARY KEY(id_forn)
);

CREATE TABLE produto(
  id_produto varchar(4),
  nome varchar(30),
  id_cat varchar(4),
  PRIMARY KEY(id_produto),
  FOREIGN KEY(id_cat) references categoria
);

CREATE TABLE funcionario(
  id_usuario varchar(4),
  nome varchar(255),
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  especialidade varchar(30),
  salario float,
  data_admissao timestamp,
  PRIMARY KEY(id_usuario),
  FOREIGN KEY(id_usuario) references usuario
);

CREATE TABLE ordemServico(
  id_os varchar(4),
  nome varchar(30),
  tipo_serviço varchar(30),
  data_serviço timestamp,
  status varchar(10),
  id_cliente varchar(4),
  id_funcionario varchar(4),
  PRIMARY KEY(id_os),
  FOREIGN KEY(id_cliente) references cliente,
  FOREIGN KEY(id_funcionario) references funcionario
);

CREATE TABLE relatorio(
  id_relatorio varchar(4),
  descrição varchar(30),
  id_os varchar(4),
  id_usuario varchar(4),
  PRIMARY KEY(id_relatorio),
  FOREIGN KEY(id_os) references ordemServico,
  FOREIGN KEY(id_usuario) references usuario
);

CREATE TABLE ordemServicoServico(
  id_os varchar(4),
  id_servico varchar(4),
  PRIMARY KEY(id_os, id_servico),
  FOREIGN KEY(id_os) references ordemServico,
  FOREIGN KEY(id_servico) references servico
);

CREATE TABLE venda(
  id_venda varchar(10),
  nome varchar(30),
  valor float,
  id_cliente varchar(4),
  id_funcionario varchar(4),
  PRIMARY KEY(id_venda),
  FOREIGN KEY(id_cliente) references cliente,
  FOREIGN KEY(id_funcionario) references funcionario
);

CREATE TABLE itemServico(
  id_produto varchar(4),
  nome varchar(30),
  PRIMARY KEY(id_produto),
  FOREIGN KEY(id_produto) references produto
);

CREATE TABLE itemVenda(
  id_produto varchar(4),
  nome varchar(30),
  PRIMARY KEY(id_produto),
  FOREIGN KEY(id_produto) references produto
);

CREATE TABLE servicoItemServico(
  id_Serv varchar(4),
  id_ItServ varchar(4),
  PRIMARY KEY(id_Serv, id_ItServ),
  FOREIGN KEY(id_Serv) references servico,
  FOREIGN KEY(id_ItServ) references itemServico
);

CREATE TABLE fornece(
  id_fornecedor varchar(4),
  id_produto varchar(4),
  PRIMARY KEY(id_fornecedor, id_produto),
  FOREIGN KEY(id_fornecedor) references fornecedor,
  FOREIGN KEY(id_produto) references produto
);

CREATE TABLE vendaItemVenda(
  id_ItVenda varchar(4),
  id_venda varchar(4),
  PRIMARY KEY(id_ItVenda, id_venda),
  FOREIGN KEY(id_ItVenda) references itemVenda,
  FOREIGN KEY(id_venda) references venda
);

ALTER TABLE usuario ALTER COLUMN id SET NOT NULL;
ALTER TABLE servico ALTER COLUMN id SET NOT NULL;
ALTER TABLE cliente ALTER COLUMN id SET NOT NULL;
ALTER TABLE categoria ALTER COLUMN id SET NOT NULL;
ALTER TABLE fornecedor ALTER COLUMN id SET NOT NULL;
ALTER TABLE produto ALTER COLUMN id SET NOT NULL;
ALTER TABLE funcionario ALTER COLUMN id_Usu SET NOT NULL;
ALTER TABLE ordemServico ALTER COLUMN id SET NOT NULL;
ALTER TABLE relatorio ALTER COLUMN id SET NOT NULL;
ALTER TABLE ordemServicoServico ALTER COLUMN id_OS SET NOT NULL;
ALTER TABLE venda ALTER COLUMN id SET NOT NULL;
ALTER TABLE itemServico ALTER COLUMN id_P SET NOT NULL;
ALTER TABLE itemVenda ALTER COLUMN id_P SET NOT NULL;
ALTER TABLE servicoItemServico ALTER COLUMN id_Serv SET NOT NULL;
ALTER TABLE fornece ALTER COLUMN id_Forn SET NOT NULL;


INSERT INTO usuario values('0001', 'Thiago',	'gerente');
INSERT INTO usuario values('0002', 'Vinicius', 'gerente');
INSERT INTO usuario values('0003', 'Gabriel', 'funcionário');
INSERT INTO usuario values('0004', 'João', 'funcionário');
INSERT INTO usuario values('0005', 'Mateus', 'funcionário');

INSERT INTO servico values('0001', 'manutencao', 'serv1', 50);
INSERT INTO servico values('0002', 'manutencao', 'serv2', 100);
INSERT INTO servico values('0003', 'manutencao', 'serv3', 150);
INSERT INTO servico values('0004', 'manutencao', 'serv4', 75);

INSERT INTO cliente values('0001', 'Davi', '13952715145');
INSERT INTO cliente values('0002', 'Maria', '65435793587');
INSERT INTO cliente values('0003', 'Sara', '69875434664');

INSERT INTO categoria values('0001', 'cat1', 'marca1');
INSERT INTO categoria values('0002', 'cat2', 'marca2');
INSERT INTO categoria values('0003', 'cat3', 'marca3');
INSERT INTO categoria values('0004', 'cat4', 'marca4');

INSERT INTO fornecedor values('0001', 'Forn1', '654654', 'forn1@gmail.com');
INSERT INTO fornecedor values('0002', 'Forn2', '645545', 'forn2@gmail.com');
INSERT INTO fornecedor values('0003', 'Forn3', '445454', 'forn3@gmail.com');
INSERT INTO fornecedor values('0004', 'Forn4', '846435', 'forn4@gmail.com');

INSERT INTO produto values('0001', 'prod1', '0001');
INSERT INTO produto values('0002', 'prod2', '0002');
INSERT INTO produto values('0003', 'prod3', '0003');
INSERT INTO produto values('0004', 'prod4', '0003');

INSERT INTO funcionario values('0001', NULL, 2500, '12/06/2025');
INSERT INTO funcionario values('0002', 'secretário', 2500, '25/02/2025');
INSERT INTO funcionario values('0003', 'estagiário', 1500, '15/04/2025');
INSERT INTO funcionario values('0004', 'chaveiro', 2000, '21/06/2025');
INSERT INTO funcionario values('0005', 'chaveiro', 2000, '08/07/2025');

INSERT INTO itemServico values('0001', 'serv1');
INSERT INTO itemServico values('0002', 'serv2');

INSERT INTO itemVenda values('0003', 'item1');
INSERT INTO itemVenda values('0004', 'item1');

INSERT INTO venda values('0001', 'nome1', 50, '0001', '0005');
INSERT INTO venda values('0002', 'nome2', 100, '0001', '0004');
INSERT INTO venda values('0003', 'nome3', 150, '0003', '0004');
INSERT INTO venda values('0004', 'nome4', 75, '0002', '0005');

INSERT INTO ordemServico values('0001', 'ordem1', 'serv1', '04/08/2025', 'concluído', '0003', '0001');
INSERT INTO ordemServico values('0002', 'ordem2', 'serv2', '06/08/2025', 'andamento', '0002', '0003');
INSERT INTO ordemServico values('0003', 'ordem3', 'serv1', '10/08/2025', 'pendente', '0003', '0001');
INSERT INTO ordemServico values('0004', 'ordem4', 'serv2', '03/08/2025', 'atrasado', '0001', '0002');

INSERT INTO relatorio values('0001', 'relatorio1', '0001', '0001');
INSERT INTO relatorio values('0002', 'relatorio2', '0004', '0002');
INSERT INTO relatorio values('0003', 'relatorio3', '0002', '0002');
INSERT INTO relatorio values('0004', 'relatorio4', '0003', '0001');

INSERT INTO ordemServicoServico values('0001', '0004');
INSERT INTO ordemServicoServico values('0002', '0003');
INSERT INTO ordemServicoServico values('0003', '0002');
INSERT INTO ordemServicoServico values('0004', '0001');

INSERT INTO servicoItemServico values('0001', '0002');
INSERT INTO servicoItemServico values('0002', '0001');
INSERT INTO servicoItemServico values('0003', '0001');
INSERT INTO servicoItemServico values('0004', '0002');

INSERT INTO fornece values('0001', '0003');
INSERT INTO fornece values('0003', '0002');
INSERT INTO fornece values('0001', '0004');

INSERT INTO vendaItemVenda values('0004', '0002');
INSERT INTO vendaItemVenda values('0003', '0001');
INSERT INTO vendaItemVenda values('0003', '0003');
INSERT INTO vendaItemVenda values('0004', '0003');

UPDATE funcionario
SET salario = funcionario.salario * 1.50
FROM usuario
WHERE usuario.tipo = 'gerente' AND funcionario.id_Usu = usuario.id;

UPDATE funcionario
SET salario = funcionario.salario * 1.25
FROM usuario
WHERE usuario.tipo <> 'gerente' AND funcionario.id_Usu = usuario.id;

UPDATE ordemServico
SET status = 'concluído'
WHERE status = 'andamento';

DELETE FROM fornece
WHERE id_Forn = '0003'

DELETE FROM vendaItemVenda
WHERE id_ItVenda = '0003'

DELETE FROM servicoItemServico
WHERE id_Serv = '0002'