@extends('layouts.dashboard')

@section('style')
    <style>
        textarea{
            resize: none;
        }
    </style>
@endsection

@section('contents')
    <form class="container h-100 d-flex flex-column" action="#" method="get">
        @csrf
        <div class="row">
            <div class="col-12 py-2 d-flex gap-3 justify-content-start">
                <a href="{{ route('evaluations.index') }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                <button class="ms-auto btn btn-primary p-1 px-3 material-symbols-outlined fs-5" type="submit">add</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 py-3">
                <div class="p-3 border rounded shadow text-secondary">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="title" id="title" class="form-control" placeholder="" value="{{ old('title') }}" required>
                            <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
                            <label for="title">Judul</label>
                        </div>
                        <small class="text-secondary d-flex">
                            <span>{{ env('APP_URL') }}/evaluasi/</span>
                        </small>
                        @error('title')
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                        @error('description')
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" name="periodeStart" id="periodeStart" class="form-control" placeholder="" value="{{ old('periodeStart', date('Y-m-d')) }}" required>
                                    <label for="title">Dimulai</label>
                                </div>
                                @error('periodeStart')
                                <small class="text-danger d-flex align-items-center">
                                    <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="date" name="periodeEnd" id="periodeEnd" class="form-control" placeholder="" value="{{ old('periodeEnd', date('Y-m-d')) }}" required>
                                    <label for="title">Berakhir</label>
                                </div>
                                @error('periodeEnd')
                                <small class="text-danger d-flex align-items-center">
                                    <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('input[name="title"]').on('input', function (e){
            $(this).val($(this).val().replace(/[^a-zA-Z0-9 ?,.:;]/g, ''));
            let t = $(this).val().toLowerCase().replace(/ /g, '-').replace(/[.,;:]/g, '');
            $(this).siblings('input[name="slug"]').val(t);
            $(this).parent().siblings('small.text-secondary').find('span').text(`{{ env('APP_URL') }}/evaluasi/${t}`);
        });
    </script>
@endsection