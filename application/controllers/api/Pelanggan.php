<?php 

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';



class Pelanggan extends REST_Controller{

    public function __construct(){
        parent::__construct();
        // $this->methods['index_get']['limit'] = 10;
        $this->load->model('Pelanggan_model','pelanggan');
    }
    public function index_get() {

        $id = $this->get('id_pelanggan');
        if($id === null){

            $pelanggan = $this->pelanggan->getPelanggan();
        } else{
            $pelanggan = $this->pelanggan->getPelanggan($id);
        }
        
        if($pelanggan) {
            $this->response([
                'status' => true,
                'data' => $pelanggan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete() {
        $id = $this->delete('id_pelanggan');

        if($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Provide an id !!!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->pelanggan->deletePelanggan($id) > 0 ){

                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);

            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post(){
        $data = [
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'telp' => $this->post('telp')
        ];

        if($this->pelanggan->createPelanggan($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new pelanggan created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to created new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put(){
        $id = $this->put('id_pelanggan');

        $data = [
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'telp' => $this->put('telp')
        ];

        if($this->pelanggan->updatePelanggan($data, $id) > 0) {
            $this->response([
                'status' => true,
                'id' => $id,
                'message' => 'pelanggan updated'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}