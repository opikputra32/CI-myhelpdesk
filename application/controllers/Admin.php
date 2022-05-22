<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_admin();
        $this->load->helper('tglindo');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Beranda';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['count_user'] = $this->admin->countJmlUser();
        $data['count_komplain_belum'] = $this->admin->countBelum();
        $data['count_komplain_proses'] = $this->admin->countProses();
        $data['count_clear'] = $this->admin->countClear();
        $data['list_komplain'] = $this->admin->getKomplain();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['count_komplain_belum'] = $this->admin->countBelum();
            $data['count_komplain_proses'] = $this->admin->countProses();
            $data['count_clear'] = $this->admin->countClear();
            $data['list_komplain'] = $this->admin->getKomplain();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/dist/img/profile';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $id_user = $this->input->post('id', true);
                    $data['mst_user'] = $this->db->get_where('mst_user', ['id' => $id_user])->row_array();
                    $old_image = $data['mst_user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/dist/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Ubah Profile Gagal !!.. Ekstensi atau ukuran file tidak sesuai</div>');
                    redirect('admin/index');
                }
            }
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $this->db->set('nama', $nama);
            $this->db->set('email', $email);
            $this->db->where('id', $id);
            $this->db->update('mst_user');
            $this->session->set_flashdata('message', 'Ubah data');
            redirect('admin/index');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password1', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['count_komplain_belum'] = $this->admin->countBelum();
            $data['count_komplain_proses'] = $this->admin->countProses();
            $data['count_clear'] = $this->admin->countClear();
            $data['list_komplain'] = $this->admin->getKomplain();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('admin/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('id', $this->session->userdata('id'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('admin/index');
            }
        }
    }

    public function list_user()
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

            $data['title'] = 'Master User';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'level' => $this->input->post('level', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1

            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Tambah user');
            redirect('admin/list_user');
        }
    }

    public function edit_user()
    {
        echo json_encode($this->admin->getUserEdit($_POST['id']));
    }

    public function proses_edit_user()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $level = $this->input->post('level');
        $is_active = $this->input->post('is_active');

        $this->db->set('nama', $nama);
        $this->db->set('email', $email);
        $this->db->set('level', $level);
        $this->db->set('is_active', $is_active);

        $this->db->where('id', $id);
        $this->db->update('mst_user');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_user');
    }

    public function del_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mst_user');
        $this->session->set_flashdata('message', 'Hapus user');
        redirect('admin/list_user');
    }


    public function list_member()
    {
        $data['title'] = 'Daftar Client';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['list_member'] = $this->db->get('mst_client')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/list_member', $data);
        $this->load->view('templates/footer');
    }

    public function list_komplain()
    {
        $data['title'] = 'List Komplain';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['list_komplain'] = $this->admin->getKomplain();
        $data['client'] = $this->db->get('mst_client')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/list_komplain', $data);
        $this->load->view('templates/footer');
    }

    public function add_komplain()
    {
        $this->form_validation->set_rules('client', 'Nama Client', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'List Komplain';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_komplain'] = $this->admin->getKomplain();
            $data['client'] = $this->db->get('mst_client')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_komplain', $data);
            $this->load->view('templates/footer');
        } else {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']     = '2048';
            $config['upload_path'] = './assets/images/';
            $this->load->library('upload', $config);
            $new_image = $this->upload->data('file_name');
            $sess_id = $this->session->userdata('id');
            $data = array(
                'area_keluhan' => $this->input->post('area_keluhan', true),
                'client' => $this->input->post('client', true),
                'saran' => $this->input->post('saran', true),
                'date_komplain' => $this->input->post('date_komplain', true),
                'jam_komplain' => $this->input->post('jam_komplain', true),
                'sess_id' => $sess_id,
                'status_komplain' => 1,
                'status_selesai' => 1,
                'image_komplain' => $new_image
            );
            $this->db->insert('tb_komplain', $data);
            $this->session->set_flashdata('message', 'Kirim data');
            redirect('admin/list_komplain');
        }
    }

    public function get_edit_komplain()
    {
        echo json_encode($this->admin->getEditKomplain($_POST['id_komplain']));
    }

    public function edit_komplain()
    {
        $this->form_validation->set_rules('id_komplain', 'id_komplain', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Komplain';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_komplain'] = $this->admin->getKomplain();
            $data['client'] = $this->db->get('mst_client')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_komplain', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $id_komplain = $this->input->post('id_komplain', true);
                    $data['komplain'] = $this->db->get_where('tb_komplain', ['id_komplain' => $id_komplain])->row_array();
                    $old_image = $data['komplain']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/images/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_tanggapan', $new_image);
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Update Gagal !!.. Ekstensi atau ukuran file tidak sesuai</div>');
                    redirect('admin/list_komplain');
                }
            }
            $id_komplain = $this->input->post('id_komplain', true);
            $area_keluhan = $this->input->post('area_keluhan', true);
            $client = $this->input->post('client', true);
            $saran = $this->input->post('saran', true);
            $date_komplain = $this->input->post('date_komplain', true);
            $jam_komplain = $this->input->post('jam_komplain', true);
            $tgl_tanggapan = $this->input->post('tgl_tanggapan', true);
            $jam_tanggapan = $this->input->post('jam_tanggapan', true);
            $tanggapan = $this->input->post('tanggapan', true);
            $status_komplain = $this->input->post('status_komplain', true);
            $this->db->set('area_keluhan', $area_keluhan);
            $this->db->set('client', $client);
            $this->db->set('saran', $saran);
            $this->db->set('date_komplain', $date_komplain);
            $this->db->set('jam_komplain', $jam_komplain);
            $this->db->set('tanggapan', $tanggapan);
            $this->db->set('tgl_tanggapan', $tgl_tanggapan);
            $this->db->set('jam_tanggapan', $jam_tanggapan);
            $this->db->set('status_komplain', $status_komplain);
            $this->db->where('id_komplain', $id_komplain);
            $this->db->update('tb_komplain');
            $this->session->set_flashdata('message', 'Ubah data');
            redirect('admin/list_komplain');
        }
    }

    public function del_komplain($id_komplain)
    {
        $_id = $this->db->get_where('tb_komplain', ['id_komplain' => $id_komplain])->row();
        $query = $this->db->delete('tb_komplain', ['id_komplain' => $id_komplain]);
        if ($query) {
            unlink("assets/images/" . $_id->image);
        }
        $this->session->set_flashdata('message', 'Hapus data');
        redirect('admin/list_komplain');
    }

    public function list_client()
    {
        $this->form_validation->set_rules('nama_client', 'Nama Client', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Master Client';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_client'] = $this->db->get('mst_client')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/list_client', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_client' => $this->input->post('nama_client', true),
                'alamat' => $this->input->post('alamat', true),
                'kontak_person' => $this->input->post('kontak_person', true),
                'no_hp' => $this->input->post('no_hp', true),
                'email_client' => $this->input->post('email_client', true)
            );
            $this->db->insert('mst_client', $data);
            $this->session->set_flashdata('message', 'Tambah client');
            redirect('admin/list_client');
        }
    }

    public function get_client()
    {
        $id_client = $_POST['id_client'];
        echo json_encode($this->db->get_where('mst_client', ['id_client' => $id_client])->row_array());
    }

    public function edit_client()
    {
        $id_client = $this->input->post('id_client');
        $nama_client = $this->input->post('nama_client');
        $alamat = $this->input->post('alamat');
        $kontak_person = $this->input->post('kontak_person');
        $no_hp = $this->input->post('no_hp');
        $email_client = $this->input->post('email_client');

        $this->db->set('nama_client', $nama_client);
        $this->db->set('alamat', $alamat);
        $this->db->set('kontak_person', $kontak_person);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('email_client', $email_client);

        $this->db->where('id_client', $id_client);
        $this->db->update('mst_client');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/list_client');
    }

    public function del_client($id_client)
    {
        $this->db->where('id_client', $id_client);
        $this->db->delete('mst_client');
        $this->session->set_flashdata('message', 'Hapus user');
        redirect('admin/list_client');
    }



    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['list_komplain'] = $this->admin->getKomplainSudah();
        $data['client'] = $this->db->get('mst_client')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function detail_komplain($id_komplain)
    {
        $data['title'] = 'Detail Komplain';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->admin->getDetailKomplain($id_komplain);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }


    public function cetak_bulan()
    {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $client = $_POST['client'];

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(56, 4, 'Laporan Komplain dan Keluhan ', 0, 0);
        if ($bulan == 1) :
            $pdf->Cell(30, 4, 'Januari', 0, 1);
        elseif ($bulan == 2) :
            $pdf->Cell(30, 4, 'Februari', 0, 1);
        elseif ($bulan == 3) :
            $pdf->Cell(30, 4, 'Maret', 0, 1);
        elseif ($bulan == 4) :
            $pdf->Cell(30, 4, 'April', 0, 1);
        elseif ($bulan == 5) :
            $pdf->Cell(30, 4, 'Mei', 0, 1);
        elseif ($bulan == 4) :
            $pdf->Cell(30, 4, 'Juni', 0, 1);
        elseif ($bulan == 7) :
            $pdf->Cell(30, 4, 'Juli', 0, 1);
        elseif ($bulan == 8) :
            $pdf->Cell(30, 4, 'Agustus', 0, 1);
        elseif ($bulan == 9) :
            $pdf->Cell(30, 4, 'September', 0, 1);
        elseif ($bulan == 10) :
            $pdf->Cell(30, 4, 'Oktober', 0, 1);
        elseif ($bulan == 11) :
            $pdf->Cell(30, 4, 'November', 0, 1);
        elseif ($bulan == 12) :
            $pdf->Cell(30, 4, 'Desember', 0, 1);
        else :
            $pdf->Cell(100, 4, 'NULL', 0, 1);
        endif;
        $pdf->Cell(100, 4, 'Tahun ' . $tahun, 0, 1);
        $pdf->Cell(100, 2, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(6, 6, '#', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Operator', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Nama Klien', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Keluhan', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Tgl.Kompl', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Penyelesaian', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Keterangan', 1, 1, 'C');

        $pdf->SetFont('Times', '', 10);
        $client = $this->admin->getCetakBulan($bulan, $tahun, $client);
        $i = 1;
        foreach ($client as $p) {
            $pdf->Cell(6, 6, $i++, 1, 0);
            $pdf->Cell(30, 6, $p['nama'], 1, 0);
            $pdf->Cell(60, 6, $p['client'], 1, 0);
            $pdf->Cell(50, 6, $p['area_keluhan'], 1, 0);
            $pdf->Cell(20, 6, $p['date_komplain'], 1, 0);
            $pdf->Cell(65, 6, $p['tanggapan'], 1, 0);
            $pdf->Cell(40, 6, '', 1, 1);

            // if ($p['jaminan_pulang'] == 1) :
            //     $pdf->Cell(20, 6, 'Jaminan', 1, 1);
            // elseif ($p['jaminan_pulang'] == 2) :
            //     $pdf->Cell(20, 6, 'Penolakan', 1, 1);
            // else :
            //     $pdf->Cell(20, 6, 'NULL', 1, 1);
            // endif;
        }
        $pdf->Output();
    }

    public function cetak_tanggal()
    {
        $tanggal = $_POST['tanggal'];

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(56, 4, 'Laporan Komplain dan Keluhan ', 0, 1);
        $pdf->Cell(30, 6, format_indo($tanggal), 0, 1);
        $pdf->Cell(100, 2, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(6, 6, '#', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Operator', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Nama Klien', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Keluhan', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Tgl.Kompl', 1, 0, 'C');
        $pdf->Cell(65, 6, 'Penyelesaian', 1, 0, 'C');
        $pdf->Cell(40, 6, 'Keterangan', 1, 1, 'C');

        $pdf->SetFont('Times', '', 10);
        $client = $this->admin->getCetakTanggal($tanggal);
        $i = 1;
        foreach ($client as $p) {
            $pdf->Cell(6, 6, $i++, 1, 0);
            $pdf->Cell(30, 6, $p['nama'], 1, 0);
            $pdf->Cell(60, 6, $p['client'], 1, 0);
            $pdf->Cell(50, 6, $p['area_keluhan'], 1, 0);
            $pdf->Cell(20, 6, $p['date_komplain'], 1, 0);
            $pdf->Cell(65, 6, $p['tanggapan'], 1, 0);
            $pdf->Cell(40, 6, '', 1, 1);
        }
        $pdf->Output();
    }

    // public function cetak_client()
    // {
    //     $client = $_POST['client'];

    //     $this->load->library('pdf');
    //     $pdf = new FPDF('l', 'mm', 'A4');
    //     $pdf->AddPage();
    //     $pdf->SetFont('Times', 'B', 11);
    //     $pdf->Cell(56, 4, 'Laporan Komplain dan Keluhan ', 0, 1);
    //     $pdf->Cell(30, 6, $client, 0, 1);
    //     $pdf->Cell(100, 2, '', 0, 1);
    //     $pdf->SetFont('Times', 'B', 10);
    //     $pdf->Cell(6, 6, '#', 1, 0, 'C');
    //     $pdf->Cell(60, 6, 'User', 1, 0, 'C');
    //     $pdf->Cell(60, 6, 'Area Keluhan', 1, 0, 'C');
    //     $pdf->Cell(60, 6, 'Nama Klien', 1, 0, 'C');
    //     $pdf->Cell(20, 6, 'Tgl.Kompl', 1, 0, 'C');
    //     $pdf->Cell(20, 6, 'Jam Kompl', 1, 0, 'C');
    //     $pdf->Cell(20, 6, 'Tgl.Tangg', 1, 0, 'C');
    //     $pdf->Cell(20, 6, 'jam.Tangg', 1, 1, 'C');

    //     $pdf->SetFont('Times', '', 10);
    //     $client = $this->admin->getCetakClient($client);
    //     $i = 1;
    //     foreach ($client as $p) {
    //         $pdf->Cell(6, 6, $i++, 1, 0);
    //         $pdf->Cell(60, 6, $p['nama'], 1, 0);
    //         $pdf->Cell(60, 6, $p['area_keluhan'], 1, 0);
    //         $pdf->Cell(60, 6, $p['client'], 1, 0);
    //         $pdf->Cell(20, 6, $p['date_komplain'], 1, 0);
    //         $pdf->Cell(20, 6, $p['jam_komplain'], 1, 0);
    //         $pdf->Cell(20, 6, $p['tgl_tanggapan'], 1, 0);
    //         $pdf->Cell(20, 6, $p['jam_tanggapan'], 1, 1);
    //     }
    //     $pdf->Output();
    // }
}
