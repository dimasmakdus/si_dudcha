<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Beranda</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <?php if (session()->getFlashData('success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-door-open"></i>
        <?= session()->getFlashData('success') ?>
        </button>
      </div>
    <?php endif ?>

    <div class="row">
      <!-- <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= "Rp " . number_format(isset($terjualToday['count']) ? $terjualToday['count'] : 0, 0, ',', '.') ?></h3>

            <p><?= isset($terjualToday['title']) ? $terjualToday['title'] : null ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-money-bill-wave"></i>
          </div>
        </div>
      </div> -->
      <!-- ./col -->

      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $barangMasuk['count'] ?></h3>

            <p><?= $barangMasuk['title'] ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-truck-loading"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $keluarToday['count'] ?></h3>

            <p><?= $keluarToday['title'] ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-dolly-flatbed"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= $barangHabis['count'] ?></h3>

            <p><?= $barangHabis['title'] ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-chart-bar mr-1"></i>Grafik Pengeluaran Barang
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 350px; height: 250px; max-height: 350px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-table mr-1"></i> Barang Banyak Diminati
          </div>
          <div class="card-body">
            <table id="tbl_jual_terbanyak" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Sebanyak</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($dariBanyakTerjual as $terbanyak) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $terbanyak['nama_barang'] ?></td>
                    <td><?= $terbanyak['jumlah'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-table mr-1"></i> Barang Kurang Diminati
          </div>
          <div class="card-body">
            <table id="tbl_jual_tersedikit" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Sebanyak</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($dariSedikitTerjual as $tersedikit) : ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $tersedikit['nama_barang'] ?></td>
                    <td><?= $tersedikit['jumlah'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<!-- ChartJS -->
<script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
<script>
  //-------------
  //- BAR CHART -
  //-------------
  <?php
  $year = date("Y");
  $month = (int)date("m");

  $a = $db->query("SELECT * FROM bulan LIMIT $month");
  $b = $db->query("SELECT bulan.bulan, IFNULL(s.total, 0) AS total FROM bulan
                  LEFT JOIN (
                  SELECT YEAR(tanggal) AS tahun, MONTH(tanggal) AS tanggal, SUM(total) AS total
                  FROM tbl_penjualan_barang
                  GROUP BY MONTH(tanggal)
                  ) s ON (bulan.id = s.tanggal AND $year = s.tahun) LIMIT $month");

  $db_bulan = $db->query("SELECT * FROM bulan")->getResultArray();
  $bulan_labels = [];
  foreach ($db_bulan as $row) {
    $bulan_labels[] = $row['bulan'];
  }

  ?>
  var areaChartData = {
    labels: <?= json_encode($bulan_labels) ?>,
    datasets: [{
        label: 'Pengeluaran Barang',
        backgroundColor: '#74c8a3',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#74c8a3',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?php foreach ($b->getResult('array') as $label) {
                  echo '"' . $label['total'] . '",';
                } ?>]
      },

    ]
  }
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)
  // var temp0 = areaChartData.datasets[0]
  // var temp1 = areaChartData.datasets[1]
  // barChartData.datasets[0] = temp1
  // barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
</script>
<?= $this->endSection('content') ?>