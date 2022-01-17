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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form class="form-horizontal" id="sendEmail">
    <?= csrf_field(); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kirim Email ke Supplier</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Akun Gmail</label>
                                <div class="col-sm-10">
                                    <small><i>Masukkan email dan password pada akun Gmail.</i></small>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="abcd@gmail.com" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="************" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pengirim" id="pengirim" value="PUSKESMAS CIMAUNG" required>
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label for="email_supplier" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="email_supplier" id="email_supplier" style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih --</option>
                                        <?php foreach ($data_supplier as $supplier) : ?>
                                            <option value="<?= $supplier['email'] ?>"><?= $supplier['nama_supplier'] ?> - <?= $supplier['email'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Masukkan subject email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="msg" class="col-sm-2 col-form-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea id="summernote"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputFile" class="col-sm-2 col-form-label">Upload File</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="uploadFile" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih file....</label>
                                        </div>
                                    </div>
                                    <small>Tipe file hanya <i>JPG/JPEG/PNG</i> dan <i>PDF</i>. Maksimal file 512kb</small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer justify-content-between">
                            <button type="button" class="btn bg-olive btn-submit"><i class="fas fa-paper-plane"></i> Submit</button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-redo-alt"></i> Reset</a>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</form>

<?= $this->include('templates/script') ?>
<script>
    if (document.readyState == 'loading') {
        document.addEventListener('DOMContentLoaded', ready);
    } else {
        ready();
    }

    function ready() {
        document.getElementsByClassName('btn-submit')[0].addEventListener('click', submitClick);
    }

    function submitClick(e) {
        e.preventDefault();
        var supplier = $('select[name=email_supplier] option').filter(':selected').val();

        console.log(supplier);
        if (supplier != '') {
            var url = "<?= base_url('kirim-email'); ?>";
            var form = $('#sendEmail').serialize();
            console.log(form);
            $.ajax({
                type: "POST",
                url: url,
                data: form,
                success: function(res) {
                    switch (res) {
                        case 'success':
                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil di simpan!',
                                'success'
                            )
                            break;
                        case 'error':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Pilih obat terlebih dahulu!',
                                'error'
                            )
                            break;
                        case 'empty_dosis':
                            Swal.fire(
                                'Tidak Bisa!',
                                'Pilih dosis terlebih dahulu!',
                                'error'
                            )
                            break;
                    }
                },
                error: function(error) {
                    Swal.fire(
                        'Gagal!',
                        'Data gagal di simpan!',
                        'error'
                    )
                }
            });
        } else {
            // if (supplier == '') {
            //     Swal.fire(
            //         'Tidak Bisa!',
            //         'Pilih data pasien terlebih dahulu!',
            //         'error'
            //     )
            // }
        }
    }
</script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
</script>
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
<?= $this->endSection('content') ?>