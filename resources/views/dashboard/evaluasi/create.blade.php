@extends('layouts.dashboard')

@section('meta')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('style')
    <style>
        textarea{
            overflow: hidden;
            resize: none;
        }

        .toolbar{
            top: 0;
            transform: translateX(150%);
            transition: .25s;
        }
    </style>
@endsection

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-12 py-2 d-flex bg-light border rounded shadow gap-2">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary p-1 fs-6 material-symbols-outlined">keyboard_backspace</a>
                    <div class="vr me-auto"></div>
                    <button id="addSegment" class="btn btn-light p-1 fs-6 material-symbols-outlined" form="" type="button">splitscreen</button>
                    <div class="vr"></div>
                    <button class="btn btn-success p-1 fs-6 material-symbols-outlined" form="" type="submit">save</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center flex-fill py-3 overflow-y-auto">
            <div class="col-lg-8">
                <form class="evaluations bg-light border rounded shadow p-3 mb-3" action="" method="post">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" id="title" class="form-control" name="title" value="" placeholder="Judul Evaluasi">
                            <label for="title">Judul</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating position-relative">
                            <small class="charCount text-secondary position-absolute end-0 me-2 d-none">
                                <span>0</span>
                                <span>/</span>
                                <span>1200</span>
                            </small>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="1" maxlength="1200" placeholder="Deskripsi Evaluasi"></textarea>
                            <label for="description">Deskripsi</label>
                        </div>
                    </div>
                </form>
                <div class="segments position-relative">
                    <div class="toolbar bg-light border shadow rounded p-2 position-absolute z-1 end-0">
                        <button id="addQuestion" class="btn btn-light p-1 fs-6 material-symbols-outlined" form="" type="submit">add</button>
                    </div>
                    <form class="bg-light border rounded shadow p-3 mb-3 onFocus" action="" method="post">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="label" value="" id="segmentLabel1" class="form-control" placeholder="Label">
                                <label for="segmentLabel1">Label</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                <span>1</span>
                            </div>
                            <div class="form-floating">
                                <input type="text" id="question1" class="form-control" name="question" value="" placeholder="Pertanyaan 1">
                                <label for="question1">Pertanyaan</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function segmentForm(){
            $(".segments form").each(function (x, y){
                $(y).on('focusin',function (){
                    if(!$(this).hasClass('onFocus')){
                        $(".segments form").removeClass('onFocus');
                        $(this).addClass('onFocus');
                    }
                    $('.toolbar').css('top', $(this).position().top + 'px');
                });
            });
        }

        function evTag(a,b){
            switch (a) {
                case 0:
                    
                    return `<form class="bg-light border rounded shadow p-3 mb-3 onFocus" action="" method="post">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="label" value="" id="segmentLabel${b}" class="form-control" placeholder="Label">
                                        <label for="segmentLabel${b}">Label</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                        <span>1</span>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" id="question1" class="form-control" name="question" value="" placeholder="Pertanyaan 1">
                                        <label for="question1">Pertanyaan</label>
                                    </div>
                                </div>
                            </form>`;
                case 1:

                    return `<div class="input-group mt-3">
                                <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                    <span>${b}</span>
                                </div>
                                <div class="form-floating">
                                    <input type="text" id="question${b}" class="form-control" name="question" value="" placeholder="Pertanyaan ${b}">
                                    <label for="question${b}">Pertanyaan</label>
                                </div>
                            </div>`;
                    
                default:
                    break;
            }
        };

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            segmentForm();

            $('#addSegment').click(function (){
                $('.segments').append(evTag(0,1));
                segmentForm();
            });

            $('#addQuestion').click(function (){
                $('form.onFocus').append(evTag(1,1));
            });
        });
    </script>
@endsection