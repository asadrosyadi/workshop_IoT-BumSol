<?php
class Rest extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Sensor_model');
	}

	// Fungsi untuk menampilkan tampilan utama
	public function index()
	{
		$this->load->view('sensor_view'); // Pastikan nama file view sesuai
	}


	public function kirimdatasensor()
	{
		$this->db->select('*')->from('sensor')->get()->row()->id;
		$isi = array(

			'suhu'     => $_GET['suhu'],
			'kelembapan'     => $_GET['kelembapan'],
			'gas'     => $_GET['gas']

		);
		$this->db->insert('sensor', $isi);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo "gagal";
		} else {
			echo "sukses";
		}
	}


	function bacajason()
	{
		$data = $this->db->select('*')->from('kontrol')->limit(1)->order_by('id', 'DESC')->get()->result();
		$response = array("Data" => array());
		foreach ($data as $r) {
			$temp = array(
				"LED" => $r->LED
			);

			array_push($response["Data"], $temp);
		}
		$data = json_encode($response);
		echo "$data";
	}

	// Mengambil data sensor terbaru
	public function ambildatasensor()
	{
		$data = $this->Sensor_model->getLatestSensorData(); // Ambil data sensor terbaru
		echo json_encode($data); // Kembalikan data dalam format JSON
	}

	// Mengubah status LED
	public function toggleLed()
	{
		$currentStatus = $this->Sensor_model->getLedStatus();
		$newStatus = ($currentStatus == 'ON') ? 'OFF' : 'ON'; // Ganti status
		$this->Sensor_model->updateLedStatus($newStatus);
		echo json_encode(array('status' => $newStatus)); // Kembalikan status baru dalam bentuk JSON
	}
}
