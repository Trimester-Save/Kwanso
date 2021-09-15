<?php

namespace App\Controllers;

use App\Models\AppModel;
use App\Models\PhoneModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;
use Config\Services;

class Api extends ResourceController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->phoneModel = new PhoneModel();
        $this->AppModel = new AppModel();
    }

    public function signup()
    {
        $val = $this->validate([
            'full_name' => ['label' => 'Full Name', 'rules' => 'required'],
            'email' => ['label' => 'Email Address', 'rules' => 'required|valid_email|is_unique[users.email]'],
            'phone' => ['label' => 'Phone Number', 'rules' => 'required|valid_phone_number'],
            'password' => ['rules' => 'required|is_lower|is_upper|is_number|min_length[8]|max_length[32]'],
        ]);
        if (!$val) {
            $fields = array('full_name', 'email', 'phone', 'password');
            foreach ($fields as $field) {
                if (!empty(Services::validation()->getError($field))) {
                    return $this->fail(['status' => false, 'message' => Services::validation()->getError($field)]);
                }
            }
        } else {
            $post = $this->request->getVar();
            $data = [
                'full_name' => $post['full_name'],
                'email' => $post['email'],
                'phone' => $post['phone'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT)
            ];
            $this->userModel->insert($data);
            return $this->respond(['status' => true, 'message' => 'success', 'response' => 'success']);
        }
    }

    public function login()
    {
        $val = $this->validate([
            'email' => ['label' => 'Email Address', 'rules' => 'required'],
            'password' => ['label' => 'Password', 'rules' => 'required'],
        ]);
        if (!$val) {
            $fields = array('email', 'password');
            foreach ($fields as $field) {
                if (!empty(Services::validation()->getError($field))) {
                    return $this->fail(['status' => false, 'message' => Services::validation()->getError($field)]);
                }
            }
        } else {
            $post = $this->request->getVar();
            $getUser = $this->userModel->get_row(['email' => $post['email']]);
            if (isset($getUser)) {
                $verifyPassword = password_verify($post['password'], $getUser['password']);
                if ($verifyPassword) {
                    unset($getUser['password']);
                    return $this->respond(['status' => true, 'response' => $getUser]);
                } else {
                    return $this->fail(['status' => false, 'message' => 'Your password wrong please check your password']);
                }

            } else {
                return $this->fail(['status' => false, 'message' => 'Your email does not exists in our system']);
            }
        }
    }

    public function update_user()
    {
        $val = $this->validate([
            'uid' => ['rules' => 'required'],
        ]);
        if (!$val) {
            if (!empty(Services::validation()->getError('uid'))) {
                return $this->fail(['status' => false, 'message' => Services::validation()->getError('uid')]);
            }
        } else {
            $post = $this->request->getVar();
            $getUserInformation = $this->userModel->find($post['uid']);
            if (isset($getUserInformation)) {
                $this->userModel->update($getUserInformation['id'], $post);
                return $this->respond(['status' => true, 'message' => 'success', 'response' => 'success']);
            } else {
                return $this->respond(['status' => false, 'message' => 'uid not exists in our system']);
            }
        }
    }

    public function RegisterPhone()
    {
        $val = $this->validate([
            'phone_no' => ['label' => 'Phone Number', 'rules' => 'required|valid_phone_number|is_unique[phone_register.phone_no]'],
        ]);
        if (!$val) {
            if (!empty(Services::validation()->getError('phone_no'))) {
                return $this->fail(['status' => false, 'message' => Services::validation()->getError('phone_no')]);
            }
        } else {
            $this->phoneModel->insert(['phone_no' => $this->request->getVar('phone_no')]);
            return $this->respond(['status' => true, 'message' => 'success', 'response' => 'success']);
        }
    }

    public function checkIn()
    {
        if (!empty($_POST)) {
            if (empty($_POST['uid'])) {
                return $this->fail(['status' => false, 'message' => 'uid required']);
            }
            if (empty($_POST['appt_id'])) {
                return $this->fail(['status' => false, 'message' => 'appt_id required']);
            }
            if ($this->AppModel->getCheckin($_POST['uid'], $_POST['appt_id']) == 0) {
                if ($response = $this->AppModel->CheckIn($_POST)) {
                    return $this->respond(['status' => true, 'message' => 'successfully checked-in', 'response' => 'success']);
                } else
                    return $this->respond(['status' => true, 'message' => 'failed to Check-in', 'response' => array()]);
            } else {
                return $this->fail(['status' => false, 'message' => 'Patient Already Checked-in']);
            }

        }
    }

    public function isCheckedIn()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if (empty($_POST['uid'])) {
                return $this->fail(['status' => false, 'message' => 'uid required']);
            }
            $response = $this->AppModel->isCheckedIn();
            return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
        } else {
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
        }
    }

    public function viewProfile()
    {
        if (!empty($_POST)) {
            if ($response = $this->AppModel->getAppointment($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->respond(['status' => true, 'message' => 'failed', 'response' => array()]);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    //===============**************================//
    public function getAppointment()
    {
        if (!empty($_POST)) {
            if (empty($_POST['uid'])) {
                return $this->fail(['status' => false, 'message' => 'uid required']);
            }
            if ($response = $this->AppModel->getAppointment($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->respond(['status' => true, 'message' => 'failed', 'response' => array()]);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    //===============**************================//
    public function getMessages()
    {
        if (empty($_POST['uid'])) {
            return $this->fail(['status' => false, 'message' => 'uid required']);
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($response = $this->AppModel->get_messages($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->respond(['status' => true, 'message' => 'failed', 'response' => array()]);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    public function getAds()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($response = $this->AppModel->getAds()) {
                $response->image = base_url() . "assets/uploads/" . $response->image;
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->respond(['status' => true, 'message' => 'no active ads']);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    //===============**************================//
    public function getWifi()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($response = $this->AppModel->getWifi()) {
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->fail(['status' => false, 'message' => 'failed', 'response' => array()]);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

//===============**************================//
    public function getReplies()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($response = $this->AppModel->getReplies($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful', 'response' => $response]);
            } else
                return $this->fail(['status' => false, 'message' => 'failed', 'response' => array()]);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    public function sendReply()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($response = $this->AppModel->reply($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful']);
            } else
                return $this->respond(['status' => true, 'message' => 'failed']);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    public function forgotPassword()
    {
        if (!empty($_POST)) {
            if ($this->AppModel->getemail($_POST['email']) > 0) {
                if ($response = $this->AppModel->forget_password($_POST)) {
                    return $this->respond(['status' => true, 'message' => 'successful']);
                } else {
                    return $this->fail(['status' => false, 'message' => 'failed']);
                }
            } else {
                return $this->fail(['status' => false, 'message' => 'email does not exist']);
            }
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }

    //===============**************================//
    public function changePassword()
    {
        if (!empty($_POST)) {
            if ($response = $this->AppModel->change_password($_POST)) {
                return $this->respond(['status' => true, 'message' => 'successful']);
            } else
                return $this->fail(['status' => false, 'message' => 'Check your password']);
        } else
            return $this->fail(['status' => false, 'message' => 'Method is not allowed']);
    }
}
