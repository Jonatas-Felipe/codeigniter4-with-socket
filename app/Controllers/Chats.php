<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use WebSocket\Client;

require dirname(__DIR__) . '../../vendor/autoload.php';

class Chats extends BaseController {

	use ResponseTrait;

	public function index($user_id) {
        try{
            $chats_model = new \App\Models\Chats_model();
            $chats = $chats_model->
            select("chat.id, chat.user_id, chat.id_user, user1.id as id1, user2.id as id2, user1.name as name1, user2.name as name2, message")->
            join('usuario as user1', "user1.id = chat.user_id")->
            join('usuario as user2', "user2.id = chat.id_user")->
            join('messages', 'messages.chat_id = chat.id', 'left')->
            where('chat.user_id', $user_id)->
            orWhere('chat.id_user', $user_id)->
            findAll();
            return $this->respond($chats, 200);
        } catch (\Exception $e) {
			var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
	}
}
