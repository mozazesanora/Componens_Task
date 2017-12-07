<?php

require APPPATH . '/libraries/REST_Controller.php';

class mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data mahasiswa
    function index_get() {
        
        $nim = $this->get('nim');
        if ($nim == '') {
            //$mahasiswa = $this->db->get('mahasiswa')->result();
            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
            $mahasiswa = $this->db->get()->result();

        } else {
            $this->db->where('nim', $nim);

            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
            $mahasiswa = $this->db->get()->result();
            //$mahasiswa = $this->db->get('mahasiswa')->result();
        }
        $this->response($mahasiswa, 200);

    }

    // insert new data to mahasiswa
    function index_post() {
        $data = array(
                    'nim'           => $this->post('nim'),
                    'nama'          => $this->post('nama'),
                    'id_jurusan'    => $this->post('id_jurusan'),
                    'alamat'        => $this->post('alamat'));
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data mahasiswa
    function index_put() {
        $nim = $this->put('nim');
        $data = array(
                    'nim'       => $this->put('nim'),
                    'nama'      => $this->put('nama'),
                    'id_jurusan'=> $this->put('id_jurusan'),
                    'alamat'    => $this->put('alamat'));
        $this->db->where('nim', $nim);
        $update = $this->db->update('mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete mahasiswa
    function index_delete() {
        $nim = $this->delete('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('mahasiswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}