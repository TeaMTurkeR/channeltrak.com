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

        echo json_encode($decoded_user);
        
        $data = array(
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s')
        );

        if ($id = $this->User_model->create($data)) {
            echo json_encode($id);
        } else {
            header('HTTP', TRUE, 400);
        }

    }

    public function get() {

        if ($this->User_model->is_authed()) {

            $id = $this->session->userdata('user_id');

            $data = $this->User_model->get(array('id' => $id));

            echo json_encode($data);

        } else {

            header('HTTP', TRUE, 405);
            echo '/get unauthorized';

        }

    }

    public function update() {

        if ($this->User_model->is_authed()) {

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

        } else {

            header('HTTP', TRUE, 501);
            echo '/update unauthorized';

        }

    }

    public function auth() {

        $decoded_user = json_decode(file_get_contents('php://input'), TRUE);

        $email = $decoded_user['email'];
        $password = md5($decoded_user['password']);

        echo json_encode($decoded_user['password']);

        // if ($this->User_model->auth($email, $password)) {

        //     echo json_encode($data);

        // } else {

        //     header('HTTP', TRUE, 400);
        //     echo 'fail';

        // }

    }

}