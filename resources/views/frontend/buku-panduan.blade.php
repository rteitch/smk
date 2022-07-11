@extends('layouts.global')

@section('title')
    Buku Panduan
@endsection

@section('ga-active')
    active
@endsection

@section('ga-collapse-in')
    in
@endsection

@section('ga-buku-panduan-active')
    active
@endsection

@section('breadcrumb')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Buku Panduan</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Guild Adventure</li>
                    <li class="breadcrumb-item active"> <a href="{{ route('frontend.bukupanduan') }}">Buku Panduan</a> </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3>Buku Panduan</h3>
                        <ul>
                            <li>Pengenalan</li>
                            <p>Selamat datang di guild adventure smkn2 surakarta. Website ini berisi penugasan yang dikemas
                                dalam bentuk quest, dan reward yang bisa diclaim oleh user siswa ketika telah menyelesaikan
                                quest dan mendapatkan skor.</p>
                            <li>Istilah dalam Website</li>
                            <ul>
                                <li><strong>Guild Adventure</strong> : Istilah lain dari Sekolah.</li>
                                <li><strong>Job Class</strong> : Istilah lain dari Program Jurusan (ex: TKJ, RPL, TKR dst..)
                                </li>
                                <li><strong>Skill</strong> : Istilah lain Mata Pelajaran (ex: Komputer dan Jaringan Dasar,
                                    Administrasi Sistem Jaringan dst..)</li>
                                <li><strong>Quest</strong> : Istilah lain dari Penugasan/Misi yang berbentuk Laporan atau
                                    pilihan ganda</li>
                            </ul>
                            <br>
                            <li>Cara Mengambil JobClass</li>
                            <p>1. Buka Menu Guild Adventure <br>
                                2. Pilih Menu Job Class <br>
                                3. Cari Job Class yang sesuai <br>
                                4. Tekan Tombol Tambah, otomatis Job class sudah diambil</p>
                            <li>Cara Mengambil Skill</li>
                            <p>1. Buka Menu Guild Adventure <br>
                                2. Pilih Menu Skill <br>
                                3. Cari Skill yang sesuai
                                4. Tekan tombol Lihat Skill untuk melihat skill <br>
                                5. Pastikan syarat lv sesuai, tekan tombol Tambah, otomatis skill sudah diambil</p>
                            <li>Cara Mengambil Quest</li>
                            <p>1. Buka Menu Guild Adventure <br>
                                2. Pilih Menu Quest <br>
                                3. Cari quest yang diinginkan <br>
                                4. Pastikan syarat lv sesuai, tekan tombol Tambah, otomatis quest sudah diambil</p>
                            <li>Cara Mengirim Quest</li>
                            <p>1. Buka Dashboard <br>
                                2. Pilih Menu Quest Saya <br>
                                3. Cari Quest yang status masih Submit <br>
                                4. Tekan tombol Upload, kemudian upload jawaban, jika jenis soal pilihan ganda maka pilih
                                opsi jawaban, jika jenis soal laporan, upload laporan berupa file berupa pdf. <br>
                                5. Jenis soal pilihan ganda secara otomatis akan terjawab, untuk jenis soal Laporan
                                dibutuhkan waktu, untuk proses validasi jawaban</p>
                            <li>Cara Menaikan Skor, Level, Exp</li>
                            <p>1. Selesaikan Quest sebanyak-banyaknya</p>
                            <li>Cara Menukar Skor dengan Reward</li>
                            <p>1. Buka Guild Adventure <br>
                                2. Pilih menu Reward <br>
                                3. Cari reward yang diinginkan, pastikan skor mencukupi, jika tidak mencukupi anda tidak
                                diizinkan menukar reward <br>
                                4. Tekan Tombol Tukar, untuk menukar skor dengan reward, dibutuhkan untuk proses validasi
                                reward dan proses pengiriman, reward akan dikirim lewat konfirmasi email / whatsapp nomor hp
                                siswa</p>
                            <li>Leaderboard</li>
                            <p>Leaderboard atau papan peringkat berfungsi untuk melihat siapa yang memiliki skor tertinggi di guild adventure SMK Negeri 2 Surakarta.</p>
                            <li>Web Info</li>
                            <p>Web ini didevelop oleh Mahasiswa UNS atas nama Rizal Taufiq Hidayat, NIM K3518052, Prodi Pendidikan Teknik Informatika dan Komputer, dalam rangka menyelesaikan syarat mendapatkan gelar Sarjana. Mahasiswa tersebut adalah alumni dari SMK Negeri 2 Surakarta angkatan 2015-2018 dengan Jurusan Teknik Komputer dan Jaringan. Setelah kewajiban ini selesai, website akan diserahkan ke pihak sekolah untuk dikelola sendiri, dan hal ini merupakan kenang-kenangan dari alumni SMKN2SKA. </p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
