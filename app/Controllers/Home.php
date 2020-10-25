<?php namespace App\Controllers;

require dirname(__DIR__) . '../../vendor/autoload.php';

use WebSocket\Client;

class Home extends BaseController {
	public function index() {
		$session = session(); 
		$user = $session->user;
		if($user){
			return redirect()->to(base_url('conversas')); 
		}
		return view('index', ["page" => "login"]);
	}

	public function register(){
		$session = session(); 
		$user = $session->user;
		if($user){
			return redirect()->to(base_url('conversas')); 
		}
		return view('index', ["page" => "register"]);
	}

	public function chats(){
		$session = session(); 
		$user = $session->user;
		if(!$user){
			return redirect()->to(base_url()); 
		}

		return view('index', ["page" => "chats"]);
	}

	public function chat($user_id, $id_user){
		$session = session(); 
		$user = $session->user;
		if(!$user){
			return redirect()->to(base_url()); 
		}

		$chats_model = new \App\Models\Chats_model();
		$chat = $chats_model->
            groupStart()->
                where('user_id', $user_id)->
                orWhere('id_user', $user_id)->
            groupEnd()->
            groupStart()->
                where('user_id', $id_user)->
                orWhere('id_user', $id_user)->
            groupEnd()->
			first();

		if(!$chat){
			$data = [
				"user_id" => $user_id, 
				"id_user" => $id_user
			];

			$id = $chats_model->insert($data);
		}else{
			$id = $chat->id;
		}

		$chats_model = new \App\Models\Chats_model();
		$conversa = $chats_model->
		select("user1.id as user1Id, user2.id as user2Id, user1.name as user1Name, user2.name as user2Name,")->
		join('usuario as user1', "user1.id = user_id")->
		join('usuario as user2', "user2.id = id_user")->
		where('chat.id', $id)->
		first();

		return view('index', [
			"page" => "chat",
			"user_id" => $user_id,
			"id_user" => $id_user,
			"conversa" => $conversa
		]);
	}

	public function logout(){
		$session = session(); 
		$session->destroy();
		return redirect()->to(base_url()); 
	}
}
