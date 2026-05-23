<!-- PAGE CONTENT-->
        <div class="page-content--bgf7">  
            <!-- DATA TABLE-->
            <section class="p-t-60">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <h3 class="title-5 m-b-35">data warga</h3>
                                </div>
                                <div class="table-data__tool-right">
                                    <!-- Tombol Import CSV -->
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#importModal">
                                        <i class="zmdi zmdi-file-text"></i>import csv</button>
                                        
                                    <!-- Tombol Tambah Warga -->
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addWarga">
                                        <i class="zmdi zmdi-plus"></i>warga</button>
                                        
                                    <!-- Tombol Print -->
                                    <a href="<?= base_url();?>warga/lapwarga" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                        <i class="zmdi zmdi-print"></i>print</a>
                                </div>
                            </div>
                            
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th width="50px">No</th>
                                            <th>NIK</th>
                                            <th>nama</th>
                                            <th>jenis kelamin</th>
                                            <th>tgl lahir</th>
                                            <th>alamat</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1; // Variabel angka urut mulai dari 1
                                        foreach($warga as $val):?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $val->nik;?></td>
                                            <td><?= $val->nama;?></td>
                                            <td><?= $val->jekel;?></td>
                                            <td class="process"><?= $val->tempat_lahir;?>, <?= date('d-m-Y', strtotime($val->tanggal_lahir));?></td>
                                            <td><?= $val->alamat;?></td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="modal" data-target="#editWarga<?= $val->idWarga;?>" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" title="Delete">
                                                        <a href="#!" onclick="deleteConfirm('<?= base_url('warga/delWarga/'. $val->idWarga);?>')" >
                                                            <i class="zmdi zmdi-delete" style="color:red"></i></a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>
                </div>
            </section>

            <!-- MODAL IMPORT CSV -->
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="importModalLabel">Import Data Warga via CSV</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/import_csv'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="alert alert-info">
                                    <small>Format kolom CSV: <b>NIK, Nama, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Alamat</b></small>
                                </div>
                                <div class="form-group">
                                    <label>Pilih File CSV</label>
                                    <input type="file" name="file_csv" class="form-control" accept=".csv" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Upload & Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL ADD WARGA -->
            <div class="modal fade" id="addWarga" tabindex="-1" role="dialog" aria-labelledby="addWargaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addWargaLabel">Tambah Warga</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('warga/addwarga');?>" method="post">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" type="text" name="nik" placeholder="NIK Warga" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="nama" placeholder="Nama Warga" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jekel">
                                        <option value="">Pilih ...</option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT WARGA -->
            <?php foreach($warga as $val): ?>
            <div class="modal fade" id="editWarga<?= $val->idWarga;?>" tabindex="-1" role="dialog" aria-labelledby="editWargaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Warga</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= form_open_multipart('warga/editwarga');?>
                                <input type="hidden" name="idWarga" value="<?= $val->idWarga;?>" >
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" type="text" name="nik" value="<?= $val->nik;?>" >
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="nama" value="<?= $val->nama;?>" >
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jekel">
                                        <option value="<?= $val->jekel;?>"><?= $val->jekel;?></option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" value="<?= $val->tempat_lahir;?>" >
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir" value="<?=$val->tanggal_lahir;?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat"><?=$val->alamat;?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>