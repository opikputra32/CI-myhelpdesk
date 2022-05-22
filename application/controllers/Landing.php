<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

    public function index()
    {
        $this->load->view('landing/index');
    }

    public function add_user()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
            'is_unique' => 'SIMPAN GAGAL !!.. Username sudah ada'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'List User';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $this->load->view('landing/index', $data);
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => 'User',
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1,
                'activated' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Pendaftaran');
            $this->session->set_flashdata('msg',  '<div class="alert alert-success text-center" role="alert">Silahkan Login dengan Akun yang telah dibuat</div>');
            redirect('auth');
        }
    }
}
