<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		is_user();
		$this->load->helper('tglindo');
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['list_komplain'] = $this->user->getKomplainAll();
		$data['count_user'] = $this->user->countJmlUser();
		$data['count_komplain_belum'] = $this->user->countBelum();
		$data['count_komplain_proses'] = $this->user->countProses();
		$data['count_clear'] = $this->user->countClear();
		// var_dump($data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_user', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit_profile()
	{
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_komplain'] = $this->db->get_where('tb_komplain', ['status_komplain' => 1])->result_array();
			$data['count_user'] = $this->user->countJmlUser();
			$data['count_komplain_belum'] = $this->user->countBelum();
			$data['count_komplain_proses'] = $this->user->countProses();
			$data['count_clear'] = $this->user->countClear();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('user/index', $data);
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
					redirect('user/index');
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
			redirect('user/index');
		}
	}

	public function ubah_password()
	{
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password1', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_komplain'] = $this->db->get_where('tb_komplain', ['status_komplain' => 1])->result_array();
			$data['count_user'] = $this->user->countJmlUser();
			$data['count_komplain_belum'] = $this->user->countBelum();
			$data['count_komplain_proses'] = $this->user->countProses();
			$data['count_clear'] = $this->user->countClear();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if ($current_password == $new_password) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
				redirect('user/index');
			} else {
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('id', $this->session->userdata('id'));
				$this->db->update('mst_user');
				$this->session->set_flashdata('message', 'Ubah password');
				redirect('user/index');
			}
		}
	}

	public function add_komplain()
	{
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_komplain'] = $this->db->get_where('tb_komplain', ['status_komplain' => 1])->result_array();
			$data['count_user'] = $this->user->countJmlUser();
			$data['count_komplain_belum'] = $this->user->countBelum();
			$data['count_komplain_proses'] = $this->user->countProses();
			$data['count_clear'] = $this->user->countClear();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		} else {
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/images/';
			$this->load->library('upload', $config);
			$this->upload->do_upload('image');
			$new_image = $this->upload->data('file_name');;
			$sess_id = $this->session->userdata('id');
			$data = array(
				'area_keluhan' => $this->input->post('area_keluhan', true),
				'jabatan' => $this->input->post('jabatan', true),
				'date_komplain' => $this->input->post('date_komplain', true),
				'jam_komplain' => $this->input->post('jam_komplain', true),
				'sess_id' => $sess_id,
				'status_komplain' => 1,
				'status_selesai' => 1,
				'image_komplain' => $new_image
			);
			var_dump($data);

			$this->db->insert('tb_komplain', $data);
			$this->session->set_flashdata('message', 'Kirim data');
			redirect('user/index');
		}
	}

	public function get_edit_komplain()
	{
		echo json_encode($this->user->getEditKomplain($_POST['id_komplain']));
	}

	public function edit_komplain()
	{
		$this->form_validation->set_rules('id_komplain', 'id_komplain', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
			$data['list_komplain'] = $this->user->getKomplainAll();
			$data['count_user'] = $this->user->countJmlUser();
			$data['count_komplain_belum'] = $this->user->countBelum();
			$data['count_komplain_proses'] = $this->user->countProses();
			$data['count_clear'] = $this->user->countClear();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_user', $data);
			$this->load->view('user/index', $data);
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
						unlink(FCPATH . './assets/images/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image_komplain', $new_image);
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Update Gagal !!.. Ekstensi atau ukuran file tidak sesuai</div>');
					redirect('user/index');
				}
			}
			$id_komplain = $this->input->post('id_komplain', true);
			$area_keluhan = $this->input->post('area_keluhan', true);
			$saran = $this->input->post('saran', true);
			$date_komplain = $this->input->post('date_komplain', true);
			$jam_komplain = $this->input->post('jam_komplain', true);
			$this->db->set('area_keluhan', $area_keluhan);
			$this->db->set('saran', $saran);
			$this->db->set('date_komplain', $date_komplain);
			$this->db->set('jam_komplain', $jam_komplain);
			$this->db->where('id_komplain', $id_komplain);
			$this->db->update('tb_komplain');
			$this->session->set_flashdata('message', 'Ubah data');
			redirect('user/index');
		}
	}

	public function del_komplain($id_komplain)
	{
		$_id = $this->db->get_where('tb_komplain', ['id_komplain' => $id_komplain])->row();
		$query = $this->db->delete('tb_komplain', ['id_komplain' => $id_komplain]);
		if ($query) {
			unlink("./assets/images/" . $_id->image);
		}
		$this->session->set_flashdata('message', 'Hapus data');
		redirect('user/index');
	}

	public function laporan()
	{

		$data['title'] = 'Laporan Saya';
		$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['list_komplain'] = $this->db->get_where('tb_komplain', ['sess_id' => $this->session->userdata('id')])->result_array();
		// var_dump($data['list_komplain']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_user', $data);
		$this->load->view('user/laporan', $data);
		$this->load->view('templates/footer');
	}

	public function status_selesai()
	{
		$sess_proses = $this->session->userdata('nama');
		$id_komplain = $this->input->post('id_komplain');
		$status_selesai = 0;
		$this->db->set('status_selesai', $status_selesai);
		$this->db->set('sess_proses', $sess_proses);
		$this->db->where('id_komplain', $id_komplain);
		$this->db->update('tb_komplain');
		$this->session->set_flashdata('message', 'Simpan data');
		redirect('user/index');
	}

	public function detail($id_komplain)
	{
		$data['title'] = 'Detail Komplain';
		$data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['detail'] = $this->user->getDetailKomplain($id_komplain);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_user', $data);
		$this->load->view('user/detail', $data);
		$this->load->view('templates/footer');
	}


	public function cetak_bulan()
	{
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		$this->load->library('pdf');
		$pdf = new FPDF('l', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', 'B', 11);
		$pdf->Cell(56, 4, 'Laporan Komplain dan Keluhan ', 0, 1);
		$pdf->Cell(12, 4, 'Bulan ', 0, 0);
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
		elseif ($bulan == 6) :
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
		$pdf->Cell(6, 6, 'No', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Operator', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Keluhan', 1, 0, 'C');
		$pdf->Cell(20, 6, 'Tgl.Kompl', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Penyelesaian', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Keterangan', 1, 1, 'C');

		$pdf->SetFont('Times', '', 10);
		$data = $this->user->getCetakBulan($bulan, $tahun);
		$i = 1;

		if (count($data) > 0) {
			foreach ($data as $p) {
				$pdf->Cell(6, 6, $i++, 1, 0);
				$pdf->Cell(30, 6, $p['nama'], 1, 0);
				$pdf->Cell(50, 6, $p['area_keluhan'], 1, 0);
				$pdf->Cell(20, 6, $p['date_komplain'], 1, 0);
				$pdf->Cell(65, 6, $p['tanggapan'], 1, 0);
				$pdf->Cell(40, 6, '', 1, 1);
			}
			$pdf->Output();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Data tidak ditemukan</div>');
			redirect('user/laporan');
		}
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
		$pdf->Cell(6, 6, 'No', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Operator', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Keluhan', 1, 0, 'C');
		$pdf->Cell(20, 6, 'Tgl.Kompl', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Penyelesaian', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Keterangan', 1, 1, 'C');

		$pdf->SetFont('Times', '', 10);
		$data = $this->user->getCetakTanggal($tanggal);
		$i = 1;

		if (count($data) > 0) {
			foreach ($data as $p) {
				$pdf->Cell(6, 6, $i++, 1, 0);
				$pdf->Cell(30, 6, $p['nama'], 1, 0);
				$pdf->Cell(50, 6, $p['area_keluhan'], 1, 0);
				$pdf->Cell(20, 6, $p['date_komplain'], 1, 0);
				$pdf->Cell(65, 6, $p['tanggapan'], 1, 0);
				$pdf->Cell(40, 6, '', 1, 1);
			}
			$pdf->Output();
		} else {

			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Data tidak ditemukan</div>');
			redirect('user/laporan');
		}
	}
}
