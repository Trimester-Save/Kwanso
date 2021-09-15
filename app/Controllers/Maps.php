<?php namespace App\Controllers;

use App\Models\UsersModel;

class Maps extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index(): string
    {
        return view('maps');
    }

    public function getAllUsers()
    {
        $getAll = $this->userModel->get_all();
        if (isset($getAll)):foreach ($getAll as $key => $user):
            $getAll[$key]['timeFormat'] = getTimeDetails($user['updated']);
            $getAll[$key]['speed'] = round($user['speed']);
        endforeach;endif;
        echo json_encode($getAll);
    }
    //--------------------------------------------------------------------

}
