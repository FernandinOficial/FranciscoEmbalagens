CREATE DATABASE FranciscoEmbalagens;

USE FranciscoEmbalagens;

-- criando a tabela Cliente
CREATE TABLE Cliente (
    id_cli INT AUTO_INCREMENT PRIMARY KEY, -- Declarando id_cli como auto increment e chave primária
    nome_cli VARCHAR(50) NOT NULL,
    sobrenome_cli VARCHAR(50),
    email_cli VARCHAR(100) NOT NULL UNIQUE,
    senha_cli VARCHAR(255) NOT NULL,
    cpf_cli VARCHAR(11) NOT NULL,
    rua VARCHAR(255),
    numero VARCHAR(10),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
);

CREATE TABLE Servico (
    id_serv INT AUTO_INCREMENT PRIMARY KEY,
    id_cli INT NOT NULL,
    desc_serv VARCHAR(255),
    valor_serv DECIMAL(10, 2),
    data_serv DATE,
    prazo_serv DATE,
    FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
);

-- -- OPÇÕES PARA TIPO DE PESSOA
-- -- pessoa fisica
-- CREATE TABLE Pessoa_Fisica (
--     id_cli INT PRIMARY KEY,
--     cpf_cli VARCHAR(11) NOT NULL UNIQUE,
--     FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
-- );

-- -- pessoa juridica
-- CREATE TABLE Pessoa_Juridica (
--     id_cli INT PRIMARY KEY,
--     cnpj_cli VARCHAR(14) NOT NULL UNIQUE,
--     FOREIGN KEY (id_cli) REFERENCES Cliente(id_cli)
-- );

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

CREATE TABLE Fornecedor (
    id_for INT AUTO_INCREMENT PRIMARY KEY,
    nome_for VARCHAR(50) NOT NULL,
    cnpj VARCHAR(18) NOT NULL UNIQUE,
    rua VARCHAR(255),
    numero VARCHAR(10),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    email_for VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Usuario (
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    nome_usu VARCHAR(50),
    email_usu VARCHAR(255) NOT NULL UNIQUE,
    senha_usu VARCHAR(255) NOT NULL
);