## Socket com CodeIgniter 4

Como fazer o socket funcionar:

1. Clonar o repositório e executar o comando composer para instalar as dependencias;
2. Editar a linha do arquivo app/Config/App.php para ajustar a base_url;
3. Acessar a rota iniciar-socket se estiver tudo certo ela vai ficar carregando infinitamente pode fecha lá;
4. Ajustar as configurações do banco de dados no arquivo app/Config/Datatbase.php;
5. Executar as migrations acessando a rota migrate;
6. pronto o projeto já esta funcional;

obs: Esse projeto usa Bootstrap e Jquery de maneira não muito correta, porém a forma em que ele foi feito é para focar somente mais em socket e não no layout. O socket usado é o socketo.me e para fazer disparo de mensagens pelo php foi utilizado Textalk/websocket-php.