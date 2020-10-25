<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use WebSocket\Client;

require dirname(__DIR__) . '../../vendor/autoload.php';

class Messages extends BaseController {

	use ResponseTrait;

	public function create($user_id, $recipient_id){
		try{
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'message' => 'required',
            ]);

            if($validation->withRequest($this->request)->run()){

                $messages_model = new \App\Models\Messages_model();

                $data = $this->request->getPost();
                $data['user_id'] = $user_id;
                $data['recipient_id'] = $recipient_id;

                $id = $messages_model->insert($data);
                $message = $data;
                $message['id'] = $id;

                $msgSocket = json_encode($message);

                $client = new Client("ws://127.0.0.1:8080");
			    $client->send($msgSocket);

                return $this->respond($message, 200);
            }else{
                return $this->respond(['error' => $validation->getErrors()], 400);
            }
		} catch (\Exception $e) {
			// var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
    }

}
