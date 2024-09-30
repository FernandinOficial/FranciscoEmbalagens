-- Active: 1727726254369@@localhost@3306
-- SQLBook: Code
CREATE DATABASE FranciscoEmbalagens;

-- Tabela Cliente
CREATE TABLE FranciscoEmbalagens.Cliente (
    id_cli INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    data_cadastro_cli DATETIME,
    nome_cli VARCHAR(100) NOT NULL,
    nome_social VARCHAR(100),
    email_cli VARCHAR(100) NOT NULL,
    telefone_cli VARCHAR(20),
    celular_cli VARCHAR(20),
    data_nascimento DATE,
    tipo_do_documento_cli VARCHAR(50) NOT NULL,
    documento_cli VARCHAR(50) NOT NULL,
    uf VARCHAR(2) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(100),
    cep VARCHAR(10),
    status_cli VARCHAR(20) NOT NULL
);

-- Tabela Usuario
CREATE TABLE FranciscoEmbalagens.Usuario (
    id_usu INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_usu VARCHAR(100) NOT NULL,
    email_usu VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    CPF VARCHAR(14) NOT NULL
);

-- Tabela Fornecedor
CREATE TABLE FranciscoEmbalagens.Fornecedor (
    id_for INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    data_cadastro_for DATETIME,
    nome_for VARCHAR(100) NOT NULL,
    email_for VARCHAR(100) NOT NULL,
    telefone_for VARCHAR(20),
    celular_for VARCHAR(20),
    tipo_do_documento_for VARCHAR(50) NOT NULL,
    documento_for VARCHAR(50) NOT NULL,
    uf VARCHAR(2) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    status_for VARCHAR(20) NOT NULL
);

-- Tabela Produto
CREATE TABLE FranciscoEmbalagens.Produto (
    id_prod INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_prod VARCHAR(100) NOT NULL,
    desc_prod VARCHAR(255),
    marca VARCHAR(100) NOT NULL,
    preco_compra DECIMAL(10,2) NOT NULL,
    preco_venda DECIMAL(10,2) NOT NULL,
    estoque_minimo INT NOT NULL,
    status_prod VARCHAR(20) NOT NULL
);

-- Tabela Servico
CREATE TABLE FranciscoEmbalagens.Servico (
    id_serv INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome_serv VARCHAR(100) NOT NULL,
    desc_serv VARCHAR(255),
    prazo_serv DATETIME NOT NULL,
    preco_serv DECIMAL(10,2),
    status_serv VARCHAR(20) NOT NULL
);

-- Tabela Items_os
CREATE TABLE FranciscoEmbalagens.Items_os (
    id_ordem INT,
    id_serv INT,
    preco_items_os DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_serv) REFERENCES Servico(id_serv)
);

-- Tabela Ordem_servico
CREATE TABLE FranciscoEmbalagens.Ordem_servico (
    id_ordem INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_cli INT,
    id_usu INT,
    data_ordem_servico DATETIME NOT NULL,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Tabela Compra
CREATE TABLE FranciscoEmbalagens.Compra (
    id_compra INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    data_compra DATETIME NOT NULL,
    id_for INT,
    id_usu INT,
    prev_entrega DATETIME NOT NULL,
    data_entrega_efetiva DATETIME NOT NULL,
    FOREIGN KEY (id_for) REFERENCES Fornecedor(id_for),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Tabela Items_compra
CREATE TABLE FranciscoEmbalagens.Items_compra (
    id_compra INT,
    id_prod INT,
    preco_items_compra DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_compra) REFERENCES Compra(id_compra),
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);

-- Tabela Pedido
CREATE TABLE FranciscoEmbalagens.Pedido (
    id_ped INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    data_ped DATETIME NOT NULL,
    id_cli INT,
    id_usu INT,
    endereco_entrega VARCHAR(255) NOT NULL,
    data_entrega_ped DATETIME NOT NULL,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Tabela Items_pedido
CREATE TABLE FranciscoEmbalagens.Items_pedido (
    id_ped INT,
    id_prod INT,
    preco_vendido DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_ped) REFERENCES Pedido(id_ped),
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);