<div class="page-content--bgf7">
    <section class="p-t-30">
        <div class="container">
            <?= $this->session->flashdata('message'); ?>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card text-white" style="border-radius: 14px; border: none; background: linear-gradient(135deg, #6a11cb, #2575fc);">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-cloud-upload-alt fa-3x mr-4" style="opacity: 0.7;"></i>
                            <div>
                                <h4 class="text-white">Backup & Sinkronisasi Data</h4>
                                <p class="mb-0" style="opacity: 0.85;">Backup database lokal dan sinkronisasi kode ke GitHub Repository <strong>shadiqzx/E-KASRT</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Card: Backup Database -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="border-radius: 14px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.07);">
                        <div class="card-body text-center py-5">
                            <div style="width: 70px; height: 70px; background: #E8F5E9; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-database fa-2x text-success"></i>
                            </div>
                            <h5>Backup Database Lokal</h5>
                            <p class="text-muted" style="font-size: 13px;">Buat file <strong>kasrt_backup.sql</strong> dari database aktif dan simpan ke folder <code>database/</code> dalam proyek.</p>
                            <a href="<?= base_url('smartrt/backup_db'); ?>" class="btn btn-success" style="border-radius: 8px;">
                                <i class="fas fa-download mr-2"></i>Jalankan Backup
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Push GitHub -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100" style="border-radius: 14px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.07);">
                        <div class="card-body text-center py-5">
                            <div style="width: 70px; height: 70px; background: #EDE7F6; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-github fa-2x" style="color: #6a11cb;"></i>
                            </div>
                            <h5>Sinkronisasi ke GitHub</h5>
                            <p class="text-muted" style="font-size: 13px;">Upload seluruh file proyek ke repository <strong>shadiqzx/E-KASRT</strong>. Memerlukan Personal Access Token dari GitHub.</p>
                            
                            <?php if ($github_configured): ?>
                                <a href="<?= base_url('smartrt/backup_github'); ?>" class="btn btn-primary" style="border-radius: 8px; background: #6a11cb; border: none;">
                                    <i class="fab fa-github mr-2"></i>Push ke GitHub
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled title="Token belum dikonfigurasi" style="border-radius: 8px;">
                                    <i class="fab fa-github mr-2"></i>Push ke GitHub
                                </button>
                                <p class="text-warning mt-2" style="font-size: 12px;"><i class="fas fa-exclamation-triangle mr-1"></i>Token GitHub belum dikonfigurasi.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GitHub Config Card -->
            <div class="card mb-4" style="border-radius: 14px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.07);">
                <div class="card-header bg-light" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0"><i class="fas fa-key mr-2"></i>Konfigurasi GitHub Token</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted" style="font-size: 13px;">
                        Untuk push ke GitHub, Anda memerlukan Personal Access Token (PAT). 
                        <a href="https://github.com/settings/tokens/new" target="_blank">Buat token baru di sini</a> dengan scope <code>repo</code>.
                    </p>
                    <form action="<?= base_url('smartrt/backup_save_token'); ?>" method="post">
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <div class="form-group mb-0">
                                    <label>GitHub Personal Access Token (PAT)</label>
                                    <input type="text" name="github_token" class="form-control" 
                                           placeholder="ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxx"
                                           value="<?= $github_token ? str_repeat('*', max(0, strlen($github_token) - 8)) . substr($github_token, -8) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-dark btn-block" style="border-radius: 8px;">
                                    <i class="fas fa-save mr-2"></i>Simpan Token
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Backup History -->
            <div class="card" style="border-radius: 14px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.07);">
                <div class="card-header bg-light" style="border-radius: 14px 14px 0 0;">
                    <h5 class="mb-0"><i class="fas fa-history mr-2"></i>Riwayat Backup</h5>
                </div>
                <div class="card-body">
                    <?php
                    $backup_file = FCPATH . 'database/kasrt_backup.sql';
                    if (file_exists($backup_file)):
                        $size = round(filesize($backup_file) / 1024, 1);
                        $mtime = date('d-m-Y H:i:s', filemtime($backup_file));
                    ?>
                        <div class="d-flex align-items-center p-3" style="background: #F1F8E9; border-radius: 10px;">
                            <i class="fas fa-file-code fa-2x text-success mr-3"></i>
                            <div class="flex-grow-1">
                                <strong>kasrt_backup.sql</strong><br>
                                <small class="text-muted">Ukuran: <?= $size; ?> KB &nbsp;|&nbsp; Terakhir diperbarui: <?= $mtime; ?></small>
                            </div>
                            <a href="<?= base_url('smartrt/backup_download'); ?>" class="btn btn-sm btn-success ml-3" style="border-radius: 8px;">
                                <i class="fas fa-download mr-1"></i>Download
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-3">Belum ada file backup. Klik <strong>Jalankan Backup</strong> untuk membuat backup pertama.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
</div>
