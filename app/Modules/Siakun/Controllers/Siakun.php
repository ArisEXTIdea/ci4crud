<?php
namespace App\Modules\Siakun\Controllers;

use App\Controllers\BaseController;
use App\Modules\Siakun\Models\SiakunM;

class Siakun extends BaseController
{
    protected $SiakunM;
    protected $viewPath;
    protected $session;

    public function __construct()
    {
        $this->SiakunM = new SiakunM;
        $this->viewPath = 'App\Modules\Siakun\Views';
        $this->session = \Config\Services::session();;
    }

    // RENDER

    public function render_form_add()
    {
        $renderData = [
            'title' => 'Tambah Akun Baru | Siakun'
        ];


        return view( $this->viewPath . '\form_add', $renderData);
    }

    public function render_dashboard()
    {
        $userData = $this->SiakunM->get_all_data();

        $renderData = [
            'title' => 'Tambah Akun Baru | Siakun',
            'userData' => $userData
        ];


        return view( $this->viewPath . '\dashboard', $renderData);
    }

    public function render_user_detail()
    {
        $url = array_reverse(explode('/', $_SERVER['PHP_SELF']));
        $uid = $url[0];
        $userData = $this->SiakunM->get_user_by('uid', $uid);

        $renderData = [
            'title' => 'Tambah Akun Baru | Siakun',
            'userData' => $userData[0]
        ];


        return view( $this->viewPath . '\detail_user', $renderData);
    }

    public function render_user_edit()
    {
        $url = array_reverse(explode('/', $_SERVER['PHP_SELF']));
        $uid = $url[0];
        $userData = $this->SiakunM->get_user_by('uid', $uid);

        $renderData = [
            'title' => 'Tambah Akun Baru | Siakun',
            'userData' => $userData[0]
        ];


        return view( $this->viewPath . '\form_edit', $renderData);
    }

    public function render_user_edit_image()
    {
        $url = array_reverse(explode('/', $_SERVER['PHP_SELF']));
        $uid = $url[0];
        $userData = $this->SiakunM->get_user_by('uid', $uid);

        $renderData = [
            'title' => 'Tambah Akun Baru | Siakun',
            'userData' => $userData[0]
        ];


        return view( $this->viewPath . '\form_edit_image', $renderData);
    }


    // FUNCTION

    public function save_data_user(){
        $file = $this->request->getFile('image');
        $fileName = $file->getRandomName();
        $file->store('../../public/assets/uploads', $fileName);

        $dataToSave = [
            'uid' => 'uid-' . uniqid(),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'full_name' => $this->request->getVar('full_name'),
            'address' => $this->request->getVar('address'),
            'gender' => $this->request->getVar('gender'),
            'image' => $fileName,
        ];

        if(!$this->SiakunM->save_data($dataToSave)){
            $this->session->setFlashdata('alert-success', 'Data berhasil disimpan');
        } else {
            $this->session->setFlashdata('alert-fail', 'Data gagal disimpan');
        }

        $this->session->setFlashdata('alert', 'active');

        return redirect()->to('/tambah-akun');
     }

     public function update_data_user(){
        $uid = $this->request->getVar('uid');

        $dataToSave = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'full_name' => $this->request->getVar('full_name'),
            'address' => $this->request->getVar('address'),
            'gender' => $this->request->getVar('gender'),
        ];

        if(!$this->SiakunM->update_data($dataToSave, $uid)){
            $this->session->setFlashdata('alert-success', 'Data berhasil diupdate');
        } else {
            $this->session->setFlashdata('alert-fail', 'Data gagal diupdate');
        }

        $this->session->setFlashdata('alert', 'active');

        return redirect()->to('/detail-user' . '/' . $uid);
     }

     public function update_data_user_image(){
        $uid = $this->request->getVar('uid');

        $file = $this->request->getFile('image');
        $fileName = $file->getRandomName();
        $file->store('../../public/assets/uploads', $fileName);

        $dataToSave = [
            'image' => $fileName,
        ];

        if(!$this->SiakunM->update_data_image($dataToSave, $uid)){
            $this->session->setFlashdata('alert-success', 'Data berhasil diupdate');
            unlink('./assets/uploads' . '/' . $this->request->getVar('oldimg'));
        } else {
            $this->session->setFlashdata('alert-fail', 'Data gagal diupdate');
        }

        $this->session->setFlashdata('alert', 'active');

        return redirect()->to('/detail-user' . '/' . $uid);
     }

     public function delete_data()
    {
        $url = array_reverse(explode('/', $_SERVER['PHP_SELF']));
        $uid = $url[0];
        $userData = $this->SiakunM->get_user_by('uid', $uid);
        $image = $userData[0]['image'];
        
        if(!$this->SiakunM->delete_data($uid)){
            $this->session->setFlashdata('alert-success', 'Data berhasil diupdate');
            unlink('./assets/uploads' . '/' . $image);
        } else {
            $this->session->setFlashdata('alert-fail', 'Data gagal diupdate');
        }

        $this->session->setFlashdata('alert', 'active');

        return redirect()->to('/');

    }

}