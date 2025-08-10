CREATE TABLE usuario(
  id_usuario varchar(4) NOT NULL,
  nome varchar(255),
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  tipo ENUM('admin', 'funcionario') NOT NULL,
  PRIMARY KEY(id_usuario)
);

CREATE TABLE servico(
  id_servico varchar(4) NOT NULL,
  tipo varchar(255),
  nome varchar(255),
  valor float,
  PRIMARY KEY(id_servico)
);

CREATE TABLE cliente(
  id_cliente varchar(4) NOT NULL,
  nome varchar(255),
  cpf varchar(11),
  PRIMARY KEY(id_cliente)
);

CREATE TABLE categoria(
  id_cat varchar(4) NOT NULL,
  nome varchar(255),
  marca varchar(255),
  PRIMARY KEY(id_cat)
);

CREATE TABLE fornecedor(
  id_forn varchar(4) NOT NULL,
  nome varchar(255),
  cnpj varchar(15),
  email varchar(255),
  PRIMARY KEY(id_forn)
);

CREATE TABLE produto(
  id_produto varchar(4) NOT NULL,
  nome varchar(30),
  id_cat varchar(4),
  PRIMARY KEY(id_produto),
  FOREIGN KEY (id_cat) REFERENCES categoria(id_cat)
);

CREATE TABLE funcionario(
  id_usuario varchar(4) NOT NULL,
  nome varchar(255),
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  especialidade varchar(30),
  salario float,
  data_admissao timestamp,
  PRIMARY KEY(id_usuario),
  FOREIGN KEY(id_usuario) references usuario(id_usuario)
);

CREATE TABLE ordemServico(
  id_os varchar(4) NOT NULL,
  nome varchar(30),
  tipo_serviço varchar(30),
  data_serviço timestamp,
  status varchar(10),
  id_cliente varchar(4) NOT NULL,
  id_funcionario varchar(4) NOT NULL,
  PRIMARY KEY(id_os),
  FOREIGN KEY(id_cliente) references cliente (id_cliente),
  FOREIGN KEY(id_funcionario) references funcionario(id_usuario)
);

CREATE TABLE relatorio(
  id_relatorio varchar(4) NOT NULL,
  descrição varchar(30),
  id_os varchar(4) NOT NULL,
  id_usuario varchar(4) NOT NULL,
  PRIMARY KEY(id_relatorio),
  FOREIGN KEY(id_os) references ordemServico(id_os),
  FOREIGN KEY(id_usuario) references usuario(id_usuario)
);

CREATE TABLE ordemServicoServico(
  id_os varchar(4) NOT NULL,
  id_servico varchar(4) NOT NULL,
  PRIMARY KEY(id_os, id_servico),
  FOREIGN KEY(id_os) references ordemServico(id_os), 
  FOREIGN KEY(id_servico) references servico(id_servico)  
);

CREATE TABLE venda(
  id_venda varchar(10) NOT NULL,
  nome varchar(30),
  valor float,
  id_cliente varchar(4) NOT NULL,
  id_funcionario varchar(4) NOT NULL,
  PRIMARY KEY(id_venda),
  FOREIGN KEY(id_cliente) references cliente(id_cliente),
  FOREIGN KEY(id_funcionario) references funcionario(id_usuario)
);

CREATE TABLE itemServico(
  id_produto varchar(4) NOT NULL,
  nome varchar(30),
  PRIMARY KEY(id_produto),
  FOREIGN KEY(id_produto) references produto(id_produto)
);

CREATE TABLE itemVenda(
  id_produto varchar(4) NOT NULL,
  nome varchar(30),
  PRIMARY KEY(id_produto),
  FOREIGN KEY(id_produto) references produto(id_produto)
);

CREATE TABLE servicoItemServico(
  id_servico varchar(4) NOT NULL,
  id_ItServ varchar(4) NOT NULL,
  PRIMARY KEY(id_servico, id_ItServ),
  FOREIGN KEY(id_servico) references servico(id_servico),
  FOREIGN KEY(id_ItServ) references itemServico(id_produto)
);

CREATE TABLE fornece(
  id_fornecedor varchar(4) NOT NULL,
  id_produto varchar(4) NOT NULL,
  PRIMARY KEY(id_fornecedor, id_produto),
  FOREIGN KEY(id_fornecedor) references fornecedor(id_forn),
  FOREIGN KEY(id_produto) references produto(id_produto)
);

CREATE TABLE vendaItemVenda(
  id_ItVenda varchar(4),
  id_venda varchar(4),
  PRIMARY KEY(id_ItVenda, id_venda),
  FOREIGN KEY(id_ItVenda) references itemVenda(id_produto),
  FOREIGN KEY(id_venda) references venda(id_venda)
);