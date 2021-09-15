<?php namespace App\Controllers;

use App\Models\SuperadminModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Login extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->superadminModel = new SuperadminModel();
        $this->parser = Services::parser();
    }

    public function index(): string
    {
        return view('login');
    }

    public function checkLogin()
    {
        $val = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (!$val) {
            return view('login');
        } else {
            $post = $this->request->getVar();
            $getDetails = getRow(['email' => $post['email']], 'super_admin');
            if (isset($getDetails)) {
                $verifyPassword = password_verify($post['password'], $getDetails['password']);
                if (!$verifyPassword) {
                    $this->session->setFlashdata('error', "Invalid Password");
                    return redirect('login');
                }
                $data = array(
                    'superadmin' => array(
                        'id' => $getDetails['id'],
                        'full_name' => $getDetails['fname'],
                        'email' => $getDetails['email'],
                        'superadmin_logged_in' => 1,
                    ));
                $this->session->set($data);
                return redirect('home');
            } else {
                $this->session->setFlashdata('error', "Email or Password is Incorrect");
                return redirect('login');
            }
        }
    }

    public function logout(): RedirectResponse
    {
        $this->session->remove('user');
        return redirect('login');
    }

    public function forgot_password(): string
    {
        return view('forgot_password');
    }

    public function forgot_password_link_generate(): RedirectResponse
    {
        if (empty($this->request->getVar('email'))) {
            $this->session->setFlashdata('error', "Please enter email address");
            return redirect()->to(base_url('login/forgot_password'));
        }
        $getSuperadminDetails = getRow(['email' => $this->request->getVar('email')], 'super_admin');
        if (isset($getSuperadminDetails)) {
            $reset_token = generateUuidToken();
            try {
                $this->superadminModel->update(1, ['reset_token' => $reset_token]);
            } catch (\ReflectionException $e) {
            }

            $data = [
                'site_logo' => base_url('assets/images/ic_launcher-playstore.png'),
                'full_name' => $getSuperadminDetails['fname'],
                'year' => date('Y'),
                'reset_link' => base_url('login/resetPassword/' . $getSuperadminDetails['email'] . '/' . $reset_token)
            ];
            $htmlContent = $this->parser->setData($data)->render('forgot_password_template');

            if (email_sent($getSuperadminDetails['email'], 'Reset password- KWANSO', $htmlContent)) {
                $this->session->setFlashdata('success', "Password reset instructions are sent to your email address.");
                return redirect()->to(base_url('login/forgot_password'));
            } else {
                $this->session->setFlashdata('error', "Something went wrong. Please try again after sometime");
                return redirect()->to(base_url('login/forgot_password'));
            }
        } else {
            $this->session->setFlashdata('error', "Email address does not exists in our system. Please check you email");
            return redirect()->to(base_url('login/forgot_password'));
        }
    }

    public function new_password(): string
    {
        return view('new_password');
    }

    public function change_password()
    {
        $val = $this->validate([
            'password' => ['label' => 'New password', 'rules' => 'required|is_lower|is_upper|is_number|min_length[8]|max_length[32]'],
            'confirm_pwd' => ['label' => 'Confirm password', 'rules' => 'required|matches[password]']
        ]);
        if (!$val) {
            return view('new_password', ['validation' => $this->validator]);
        } else {
            try {
                $this->superadminModel->update(['id' => 1], ['password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT), 'reset_token' => NULL]);
            } catch (\ReflectionException $e) {
            }
            $this->session->setFlashdata('success', "Password updated successfully.");
            return redirect()->to(base_url('login'));
        }
    }
    //--------------------------------------------------------------------

}
