@extends('layouts.public')

@section('contents')
    <div class="container h-100 d-flex flex-column py-3 overflow-y-auto">
        <div class="row">
            <div class="col-lg-12 py-3 border">
                <div class="row">
                    <div class="col-lg-12 text-bg-dark h2 py-2 text-truncate">
                        <span>{{ $data->title }}</span>
                    </div>
                    <div class="col-lg-12 small text-bg-secondary">
                        <div class="row">
                            <div class="col-lg-auto">
                                <span>Dipublikasi : </span>
                                <span>{{ \Carbon\Carbon::parse(json_decode($data->periode)->start)->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="col-lg-auto ms-auto">
                                <span>Berakhir : </span>
                                <span>{{ \Carbon\Carbon::parse(json_decode($data->periode)->end)->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection