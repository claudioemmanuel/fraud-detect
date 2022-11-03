
## 🖥 Tecnologias 
#### `Back-end`
- [Laravel](https://laravel.com/)
#### para executar a aplicação sera necessário o [Composer](https://getcomposer.org/download/) e [Docker](https://docs.docker.com/engine/install/)

## 🎴 Preparação do projetos 

É de grande importancia que todos os passos sejam seguidos corretamente em sua ordem para funcionamento do projeto

```bash
git clone https://github.com/claudioemmanuel/fraud-detect-api.git
```
```bash
cd fraud-detect-api 
```
```bash
cp .env.example .env
```
Altere as variáveis de ambiente do arquivo .env criado no passo anterior para os valores abaixo
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=stark_industries
DB_USERNAME=root
DB_PASSWORD=
```
No projeto foi utilizado o Laravel Sail (para container), na pasta do projeto execute o comando abaixo para instalação das dependências
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
Em seguida suba o container
```bash
docker-compose up
```
Entre no container
```bash
docker exec -it fraud-detect-api_laravel_1 bash
```
Execute o comando abaixo para gerar a key da aplicação 
```bash
php artisan key:generate
```
Dentro do container execute o comando abaixo para popular o banco com as informações 
```bash
php artisan migrate:fresh --seed 
```
O projeto estara rodando no endereço http://0.0.0.0:80 / http://0.0.0.0/

## ✨ Teste de fraude
**Regra**: Os  produtos  da  Stark  Industries  só  podem  ser  vendidos  para  adultos  maiores  de  21  anos  

**O problema**: Pessoas  fora  dessa  idade  tem  adulterado documentos  para  tentar  realiza  a  compra  de  seus  produtos

**Solução**: Com base na regra informada foi desenvolvido a uma lógica na qual faço o cruzamento das informações de *CPF* com a *data de nascimento do cliente* já que está havendo fraude de documentação. A regra de negócio exigida pelo teste se encontra nos arquivos ClientFactory e SaleService.

**A ideia foi construir uma *"fake api"* simulando o que seria uma consulta a base da receita federal** que, ao executar a seed para popular o banco, ela já alimenta um arquivo json para utilizarmos no teste que servirá como nossa consulta a "receita federal". Alguns dos clientes cadastrados pela seed já podem iniciar uma compra e outros já estão sendo barrados pela idade conforme manda a regra. No arquivo ***ClientService*** na linha ***47*** foi deixado o comentário *de propósito* para que seja visualizado que *seria possível barrar o cadastro de um cliente com o mesmo CPF já existente, também seria possível barrar incluindo na migration de cliente a informação de que CPF é único*, porém desta forma **não haveria como ser feito o teste de fraude**.

**O teste**: Faça o cadastro de um novo cliente com o CPF de um cliente já existente e que tenha os requisitos para iniciar uma compra, no caso, ter mais de 21 anos (rota */sales* para listagem). Ao cadastrar este novo cliente tente iniciar uma venda para ele, você não deverá conseguir pois o cliente é um possível fraudador pois o CPF informado por ele cruzado com as informações do banco da "*fake api*" (arquivo json criado ao executar a seed) aponta para outra pessoa. Poderia ser feito diversos testes cruzando as informações de quem está comprando com o verdadeiro cliente, porém foi implementado como exemplo apenas o cruzamento do CPF com a data de nascimento.

## 📙 Licença
> Com base nos termos de [MIT LICENSE](https://opensource.org/licenses/MIT)

##### Feito por Claudio Emmanuel com ❤️
