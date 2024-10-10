#!/bin/bash

# Recebe o argumento passado
subdir="$1"

# Exibe o valor da variável
echo "Diretório: $subdir"

# Define o caminho do diretório
directory="C:/xampp/htdocs/$subdir/FranciscoEmbalagens"

# Navega até o diretório especificado
if cd "$directory"; then
    # Se o cd for bem-sucedido, executa o comando npm test
    npm test
else
    # Se o cd falhar, exibe uma mensagem de erro e sai com um código de erro
    echo "Falha ao acessar o diretório: $directory"
    exit 1
fi
