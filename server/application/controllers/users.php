<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index() {

        $data = $this->User_model->get(array('id >' => 0));

        echo json_encode($data);

    }

    public function create() {

        $decoded_user = json_decode(file_get_contents('php://input'), TRUE);

        $email = $decoded_user['email'];
        $password = md5($decoded_user['password']);
        
        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($id = $this->User_model->create($data)) {
            echo json_encode($id);
        } else {
            header('HTTP', TRUE, 401);
        }

    }

    public function get($id) {

        $data = $this->User_model->get(array('id' => $id));

        echo json_encode($data);

    }

    public function update() {

        $decoded_user = json_decode(file_get_contents('php://input'), TRUE);

        $email = $decoded_user['email'];
        $password = md5($decoded_user['password']);
        
        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($this->User_model->update($data)) {
            // RETRUN SOMETHING HERE
        } else {
            header('HTTP', TRUE, 401);
        }

    }

}