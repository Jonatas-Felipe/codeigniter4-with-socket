<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use WebSocket\Client;

require dirname(__DIR__) . '../../vendor/autoload.php';

class OtherUsers extends BaseController {

	use ResponseTrait;

	public function index($user_id) {
        try{
            $usuarios_model = new \App\Models\Usuarios_model();
            $users = $usuarios_model->
            where('id !=', $user_id)->
            findAll();
            return $this->respond($users, 200);
        } catch (\Exception $e) {
			var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
	}
}
