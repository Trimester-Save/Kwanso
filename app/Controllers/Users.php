<?php namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index(): string
    {
        $currentPage = $this->request->getVar('page_custom') ?? 1;
        $data = [
            'getAllUsers' => $this->userModel->paginate(10, 'custom'),
            'pager' => $this->userModel->pager,
            'currentPage' => $currentPage
        ];
        return view('users', $data);
    }
    //--------------------------------------------------------------------

}
