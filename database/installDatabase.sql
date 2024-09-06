CREATE DATABASE FranciscoEmbalagens;

USE FranciscoEmbalagens;

-- criando a tabela Cliente
CREATE TABLE Cliente (
    id_cli INT AUTO_INCREMENT PRIMARY KEY, -- Declarando id_cli como auto increment e chave primária
    nome_cli VARCHAR(50) NOT NULL,
    sobrenome_cli VARCHAR(50),
    email_cli VARCHAR(100) NOT NULL UNIQUE,
    senha_cli VARCHAR(255) NOT NULL,
    endereco_cli TEXT
);

-- OPÇÕES PARA TIPO DE PESSOA
-- pessoa fisica
CREATE TABLE Pessoa_Fisica (
    id_cli INT PRIMARY KEY,
    cpf_cli VARCHAR(11) NOT NULL UNIQUE,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
);

-- pessoa juridica
CREATE TABLE Pessoa_Juridica (
    id_cli INT PRIMARY KEY,
    cnpj_cli VARCHAR(14) NOT NULL UNIQUE,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
);

-- criando a tabela Pedido
CREATE TABLE Pedido (
    id_ped INT AUTO_INCREMENT PRIMARY KEY,
    id_cli INT NOT NULL,
    data_ped DATE NOT NULL,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
);

-- criando a tabela Produto
CREATE TABLE Produto (
    id_prod INT AUTO_INCREMENT PRIMARY KEY,
    modelo_prod VARCHAR(50) NOT NULL,
    dimensao_prod VARCHAR(50) NOT NULL,
    nome_prod VARCHAR(100) NOT NULL
);

-- criando a tabela associativa de Item_Pedido
CREATE TABLE Item_Pedido (
    id_item_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_ped INT NOT NULL,
    id_prod INT NOT NULL,
    FOREIGN KEY (id_ped) REFERENCES Pedido(id_ped),
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);

-- criando a tabela Estoque
CREATE TABLE Estoque (
    id_estoque INT AUTO_INCREMENT PRIMARY KEY,
    id_prod INT NOT NULL,
    quant_dispo INT NOT NULL,
    FOREIGN KEY (id_prod) REFERENCES Produto(id_prod)
);
