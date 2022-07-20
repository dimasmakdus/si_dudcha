<?= $this->extend('templates/adminlte_template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tampilkan Laporan Barang Masuk</h5>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="form-group">
                            <label>Periode</label>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="start_date" class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                                <h5 class="mt-1"> s/d </h5>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="end_date" class="form-control" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-olive" name="report">Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($reqGet['report'])) {
            $start_date = $reqGet["start_date"];
            $end_date = $reqGet["end_date"];
        ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-warning" href="<?= base_url('cetak-lbm') . '?start_date=' . $start_date . '&end_date=' . $end_date . '&report=' ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                    <div class="card-body">
                        <p>
                            <center>
                                <strong style="font-size:20px">DUDCHA</strong><br>
                                Jl. Dipatiukur. Bandung<br>
                                HP. 0813-2281-5963
                            </center>
                        </p>
                        <hr>
                        <p>
                            <center>
                                <strong>LAPORAN BARANG MASUK</strong><br>
                                Periode : <?= date("d-m-Y", strtotime($start_date)) . " s/d " . date("d-m-Y", strtotime($end_date)); ?>
                            </center>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $barang = $db->query("SELECT tbl_pembelian_detail.*, tbl_supplier.nama_supplier, tbl_barang.nama_barang, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_barang ON tbl_pembelian_detail.kode_barang = tbl_barang.kode_barang
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                LEFT JOIN tbl_supplier ON tbl_pembelian.kode_supplier = tbl_supplier.kode_supplier
                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                ORDER BY tanggal ASC");

                                    $totalHarga = 0;
                                    $subTotal = 0;
                                    $i = 1;
                                    ?>
                                    <?php foreach ($barang->getResult('array') as $row) : ?>
                                        <tr>
                                            <td align="center"><?= $i++ ?></td>
                                            <td align="center"><?= $row['faktur'] ?></td>
                                            <td align="center"><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                                            <td><?= $row['nama_supplier'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td align="right"><?= $row['stok_beli'] ?></td>
                                            <td align="right"><?= "Rp " . number_format($row['harga_beli'], 0, ',', '.') ?></td>
                                            <td align="right"><?= "Rp " . number_format($row['harga_beli'] * $row['stok_beli'], 0, ',', '.') ?></td>
                                        </tr>
                                        <?php $totalHarga = $totalHarga + $row['harga_beli'] ?>
                                        <?php $subTotal = $subTotal + ($row['harga_beli'] * $row['stok_beli']) ?>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <?php if ($barang->getResult('array') == []) { ?>
                                        <tr class="odd">
                                            <td valign="top" colspan="8" class="text-center">No data available in table</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php
                                        $hitung = $db->query("SELECT SUM(tbl_pembelian_detail.stok_beli) qty, total, tbl_pembelian.tanggal
                                                FROM tbl_pembelian_detail
                                                LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                WHERE tanggal > '$start_date' OR tanggal < '$end_date'");
                                        ?>
                                        <?php foreach ($hitung->getResult('array') as $row) : ?>
                                            <tr>
                                                <td colspan="5" align="center"><strong>Total</strong></td>
                                                <td align="right"><strong><?= $row['qty'] ?></strong></td>
                                                <td align="right"><strong><?= "Rp " . number_format($totalHarga, 0, ',', '.') ?></strong></td>
                                                <td align="right"><strong><?= "Rp " . number_format($subTotal, 0, ',', '.') ?></strong></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                </tfoot>
                            </table><br>
                            <label for="">Keterangan Pengemasan:</label>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th>Nama Barang</th>
                                            <th>Jumlah Pembelian</th>
                                            <th>Satuan Pembelian</th>
                                            <th>Nilai/Satuan</th>
                                            <th>Jumlah Yang Masuk</th>
                                            <th>Satuan Yang Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $brg = $db->query("SELECT SUM(tbl_pembelian_detail.stok_beli) stok_beli, SUM(tbl_pembelian_detail.stok_masuk) stok_masuk, tbl_barang.nama_barang, tbl_barang.nilai_satuan, tbl_barang.satuan AS satuan_pemesanan, tbl_satuan_barang.satuan_barang_name, tbl_pembelian.total, tbl_pembelian.faktur, tbl_pembelian.tanggal
                                                        FROM tbl_pembelian_detail
                                                        LEFT JOIN tbl_satuan_barang ON tbl_satuan_barang.satuan_barang_id = tbl_pembelian_detail.satuan_barang_id
                                                        LEFT JOIN tbl_barang ON tbl_pembelian_detail.kode_barang = tbl_barang.kode_barang
                                                        LEFT JOIN tbl_pembelian ON tbl_pembelian_detail.id_pembelian = tbl_pembelian.id
                                                        WHERE tanggal > '$start_date' OR tanggal < '$end_date'
                                                        GROUP BY tbl_pembelian_detail.kode_barang");

                                        ?>
                                        <?php if ($brg->getResult('array') == []) : ?>
                                            <tr class="odd">
                                                <td valign="top" colspan="3" class="text-center">No data available in table</td>
                                            </tr>
                                        <?php endif ?>
                                        <?php foreach ($brg->getResult('array') as $row) : ?>
                                            <tr>
                                                <td><?= $row['nama_barang'] ?></td>
                                                <td align="right"><?= $row['stok_beli'] ?></td>
                                                <td align="center"><?= $row['satuan_barang_name'] ?></td>
                                                <td align="right"><?= $row['nilai_satuan'] ?></td>
                                                <td align="right"><?= $row['stok_masuk'] ?></td>
                                                <td align="center">
                                                    <?php
                                                    $db      = \Config\Database::connect();
                                                    $builder = $db->table('tbl_satuan_barang')
                                                        ->select('satuan_barang_name AS satuan_pemesanan')
                                                        ->where('satuan_barang_id', $row['satuan_pemesanan'])
                                                        ->get()->getResult('array')[0];
                                                    ?>
                                                    <?= $builder['satuan_pemesanan'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <table width="100%">
                                <tr>
                                    <td width="80%"></td>
                                    <td>Kepala Gudang,</td>
                                </tr>
                                <tr style="line-height: 74px;">
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>________________</td>
                                </tr>
                            </table><br><br>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        <?php } ?>
</section>
<!-- /.content -->
<?= $this->include('templates/script') ?>
<?= $this->endSection('content') ?>