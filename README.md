# Koer

Em esperanto, 'koer' [koe̥:r] significa cachorro, um dos animais domésticos mais populares no mundo.

## Objetivo
Este é um código de teste, o objetivo é demonstrar que eu sei escrever alguma coisa em PHP.
O projeto é baseado em Laravel, mas utiliza bastante conceitos de SOLID, Clean Code e
arquitetura hexagonal, mesmo que não siga exaustivamente todas as regras, a ideia é implementar
da melhor forma possível.

## Prerequisitos
+ Linux
+ docker e docker-compose
+ Um client de REST como o [Insomnia](https://insomnia.rest/)
+ Se for usar o Insomnia, pode importar o arquivo `koer_insomnia.json` que se encontra na raiz do projeto

## Funcionamento
O projeto é uma API REST que tem basicamente o cadastro de Pets e de procedimentos de Atendimento
(Pets e Attendance, respectivamente).

### Endpoints:
Presumindo que esteja rodando o projeto em localhost a URL base é `http://localhost/api/v1` e os endpoints:

    GET: /pet?page=<int>    - Retorna a lista dos pets cadastrados,
                            o parâmetro page serve para identificar a página de resultados e inicia em 0
    
    POST: /pet              - Insere um novo Pet no sistema. Esse endpoint recebe um documento no formato
                            JSON conforme o exemplo:
                            {
                            	"name": "George"
                            	"type": "C"
                            }
                            onde "name" é o nome do Pet e "type" é o tipo de animal:
                            - 'C' para cachorro
                            - 'G' para gato
    
    PUT: /pet/<int>         - Atualiza um Pet já cadastrado no sistema, identificando ele pelo parâmetro da
                            URL <int>. Esse endpoint recebe o mesmo documento do endpoint `POST /pet`
    
    DELETE: /pet/<int>      - Remove um Pet da base de dados, assim como os atendimentos fornecidos à ele.
    
    GET: /pet/<int>         - Retorna um agregado do Pet, com todos os detalhes e também a
                            lista de atendimentos pertencente à ele.

    GET: /attendance?page=<int> - Retorna a lista dos atendimentos registrado, assim como nos Pets, o parâmetro
                                `page` indica a página de resultados.

    POST: /attendance       - Insere um novo atendimento no sistema. Esse endpoint recebe um documento no
                            formato JSON conforme o exemplo:
                            {
                                "pet_id": 2,
                                "date": "2020-10-11",
                                "description": "recebeu vacina contra parvovirose"
                            }
                            onde "pet_id" é o identificador do Pet que recebeu o atendimento;
                            "date" é a data do atendimento;
                            "description" é a descrição dos procedimentos feitos no atendimento.
    
    PUT: /attendance/<int>  - Atualiza um Atendimento já cadastrado no sistema, identificando ele pelo parâmetro da
                            URL <int>. Esse endpoint recebe o mesmo documento do endpoint `POST /attendance`

    DELETE: /attendance/<int>   - Remove um Atendimento da base de dados.
    
    GET: /attendance/<int>  - Retorna um agregado do Atendimento, com detalhes e também com os dados do Pet
                            que recebeu o atendimento

## Executando
O ambiente de desenvolvimento utiliza docker para subir os seguintes serviços:
+ PHP 7.4
+ Nginx 1.19
+ Mysql 8

Basta utilizar o comando `docker-compose up --build` que o ambiente será montado para execução do sistema.

### Se não rodar de primeira:
+ Verificar se as dependências do composer foram instaladas: `composer install`
+ Verificar se o docker subiu certinho, as vezes pode conflitar com alguma porta ocupada do SO.
+ Me manda um sinal de fumaça
