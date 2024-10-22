<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sensor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.4.0/justgage.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center">Data Sensor DHT, Suhu, dan Gas</h3>

        <div class="row">
            <!-- Gauge kelembapan -->
            <div class="col-md-4 text-center">
                <h5>Kelembapan</h5>
                <div id="gaugeKelembapan" class="gauge" style="width: 200px; height: 200px;"></div>
            </div>

            <!-- Gauge suhu -->
            <div class="col-md-4 text-center">
                <h5>Suhu</h5>
                <div id="gaugeSuhu" class="gauge" style="width: 200px; height: 200px;"></div>
            </div>

            <!-- Gauge gas -->
            <div class="col-md-4 text-center">
                <h5>Gas (ADC)</h5>
                <div id="gaugeGas" class="gauge" style="width: 200px; height: 200px;"></div>
            </div>
        </div>

        <!-- Tombol LED ON/OFF -->
        <div class="text-center mt-5">
            <h5>Status LED: <span id="ledStatus"></span></h5>
            <button id="toggleLed" class="btn btn-primary"></button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Variabel untuk menyimpan instance JustGage
        var gaugeSuhu, gaugeKelembapan, gaugeGas;

        // Fungsi untuk inisialisasi gauge
        function initGauges() {
            gaugeSuhu = new JustGage({
                id: "gaugeSuhu",
                value: 0, // Nilai awal
                min: -10,
                max: 50,
                title: "Suhu (°C)",
                levelColors: ["#ff0000", "#ffcc00", "#00ff00"],
            });

            gaugeKelembapan = new JustGage({
                id: "gaugeKelembapan",
                value: 0, // Nilai awal
                min: 0,
                max: 100,
                title: "Kelembapan (%)",
                levelColors: ["#00ff00", "#ffcc00", "#ff0000"],
            });

            gaugeGas = new JustGage({
                id: "gaugeGas",
                value: 0, // Nilai awal
                min: 0,
                max: 1024,
                title: "Gas (ADC)",
                levelColors: ["#ff0000", "#ffcc00", "#00ff00"],
            });
        }

        // Fungsi untuk mengambil data sensor
        function ambilDataSensor() {
            $.get("<?= site_url('rest/ambildatasensor') ?>", function(data) {
                var sensorData = JSON.parse(data);
                $("#ledStatus").text(sensorData.LED);
                $("#toggleLed").text((sensorData.LED == 'ON') ? "Matikan LED" : "Nyalakan LED");

                // Update nilai gauge tanpa membuat instance baru
                if (sensorData.suhu) {
                    gaugeSuhu.refresh(sensorData.suhu);
                }

                if (sensorData.kelembapan) {
                    gaugeKelembapan.refresh(sensorData.kelembapan);
                }

                if (sensorData.gas) {
                    gaugeGas.refresh(sensorData.gas);
                }
            });
        }

        // Event handler untuk tombol LED ON/OFF
        $("#toggleLed").click(function() {
            $.post("<?= site_url('rest/toggleLed') ?>", function(data) {
                var response = JSON.parse(data);
                $("#ledStatus").text(response.status);
                $("#toggleLed").text((response.status == "ON") ? "Matikan LED" : "Nyalakan LED");
            });
        });

        // Inisialisasi gauges dan ambil data sensor saat halaman dimuat
        $(document).ready(function() {
            initGauges(); // Inisialisasi gauge saat halaman dimuat
            ambilDataSensor(); // Ambil data sensor pertama kali
            setInterval(ambilDataSensor, 5000); // Refresh setiap 5 detik
        });
    </script>

</body>

</html>