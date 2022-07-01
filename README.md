## Sobre o projeto
O projeto tem como objetivo ler um arquivo de comando de listagem de mensagens no formato AT+CMGL e após realizar o processamento retornar um JSON com o seu conteúdo.

## Pré-requisitos do projeto
Composer
PHP 8.*

## Instalação das dependencias

Para que os testes funcionem corretamente é necessário baixas as dependencias do projeto.

```bash
composer install
```

## Testes

Para executar os testes automatizados do projeto é necessário executar o seguinte comando.

```bash
.\vendor\bin\phpunit tests
```

## Executando o Parse SMS

Para realizar o processamento da lista de mensagens e visualizar o JSON, basta executar
```bash
php parse-sms.php sms-example.txt
```

O parâmetro passado será o nome do arquivo que deve ser processado, e ele deve estar na raiz do projeto.