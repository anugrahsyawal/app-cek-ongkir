<?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 3e98598a092c949fedd9539e3b149360"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    // echo $response;
    $data = json_decode($response);
    // echo "<pre>"; print_r($data); echo "</pre>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>My First Ongkos Kirim App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Link CSS Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Link CSS custom -->
  <style>
      .jumbotron {
    padding: 2rem 1rem;
    margin-bottom: 2rem;
    background-color: #e9ecef;
    border-radius: 0.3rem;
  }
  .jumbotron h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }
  .jumbotron p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
  }


    h1, h2, h3, h4, h5, h6 {
      color: #000;
      text-shadow: 0 0 1px #ccc;
    }

    .form-control {
      border-radius: 20px;
      border: none;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
    }

    select.form-control {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url('https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-arrow-down-512.png');
      background-repeat: no-repeat;
      background-position: right center;
      background-size: 20px;
      padding-right: 30px;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border-radius: 20px;
      border: none;
      padding: 10px 25px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #0069d9;
    }

  </style>
</head>
<body>

<div class="jumbotron text-center">
  <h1>My First Ongkos Kirim App</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h3>Kota Asal</h3>
      <p>Pilih Provinsi</p>
      <select class="form-control" name="provinsi_asal" onchange="cariKotaAsal(this.value)">
        <option>-- Pilih Provinsi --</option>
        <?php
            foreach($data->rajaongkir->results as $provinsi){
                echo '<option value="'.$provinsi->province_id.'">'.$provinsi->province.'</option>';
            }
        ?>
      </select>
      <br>
      <p>Pilih Kota Asal</p>
      <select class="form-control" id="kota_asal" name="kota_asal">
        <option>-- Pilih Kota --</option>
        
      </select>
      <br><br>
      <h3>Kota Tujuan</h3>
      <p>Pilih Provinsi</p>
      <select class="form-control" name="provinsi_tujuan" onchange="cariKotaTujuan(this.value)">
        <option>-- Pilih Provinsi --</option>
        <?php
            foreach($data->rajaongkir->results as $provinsi){
                echo '<option value="'.$provinsi->province_id.'">'.$provinsi->province.'</option>';
            }
        ?>
      </select>
      <br>
      <p>Pilih Kota Tujuan</p>
      <select class="form-control" id="kota_tujuan" name="kota_tujuan">
        <option>-- Pilih Kota --</option>
        
      </select>
      <br>
    </div>
    <div class="col-md-6">
      <h3>Berat & Kurir</h3>        
      <p>Berat Paket (gram) : </p>
        <input id="berat_paket" class="form-control" type="text" name="berat_paket">
      <br>
      <p>Pilih Kurir : </p>
        <select class="form-control" name="kurir" id="kurir">
          <option value="jne">JNE</option>
          <option value="tiki">TIKI</option>
          <option value="pos">POS Indonesia</option>
        </select>
      <br><br>
      <div class="col-dm-6">
        <label style="font-size: 1.9em; font-weight: bold; font-family: 'calibri'; display: inline-block; margin-right: 20px;">Cek Ongkos Kirim</label>
        <label class="col-dm-3 float-right">
        <input type="submit" name="cari" value="Cek Ongkir" onclick="cekOngkir()" class="btn btn-primary" style="padding: 10px 20px; font-size: 18px; font-weight: bold;">
        </label>
      <div id="hasil_cek_ongkir"></div><hr>
      </div>

    </div>
  </div>
</div>

<script>
  function cariKotaAsal(id_provinsi){
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function() {
      document.getElementById("kota_asal").innerHTML = this.responseText;
    }
    xmlhttp.open("GET", "http://localhost/app-cek-ongkir/req-cari-kota.php?id_provinsi="+id_provinsi, true);
    xmlhttp.send();
  }

  function cariKotaTujuan(id_provinsi){
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function() {
      document.getElementById("kota_tujuan").innerHTML = this.responseText;
    }
    xmlhttp.open("GET", "http://localhost/app-cek-ongkir/req-cari-kota.php?id_provinsi="+id_provinsi, true);
    xmlhttp.send();
  }

  function cekOngkir(){
    var id_kota_asal = document.getElementById("kota_asal").value;
    var id_kota_tujuan = document.getElementById("kota_tujuan").value;
    var berat_paket = document.getElementById("berat_paket").value;
    var kurir = document.getElementById("kurir").value;

    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = function() {
      document.getElementById("hasil_cek_ongkir").innerHTML = this.responseText;
    }
    xmlhttp.open("GET", `http://localhost/app-cek-ongkir/req-ongkir.php?id_kota_asal=${id_kota_asal}&id_kota_tujuan=${id_kota_tujuan}&berat_paket=${berat_paket}&kurir=${kurir}`, true);
    xmlhttp.send();
  }
</script>

</body>
</html>
