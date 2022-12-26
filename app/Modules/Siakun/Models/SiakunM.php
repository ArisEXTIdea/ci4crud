<?php 

namespace App\Modules\Siakun\Models;

use CodeIgniter\Model;

class SiakunM extends Model{
    protected $table = 'users';
    protected $allowedFields = ['uid', 'email', 'password', 'full_name', 'address', 'gender', 'image'];


    public function save_data($data){
        $this->insert($data);
    }

    public function get_all_data(){
        return $this->findAll();
    }

    public function get_user_by($filter, $value){
        $this->where($filter, $value);
        return $this->findAll();
    }

    public function update_data($data, $uid){
        $this->set('email', $data['email']);
        $this->set('password', $data['password']);
        $this->set('full_name', $data['full_name']);
        $this->set('address', $data['address']);
        $this->set('gender', $data['gender']);
        $this->where('uid', $uid);
        $this->update();
    }

    public function update_data_image($data, $uid){
        $this->set('image', $data['image']);
        $this->where('uid', $uid);
        $this->update();
    }

    public function delete_data($uid){
        $this->where('uid', $uid);
        $this->delete();
    }
}