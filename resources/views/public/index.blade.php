@extends('layouts.public')

@section('contents')
    <main class="contents flex-fill overflow-y-auto">
        <div class="welcome container h-100 d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col text-center">
                    <h1>Selamat Datang</h1>
                    <a href="#identifyForm" class="btn btn-primary p-1 mt-3">Mulai Evaluasi</a>
                </div>
            </div>
        </div>
        <div id="identifyForm" class="container h-100">
            <div class="position-relative row h-100 align-items-center">
                <div class="col-md-6 mx-auto position-relative z-0">
                    <div class="mb-3 fs-5 text-center">
                        <span>Kami perlu mengidentifikasi diri anda sebelum melanjutkan</span>
                    </div>
                    <hr>
                    <form class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="identify" id="identify" maxlength="18" required placeholder="Masukkan nomor identitas anda...">
                                <label for="identify">Nomor Identitas</label>
                            </div>
                            <button class="btn btn-primary d-flex align-items-center" type="submit">
                                <span class="material-symbols-outlined">person_search</span>
                            </button>
                        </div>
                        <small class="mt-1 text-warning d-flex align-items-center">
                            <span class="material-symbols-outlined me-1">error</span>
                            <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde?</span>
                        </small>
                    </form>
                    <small>
                        <div class="fw-bold">Catatan</div>
                        <div class="">
                            <ul>
                                <li>Masukkan Nomor Induk Siswa Nasional (NISN) bagi anda yang merupakan seorang siswa/i.</li>
                                <li>Untuk anda yang merupakan seorang Guru/Staff/Pegawai/Kepala Sekolah, gunakan Nomor Induk Pegawai (NIP).</li>
                            </ul>
                        </div>
                    </small>
                </div>
                <div id="previewIdentity" class="position-absolute d-none pt-4 col-12 h-100 z-1">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center bg-white border rounded p-3">
                                <div class="identifiedImage mb-2">
                                    <img class="rounded-circle border border-2 shadow border-dark" src="{{ asset('sample.jpg') }}" height="240px" width="240px" alt="" srcset="">
                                </div>
                                <div class="identifiedName mb-2">
                                    <div class="fs-3">Steve Jhonson</div>
                                    <div class="small text-bg-light rounded">
                                        <span>1234567890</span>
                                    </div>
                                </div>
                                <div class="row gap-2 justify-content-center mb-3">    
                                    <div class="col-md-4 p-0">
                                        <div class="form-floating">
                                            <input class="form-control bg-light" type="text" name="class" id="class" value="2A" disabled>
                                            <label for="class">Kelas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="form-floating">
                                            <input class="form-control bg-light" type="text" name="class" id="class" value="Budi Hartono" disabled>
                                            <label for="class">Wali Kelas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="form-floating">
                                            <input class="form-control bg-light" type="text" name="class" id="class" value="S***" disabled>
                                            <label for="class">Nama Ayah</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="form-floating">
                                            <input class="form-control bg-light" type="text" name="class" id="class" value="A***" disabled>
                                            <label for="class">Nama Ibu</label>
                                        </div>
                                    </div>
                                </div>
                                <form class="row gap-3 justify-content-center" method="post">
                                    @csrf
                                    <input type="hidden" name="nisn" value="1234567890">
                                    <button class="col-auto btn btn-secondary">Kembali</button>
                                    <button class="col-auto btn btn-primary">Konfirmasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        var s = true;
        $('a[href*="#"]').click(function (e) { 
            e.preventDefault();

            if(s){
                s = false;
                $("main.contents").css("scroll-snap-type", "none");
                $("main.contents").animate({
                    scrollTop: $(this.hash).offset().top
                }, 800, function(){
                    $("main.contents").css("scroll-snap-type", "y mandatory");
                    s = true;
                });
            }
        });
    </script>
@endsection