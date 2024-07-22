@extends('layouts.public')

@section('styles')
<style>
    .welcome.container h1{
        font-size: 54px
    }
</style>
@endsection

@section('contents')
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
                <form id="identifierForm" class="mb-3" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="identify" id="identify" maxlength="18" placeholder="Masukkan nomor identitas anda...">
                            <label for="identify">Nomor Identitas</label>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center" type="submit">
                            <span class="material-symbols-outlined">person_search</span>
                        </button>
                    </div>
                    <small class="alert-container mt-1 text-warning d-flex align-items-center"></small>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function setAlert(object, message) {
            let icon = '<span class="alert-icon material-symbols-outlined me-1">error</span>';
            let messages = `<span>${message}</span>`;
            $(object).find(".alert-container").html("");
            setTimeout(() => {
                $(object).find(".alert-container").append(icon);
                $(object).find(".alert-container").append(messages);
            }, 125);
        }


        $("#identifierForm").submit(function (e) {
            e.preventDefault();
            if($.isNumeric($("#identify").val())){
                this.submit();
            } else{
                setAlert(this, "Mohon mengisi Nomor Identitas yang valid.");
            }
        });
    </script>
@endsection