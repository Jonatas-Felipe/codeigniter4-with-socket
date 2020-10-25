<?php namespace App\Libraries;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Socket\Socket;

require dirname(__DIR__) . '../../vendor/autoload.php';

class Server {
    public function __construct() {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Socket()
                )
            ),
            8080
        );
        $server->run();
    }
}
