<?php
class Sensor_model extends CI_Model
{
    // Mengambil data sensor terbaru
    public function getLatestSensorData()
    {
        return $this->db->select('suhu, kelembapan, gas')
            ->from('sensor')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()
            ->row_array();
    }

    // Mengambil status LED
    public function getLedStatus()
    {
        return $this->db->select('LED')
            ->from('kontrol')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()
            ->row()
            ->LED;
    }

    // Mengubah status LED
    public function updateLedStatus($newStatus)
    {
        $this->db->update('kontrol', array('LED' => $newStatus), array('id' => 1)); // Asumsi kita hanya mengupdate id tertentu
    }
}
