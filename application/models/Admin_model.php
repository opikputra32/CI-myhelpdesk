<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{
	public function countJmlUser()
	{

		$query = $this->db->query(
			"SELECT COUNT(id) as user
                               FROM mst_user"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->user;
		} else {
			return 0;
		}
	}

	public function countBelum()
	{
		$query = $this->db->query(
			"SELECT COUNT(status_komplain) as belum
                               FROM tb_komplain
                               WHERE status_komplain = 1"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->belum;
		} else {
			return 0;
		}
	}
	public function countAdmin()
	{
		$query = $this->db->query(
			"SELECT COUNT(id) as isProses
                               FROM mst_user
                               WHERE level = 'Admin'"
		);

		return $query->result_array();
	}

	public function countProses()
	{
		$query = $this->db->query(
			"SELECT COUNT(status_komplain) as proses
                               FROM tb_komplain
                               WHERE status_komplain = 2"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->proses;
		} else {
			return 0;
		}
	}

	public function countClear()
	{
		$query = $this->db->query(
			"SELECT COUNT(status_komplain) as selesai
                               FROM tb_komplain
                               WHERE status_komplain = 0"
		);
		if ($query->num_rows() > 0) {
			return $query->row()->selesai;
		} else {
			return 0;
		}
	}

	public function getUserEdit($id)
	{
		$query = $this->db->get_where('mst_user', ['id' => $id])->row_array();
		return $query;
	}

	public function getMember()
	{
		$query = "SELECT *
                  FROM mst_member
                  LEFT JOIN mst_user
                  ON mst_member.sess_id = mst_user.id              
                ";
		return $this->db->query($query)->result_array();
	}

	public function getKomplain()
	{
		$query = "SELECT *
                  FROM tb_komplain
                  LEFT JOIN mst_member
                  ON tb_komplain.sess_id = mst_member.sess_id   
                  LEFT JOIN mst_user
                  ON mst_user.id = tb_komplain.sess_id
                  WHERE tb_komplain.status_komplain = 1 OR tb_komplain.status_komplain = 2        
                ";
		return $this->db->query($query)->result_array();
	}

	public function getKomplainSudah()
	{
		$query = "SELECT *
                  FROM tb_komplain
                  LEFT JOIN mst_member
                  ON tb_komplain.sess_id = mst_member.sess_id   
                  LEFT JOIN mst_user
                  ON mst_user.id = tb_komplain.sess_id
                  WHERE tb_komplain.status_komplain = 0         
                ";
		return $this->db->query($query)->result_array();
	}

	public function getEditKomplain($id_komplain)
	{
		$query = $this->db->get_where('tb_komplain', ['id_komplain' => $id_komplain])->row_array();
		return $query;
	}

	public function getCetakBulan($bulan, $tahun)
	{
		$query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE month(date_komplain)='$bulan' AND year(date_komplain)='$tahun'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
		return $query->result_array();
	}

	public function getCetakTanggal($tanggal)
	{
		$query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE tb_komplain.date_komplain = '$tanggal'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
		return $query->result_array();
	}
	public function getDetailKomplain($id_komplain)
	{
		$query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE tb_komplain.id_komplain = '$id_komplain'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
		return $query->Row_array();
	}
}
