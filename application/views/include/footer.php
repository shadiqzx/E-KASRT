		<!-- modal changePasswordModal -->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="changePasswordModal">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="login-form">
							<form action="<?= base_url('auth/changePassword');?>" method="post">
								<input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id'];?>" >
								<div class="form-group">
									<label>Current Password</label>
									<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
								</div>
								<div class="form-group">
									<label for="new_password1">New Password</label>
									<input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="New Password" required>
								</div>
								<div class="form-group">
									<label for="new_password2">Repeat Password</label>
									<input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Repeat Password" required>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button id="btn-pass" type="submit" class="btn btn-primary">Confirm</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal changePasswordModal -->

		<!-- modal Delete -->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Are you sure?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">Data will deleted permanently</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
				</div>
				</div>
			</div>
		</div>
		<!-- end modal Delete -->

			<!-- COPYRIGHT-->
			<section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
						        <p id="copyright">
						            Copyright &copy; <span id="year"></span> All rights reserved.
						        </p>
						    </div>
						    <script>
						        document.getElementById("year").textContent = new Date().getFullYear();
						    </script>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url ();?>assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url ();?>assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?= base_url ();?>assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?= base_url ();?>assets/vendor/wow/wow.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?= base_url ();?>assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?= base_url ();?>assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url ();?>assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url ();?>assets/vendor/select2/select2.min.js">
    </script>
    <!-- Main JS-->
    <script src="<?= base_url ();?>assets/js/main.js"></script>
	<script>
		function changePassword(url){
			$('#btn-pass').attr('href', url);
			$('#changePasswordModal').modal();
		}
	</script>

	<script>
		function deleteConfirm(url){
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

    <!-- Mobile Sidebar Toggle -->
    <script>
        function openSidebar() {
            var sidebar = document.getElementById('mainSidebar');
            var overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.add('sidebar-open');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            var sidebar = document.getElementById('mainSidebar');
            var overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.remove('sidebar-open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Tutup sidebar otomatis saat rotasi layar
        window.addEventListener('orientationchange', function() { closeSidebar(); });

        // Tutup sidebar saat resize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                closeSidebar();
                document.body.style.overflow = '';
            }
        });
    </script>
	<audio id="myAudio" loop>
    <source src="<?= base_url('assets/music/bg-musik.mp3'); ?>" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById("myAudio");

    // 1. Matikan volume SEBELUM musik disetel
    audio.volume = 0; 

    function applySavedVolume() {
        var savedVolume = localStorage.getItem("musicVolume");
        
       if (savedVolume !== null) {
    audio.volume = parseFloat(savedVolume);
} else {
    audio.volume = 0.2; // Default pas pertama kali buka web
}
            console.log("Volume berhasil disamakan: " + savedVolume);
        } else {
            // Kalau belum ada settingan, set ke kecil aja (20%)
            audio.volume = 0.2;
        }
    }

    // 2. Pasang waktu terakhir
    var lastTime = localStorage.getItem("musicTime");
    if (lastTime) {
        audio.currentTime = parseFloat(lastTime);
    }

    // 3. Mainkan musik
    if (localStorage.getItem("musicPlaying") === "true") {
        audio.play().then(function() {
            // SETELAH jalan, baru aplikasikan volumenya
            applySavedVolume();
        }).catch(function() {
            // Jika autoplay diblokir, tunggu klik pertama
            document.addEventListener('click', function() {
                audio.play();
                applySavedVolume();
            }, { once: true });
        });
    }

    // Catat waktu terus menerus
    audio.ontimeupdate = function() {
        localStorage.setItem("musicTime", audio.currentTime);
    };
</script>
<script>
/* =========================================================
   MOBILE REDIRECT — Deteksi layar ≤ 768px → buka halaman
   mobile khusus yang tampilannya beda total
   ========================================================= */
(function() {
    var MOBILE_BP = 768;
    var MOBILE_URL  = '<?= base_url("admin/mobile_view") ?>';
    var DESKTOP_URL = '<?= base_url("admin") ?>';
    var currentUrl  = window.location.href;

    // Hanya aktifkan di halaman dashboard admin (bukan di mobile_view sendiri)
    var isMobileView = currentUrl.indexOf('mobile_view') !== -1;
    var isAdminPage  = currentUrl.indexOf('/admin') !== -1 || currentUrl === DESKTOP_URL;

    if (isMobileView) {
        // Di mobile view: redirect ke desktop kalau layar dibesarkan
        window.addEventListener('resize', (function() {
            var t;
            return function() {
                clearTimeout(t);
                t = setTimeout(function() {
                    if (window.innerWidth > MOBILE_BP) {
                        sessionStorage.removeItem('fromMobile');
                        window.location.replace(DESKTOP_URL);
                    }
                }, 250);
            };
        })());
        return;
    }

    if (!isAdminPage) return; // Jangan redirect di halaman lain

    function goMobile() {
        sessionStorage.setItem('fromMobile', '1');
        window.location.replace(MOBILE_URL);
    }

    // Cek saat load
    if (window.innerWidth <= MOBILE_BP) {
        goMobile();
        return;
    }

    // Cek saat resize (F12 toggle)
    var resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth <= MOBILE_BP) goMobile();
        }, 250);
    });
})();
</script>
</body>

</html>
<!-- end document-->
