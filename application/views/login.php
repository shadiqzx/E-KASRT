<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAS-RT | Login</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url();?>assets/favicon.png">
    
    <!-- Link CSS buat Icon dan Bootstrap -->
    <link href="<?= base_url();?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body, html {
            height: 100%; width: 100%;
            display: flex; align-items: center; justify-content: center;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: colorShift 10s ease infinite;
            overflow: hidden;
        }

        @keyframes colorShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            z-index: 10;
            animation: slideUp 0.6s ease-out forwards;
        }

        .login-logo img { width: 120px; margin-bottom: 25px; }
        .form-group { text-align: left; margin-bottom: 15px; }
        .form-control { border-radius: 10px; padding: 12px; height: auto; border: 1px solid #ddd; }

        .btn-signin {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none; color: white; padding: 15px; width: 100%;
            border-radius: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; transition: 0.3s; cursor: pointer;
        }

        /* FLOATING MENUS POJOK KANAN */
        .floating-menus {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            align-items: flex-end;
            gap: 15px;
            z-index: 999;
        }

        .vol-btn, .wa-btn {
            width: 50px; height: 50px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: white; font-size: 24px;
            transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.4);
            text-decoration: none;
        }

        .wa-btn { background: #25d366; } /* Hijau WA */
        .wa-btn:hover { background: #128c7e; transform: scale(1.1); color: white; }

        .vol-btn { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); }
        .vol-btn:hover { background: rgba(255, 255, 255, 0.4); transform: scale(1.1); }

        .vol-container { display: flex; flex-direction: column-reverse; align-items: center; }
        .vol-slider-wrap {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px 10px; border-radius: 30px;
            margin-bottom: 15px; display: none;
            border: 1px solid rgba(255,255,255,0.4);
        }

        #volumeSlider { appearance: slider-vertical; width: 5px; height: 100px; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <audio id="myAudio" loop>
        <source src="<?= base_url('assets/music/bg-musik.mp3'); ?>" type="audio/mpeg">
    </audio>

    <div class="login-card">
        <div class="login-logo">
            <img src="<?= base_url();?>assets/icon-home.png" alt="Logo">
        </div>
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('auth'); ?>" method="post">
            <div class="form-group">
                <label class="small font-weight-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <label class="small font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-signin">SIGN IN</button>
        </form>
        <p class="small mt-4 text-muted" style="font-size: 10px;">&copy; 2026 KAS-RT System</p>
    </div>

    <!-- TOMBOL WA DAN VOLUME -->
    <div class="floating-menus">
        <!-- Ganti nomor HP di sini -->
        <a href="https://wa.me/6285810734801?text=Halo%20Admin,%20saya%20butuh%20bantuan." 
           target="_blank" class="wa-btn">
            <i class="fa fa-whatsapp"></i>
        </a>

        <div class="vol-container">
            <div class="vol-btn" onclick="toggleVolume()"><i class="zmdi zmdi-volume-up" id="volIcon"></i></div>
            <div class="vol-slider-wrap" id="sliderBox">
                <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="0.3">
            </div>
        </div>
    </div>

    <script>
        var audio = document.getElementById("myAudio");
        var slider = document.getElementById("volumeSlider");
        var sliderBox = document.getElementById("sliderBox");
        var volIcon = document.getElementById("volIcon");

        audio.volume = 0.3;

        function toggleVolume() {
            sliderBox.style.display = (sliderBox.style.display === "block") ? "none" : "block";
        }

        function startMusic() {
            audio.play().then(() => {
                ["click", "keydown", "mousemove", "touchstart"].forEach(e => document.removeEventListener(e, startMusic));
            }).catch(e => console.log("Blocked"));
        }

        slider.addEventListener("input", function() {
            audio.volume = this.value;
            volIcon.className = (this.value == 0) ? "zmdi zmdi-volume-off" : "zmdi zmdi-volume-up";
            localStorage.setItem("musicVolume", this.value);
        });

        ["click", "keydown", "mousemove", "touchstart"].forEach(e => document.addEventListener(e, startMusic));
    </script>
    <script>
<script>
    var audio = document.getElementById("myAudio");

    // 1. Matikan volume SEBELUM musik disetel
    audio.volume = 0; 

    function applySavedVolume() {
        var savedVolume = localStorage.getItem("musicVolume");
        
        if (savedVolume !== null) {
            // Gunakan volume dari login
            audio.volume = parseFloat(savedVolume);
            console.log("Volume berhasil disamakan: " + savedVolume);
        } else {
            // Kalau belum ada settingan, set ke kecil aja (20%)
            audio.volume = 0.1;
            if (slider) slider.value = 0.1;
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
    </script>
</body>
</html>