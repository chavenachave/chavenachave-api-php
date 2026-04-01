# API de Integração - Chavenachave v1.2 🚗🔑



Este repositório contém os exemplos oficiais e a documentação técnica para integração de estoque com o portal Chavenachave. 



O objetivo desta API é permitir que lojistas e revendedores automatizem o envio, atualização e remoção de veículos em nosso marketplace de forma escalável.



Documentação completa em https://chavenachave.com.br/doc-api/

\---



## 🚀 Funcionalidades Suportadas



* Cadastrar/Atualizar Veículos (POST): Sincronização completa de dados técnicos, opcionais, procedência e fotos.

* Consulta de Estoque (GET): Recuperação de todos os anúncios ativos vinculados à conta.

* Remoção de Anúncios (DELETE): Desativação imediata de veículos vendidos via ID de referência interna.



## 🛠️ Tecnologias Utilizadas



* Linguagem: PHP (Exemplos compatíveis com v7.4 ou superior)

* Comunicação: cURL com suporte a métodos HTTP (POST, GET, DELETE)

* Formato de Dados: JSON (UTF-8)

* Autenticação: Bearer Token via Header HTTP



\---



## 📦 Como Utilizar



1.  Obter Token: Acesse o seu painel no Chavenachave e gere seu token de acesso exclusivo.

2.  Configurar o Exemplo: Abra o arquivo `teste-api.php` e insira o seu token na variável `$token`.

3.  Executar Testes: Alterne a variável `$acao\_teste` para validar cada endpoint da API.



### Exemplo Rápido (POST)

```php

$dados = \[

 "codigo_referencia" => "SEU_ID_REFERENCIA_DO_VEICULO",

 "marca" => "VW - Volkswagen",

 "modelo" => "Golf GTI",

 "valor" => "285000.00",

 "fotos" => ["[https://link-da-sua-foto.jpg](https://link-da-sua-foto.jpg)"]

];

// Veja o arquivo completo em /examples/teste-api.php

