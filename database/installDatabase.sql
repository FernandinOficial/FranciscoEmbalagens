-- SQLBook: Code
-- Active: 1727386002368@@127.0.0.1@3306@phpmyadmin
-- SQLBook: Code
CREATE DATABASE FranciscoEmbalagens;

USE FranciscoEmbalagens;

-- Criando a tabela de Usuário
CREATE TABLE Usuario (
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    cpf_usu VARCHAR(11) NOT NULL,
    email_usu VARCHAR(255) NOT NULL,
    nome_usu VARCHAR(255) NOT NULL,
    senha_usu VARCHAR(255) NOT NULL
);

-- Criando a tabela de Fornecedor
CREATE TABLE Fornecedor (
    id_for INT AUTO_INCREMENT PRIMARY KEY,
    nome_for VARCHAR(255) NOT NULL,
    email_for VARCHAR(255),
    documento_for VARCHAR(50),
    data_cadastro DATE,
    bairro_for VARCHAR(255),
    cidade_for VARCHAR(255),
    cep_for VARCHAR(9),
    celular_for VARCHAR(15)
);

-- Criando a tabela de Cliente
CREATE TABLE Cliente (
    id_cli INT AUTO_INCREMENT PRIMARY KEY,
    nome_cli VARCHAR(255) NOT NULL,
    nome_social VARCHAR(255),
    documento_cli VARCHAR(50),
    tipo_documento_cli VARCHAR(20),
    data_nascimento_cli DATE,
    data_cadastro_cli DATE,
    email_cli VARCHAR(255),
    rua_cli VARCHAR(255),
    bairro_cli VARCHAR(255),
    cidade_cli VARCHAR(255),
    cep_cli VARCHAR(9),
    telefone_cli VARCHAR(15),
    uf_cli VARCHAR(2)
);

-- Criando a tabela de Produto
CREATE TABLE Produto (
    id_prod INT AUTO_INCREMENT PRIMARY KEY,
    nome_prod VARCHAR(255) NOT NULL,
    marca_prod VARCHAR(100),
    desc_prod VARCHAR(255),
    preco_compra_prod DECIMAL(10,2),
    preco_venda_prod DECIMAL(10,2),
    estoque_minimo_prod INT,
    status_prod VARCHAR(20)
);

-- Criando a tabela de Serviço
CREATE TABLE Servico (
    id_serv INT AUTO_INCREMENT PRIMARY KEY,
    nome_serv VARCHAR(255) NOT NULL,
    descricao_serv VARCHAR(255),
    preco_serv DECIMAL(10,2),
    prazo_serv INT
);

-- Criando a tabela de Ordem de Serviço
CREATE TABLE Ordem_Servico (
    id_ordem_servico INT AUTO_INCREMENT PRIMARY KEY,
    data_ordem_servico DATE NOT NULL,
    id_cli INT,
    id_usu INT,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Criando a tabela de Itens da Ordem de Serviço
CREATE TABLE Itens_os (
    id_ordem_servico INT,
    id_serv INT,
    preco_itens_os DECIMAL(10,2),
    FOREIGN KEY (id_ordem_servico) REFERENCES Ordem_Servico(id_ordem_servico),
    FOREIGN KEY (id_serv) REFERENCES Servico(id_serv)
);

-- Criando a tabela de Compra
CREATE TABLE Compra (
    id_compra INT AUTO_INCREMENT PRIMARY KEY,
    data_compra DATE NOT NULL,
    id_for INT,
    id_usu INT,
    previsao_entrega_compra DATE,
    FOREIGN KEY (id_for) REFERENCES Fornecedor(id_for),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Criando a tabela de Itens da Compra
CREATE TABLE Itens_Compra (
    id_compra INT,
    id_prod INT,
    preco DECIMAL(10,2),
    PRIMARY KEY (id_compra, id_prod),
    FOREIGN KEY (id_compra) REFERENCES Compra(id_compra),
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);

-- Criando a tabela de Pedido
CREATE TABLE Pedido (
    id_ped INT AUTO_INCREMENT PRIMARY KEY,
    data_ped DATE NOT NULL,
    endereco_entrega_ped VARCHAR(255),
    entregar_ped BOOLEAN,
    id_cli INT,
    id_usu INT,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli),
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
);

-- Criando a tabela de Itens do Pedido
CREATE TABLE Itens_Pedido (
    id_ped INT,
    id_prod INT,
    preco_itens_ped DECIMAL(10,2),
    PRIMARY KEY (id_ped, id_prod),
    FOREIGN KEY (id_ped) REFERENCES Pedido(id_ped),
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);

INSERT INTO Usuario (nome_usu, email_usu, senha_usu) VALUES ('francisco', 'francisco@gmail.com', '123');

-- O TINYINT tem a capacidade de armazenar pequenos números inteiros dentro do banco de dados.
ALTER TABLE Fornecedor ADD COLUMN ativo TINYINT(1) DEFAULT 1;
ALTER TABLE Cliente ADD COLUMN ativo TINYINT(1) DEFAULT 1;