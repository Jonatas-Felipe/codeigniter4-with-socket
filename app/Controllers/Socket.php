<?php namespace App\Controllers;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

use App\Libraries\Server;

require dirname(__DIR__) . '../../vendor/autoload.php';

class Socket extends BaseController {
	public function index() {
		new Server();
	}
}
