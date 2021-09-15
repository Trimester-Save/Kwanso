<?php namespace App\Controllers;

use App\Models\PhoneModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->phoneModel = new PhoneModel();
    }

    public function index(): string
    {
        $data['totalPhones'] = $this->phoneModel->countAll();
        $data['totalUsers'] = $this->userModel->countAll();
        $data['recentPhonesAdded'] = $this->phoneModel->orderBy('id', 'DESC')->get(5)->getResultArray();
        $data['recentUsersAdded'] = $this->userModel->orderBy('id', 'DESC')->get(5)->getResultArray();
        return view('dashboard', $data);
    }

    //--------------------------------------------------------------------

}
