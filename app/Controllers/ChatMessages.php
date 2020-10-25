<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use WebSocket\Client;

require dirname(__DIR__) . '../../vendor/autoload.php';

class ChatMessages extends BaseController {

	use ResponseTrait;

	public function index($user_id, $recipient_id) {
        try{
            $messages_model = new \App\Models\Messages_model();
            $messages = $messages_model->
            groupStart()->
                where('user_id', $user_id)->
                orWhere('recipient_id', $user_id)->
            groupEnd()->
            groupStart()->
                where('user_id', $recipient_id)->
                orWhere('recipient_id', $recipient_id)->
            groupEnd()->
            findAll();

            return $this->respond($messages, 200);

        } catch (\Exception $e) {
			// var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
	}
}
