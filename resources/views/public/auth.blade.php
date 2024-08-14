@extends('layouts.public')

@section('styles')
    
@endsection

@section('contents')
<x-header :content="[
    'title' => false,
    'evaluation' => $data
]"></x-header>
<main class="contents flex-fill overflow-y-auto">
    <div class="container h-100">
        <div class="row py-3">
            <div class="col-lg-12">
                <div>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</div>
                <div>{{ session($data->slug) }}</div>
                <div>
                    <span class="fs-4 fw-bold">{{ $data->title }}</span>
                </div>
                <small class="ms-auto text-secondary mb-3">Batas akhir partisipasi: {{ \Carbon\Carbon::parse(json_decode($data->periode)->end)->locale('id')->translatedFormat('d F Y') }}</small>
                @if (\Carbon\Carbon::parse(json_decode($data->periode)->end)->isPast())
                    <small class="text-bg-danger ms-auto px-2 rounded mb-3">Telah Berakhir</small>
                @endif
                <p>
                    {{ $data->description }}
                </p>
            </div>
            @if (!\Carbon\Carbon::parse(json_decode($data->periode)->end)->isPast())
            <div class="col-lg-12 text-center py-3">
                <a class="btn btn-primary" href="#identifyForm">Mulai Evaluasi</a>
            </div>
            @endif
        </div>
    </div>
    @if (!\Carbon\Carbon::parse(json_decode($data->periode)->end)->isPast())
    <div id="identifyForm" class="container h-100">
        <div class="position-relative row h-100 align-items-center">
            <div class="col-md-6 mx-auto position-relative z-0">
                <div class="mb-3 fs-5 text-center">
                    <span>Kami perlu mengidentifikasi diri anda sebelum melanjutkan</span>
                </div>
                <hr>
                <form id="identifierForm" action="{{ route('evaluate.verify', $data->slug) }}" class="mb-3" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="hidden" name="type">
                        <span class="typeIcon material-symbols-outlined d-flex align-items-center fs-3 px-2 border rounded-start">question_mark</span>
                        <div class="form-floating position-relative">
                            <input type="text" class="form-control" name="identify" id="identify" maxlength="18" placeholder="Masukkan nomor identitas anda...">
                            <label for="identify">Nomor Identitas</label>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center" type="submit">
                            <span class="material-symbols-outlined">person_search</span>
                        </button>
                    </div>
                    @if(session('response'))
                    <small class="alert-container mt-1 text-warning d-flex align-items-center">{{ session('response')['message'] }}</small>
                    @endif
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
    @endif
</main>

@endsection

@section('scripts')
    @if (session('identified'))
    
    @else
        <script>
            $("#identify").on("input", function (){
                let type = [
                    'question_mark',
                    'person',
                    'face'
                ]
                if($(this).val().length === 10){
                    $(this).parent().siblings('input[name="type"]').val('student');
                    $(this).parent().siblings('.typeIcon').text(type[2]);
                } else if($(this).val().length === 18){
                    $(this).parent().siblings('input[name="type"]').val('teacher');
                    $(this).parent().siblings('.typeIcon').text(type[1]);
                } else{
                    $(this).parent().siblings('input[name="type"]').val(null);
                    $(this).parent().siblings('.typeIcon').text(type[0]);
                }
            });
        </script>
    @endif
@endsection