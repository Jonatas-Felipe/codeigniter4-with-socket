<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Login extends BaseController {

	use ResponseTrait;

	public function index() {
		try{
			$validation = \Config\Services::validation();
			$validation->setRules([
				'email' => 'required',
                'password' => 'required',
			]);

			if($validation->withRequest($this->request)->run()){
				$usuarios_model = new \App\Models\Usuarios_model();
				$data = $this->request->getPost();
				$data['password'] = md5($data['password']);
				$user = $usuarios_model->where($data)->first();
				if($user){
					$session = session();
					$session->user = $user;
					return $this->respond($user, 200);
				}else{
					return $this->respond(['error' => 'E-mail ou senha inválido.'], 404);    
				}
			}else{
				return $this->respond(['error' => $validation->getErrors()], 400);
			}
		} catch (\Exception $e) {
			var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
	}

	public function create(){
		try{
            
            $validation = \Config\Services::validation();
            $validation->setRules([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            if($validation->withRequest($this->request)->run()){

                $usuarios_model = new \App\Models\Usuarios_model();

                $data = $this->request->getPost();
                $data['password'] = md5($data['password']);

                $id = $usuarios_model->insert($data);
                $user = $data;
                $user['id'] = $id;

                return $this->respond($user, 200);
            }else{
                return $this->respond(['error' => $validation->getErrors()], 400);
            }
		} catch (\Exception $e) {
			// var_dump($e);
			return $this->respond(['error' => 'Ocorreu um erro inexperado.'], 400);
		}
    }

}
