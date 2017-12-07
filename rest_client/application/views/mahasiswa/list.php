<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Teknik Informatika UMM">
  <meta name="author" content="REST CLIENT">
<!-- core CSS -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <script src="<?php echo base_url() ?>assets/js/jquery-1.11.0.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/dataTables.bootstrap.js"></script>
</head>
 <body>
<?php echo $this->session->flashdata('hasil'); ?>
<div class="container">
    <table id="mahasiswa" class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">NIM</th>
                <th width="15%">NAMA</th>
                <th width="15%">JURUSAN</th>
                <th width="15%">ALAMAT</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>

    <?php
    foreach ($mahasiswa as $m){
        echo "<tr>
              <td>$m->nim</td>
              <td>$m->nama</td>
              <td>$m->nama_jurusan</td>
              <td>$m->alamat</td>
              <td>".anchor('mahasiswa/edit/'.$m->nim,'Edit')."
                  ".anchor('mahasiswa/delete/'.$m->nim,'Delete')."</td>
              </tr>";
    }
    ?>

</body>