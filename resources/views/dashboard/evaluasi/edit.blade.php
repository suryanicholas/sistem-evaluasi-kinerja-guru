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
                    <button id="addSegment" class="btn btn-light p-1 fs-6 material-symbols-outlined" type="button" data-request="segment">splitscreen</button>
                    <div class="vr"></div>
                    <form action="{{ route('evaluations.destroy', $data->slug) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger p-1 fs-6 material-symbols-outlined" type="submit">delete</button>
                    </form>
                    <button id="saveChanges" class="btn btn-success p-1 fs-6 material-symbols-outlined" type="button">save</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center flex-fill py-3 overflow-y-auto">
            <div class="col-lg-8">
                <form class="evaluations bg-light border rounded shadow p-3 mb-3" action="" method="post">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" id="title" class="form-control" name="title" value="{{ $data->title }}" placeholder="Judul Evaluasi">
                            <label for="title">Judul</label>
                        </div>
                        <input type="hidden" id="slug" class="form-control" name="slug" value="{{ $data->slug }}" placeholder="Judul Evaluasi">
                        <small class="text-secondary">
                            <span>{{ env('APP_URL') }}/evaluasi/{{ $data->slug }}</span>
                        </small>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating position-relative">
                            <small class="charCount text-secondary position-absolute end-0 me-2 d-none">
                                <span>0</span>
                                <span>/</span>
                                <span>1200</span>
                            </small>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="1" maxlength="1200" placeholder="Deskripsi Evaluasi">{{ $data->description }}</textarea>
                            <label for="description">Deskripsi</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" id="periodeStart" class="form-control" name="periodeStart" value="{{ $data->periode ? json_decode($data->periode)->start : date('Y-m-d') }}" placeholder="Evaluasi dimulai">
                                <label for="periodeStart">Dimulai</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" id="periodeEnd" class="form-control" name="periodeEnd" value="{{ $data->periode ? json_decode($data->periode)->end : \Carbon\Carbon::now()->addDays(14)->format('Y-m-d') }}" placeholder="Evaluasi dimulai">
                                <label for="periodeEnd">Berakhir</label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="segments position-relative">
                    <div class="toolbar bg-light border shadow rounded p-2 position-absolute z-1 end-0" tabindex="99" style="display: none;">
                        <div class="d-flex flex-column">
                            <button id="deleteSegment" class="btn btn-danger p-1 fs-6 material-symbols-outlined" form="" type="submit">close</button>
                            <hr>
                            <button id="addQuestion" class="btn btn-light p-1 fs-6 material-symbols-outlined" form="" type="submit">add</button>
                            <button id="removeQuestion" class="btn btn-light p-1 fs-6 material-symbols-outlined" style="display: none;" form="" type="submit">remove</button>
                        </div>
                    </div>
                    @if ($data->segments->count())
                    <form id="segment{{ $data->segments[0]->index }}" tabindex="1" class="bg-light border rounded shadow p-3 mb-3 onFocus" action="" method="post">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="label" value="{{ $data->segments[0]->label }}" id="segmentLabel{{ $data->segments[0]->index }}" class="form-control" placeholder="Label">
                                <label for="segmentLabel{{ $data->segments[0]->index }}">Label</label>
                            </div>
                        </div>
                        <div class="questionContainer">
                            @foreach ($data->segments[0]->question as $question)
                            <div class="input-group mb-3">
                                <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                    <span>{{ $question->index }}</span>
                                </div>
                                <div class="form-floating">
                                    <input type="text" id="segment{{ $data->segments[0]->index }}question{{ $question->index }}" class="form-control" name="question" value="{{ $question->question }}" placeholder="Pertanyaan {{ $question->index }}">
                                    <label for="segment{{ $data->segments[0]->index }}question{{ $question->index }}">Pertanyaan</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                    @endif
                    @foreach ($data->segments as $segment)
                    @if ($loop->first)
                        @continue
                    @endif
                    <form id="segment{{ $segment->index }}" tabindex="{{ $loop->iteration }}" class="bg-light border rounded shadow p-3 mb-3" action="" method="post">
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" name="label" value="{{ $segment->label }}" id="segmentLabel{{ $segment->index }}" class="form-control" placeholder="Label">
                                <label for="segmentLabel{{ $segment->index }}">Label</label>
                            </div>
                        </div>
                        <div class="questionContainer" style="display: none;">
                            @foreach ($segment->question as $question)
                            <div class="input-group mb-3">
                                <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                    <span>{{ $question->index }}</span>
                                </div>
                                <div class="form-floating">
                                    <input type="text" id="segment{{ $segment->index }}question{{ $question->index }}" class="form-control" name="question" value="{{ $question->question }}" placeholder="Pertanyaan {{ $question->index }}">
                                    <label for="segment{{ $segment->index }}question{{ $question->index }}">Pertanyaan</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var tl = true;

        function segmentForm(){
            $(".segments form").each(function (a,b){

                $(b).off('focusin focusout').on('focusin',function (){
                    $('.toolbar').show();
                    let c = $(this);
                    $('#deleteSegment').off('click').click(function (){
                        $('.toolbar').css('top', $(c).prev().position().top + 'px');
                        $(c).remove();
                        $('.toolbar').hide();
                    });
                }).on('focusout', function(){
                    if(tl){
                        $('.toolbar').hide();
                    }
                });

                $(b).find('input[name="label"]').off('click').click(function (){
                    let g = $(this).parents('form');
                    
                    if(!$(g).hasClass('onFocus')){
                        $(".segments form").removeClass('onFocus');
                        $(g).addClass('onFocus');
                        $('.segments form .questionContainer').slideUp();
                    }
                    
                    $(g).children('.questionContainer').slideDown(function (){
                        $('.toolbar').css('top', $(g).position().top + 'px');
                    });
                });

                $(b).find('.questionContainer .input-group').off('click').click(function (){
                    $('.toolbar').css('top', $(this).position().top + 'px');
                });
                
                $(b).find('.questionContainer input').off('focus').focus(function (){
                    let c = $(this);
                    
                    $('#removeQuestion').show().off('click').click(function (){
                        $('.toolbar').css('top', ($(c).parents('.input-group').prev().length ? $(c).parents('.input-group').prev().position().top : $(c).parents('form').position().top) + 'px');
                        
                        $(c).parents('.input-group').remove();
                        $('#removeQuestion').hide();
                        
                        $(b).find('.questionContainer .input-group div.col-1 span').each(function (e,f){
                            $(f).text(e + 1);
                        });

                        $('.toolbar').hide();
                    });
                }).off('blur').blur(function(){
                    if(tl){
                        $('#removeQuestion').hide();
                    }
                });

            });
        }

        function evTag(a,b){
            switch (a) {
                case 0:
                    
                    return `<form id="segment${b}" class="bg-light border rounded shadow p-3 mb-3" action="" method="post">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="label" value="Bagian ${b}" id="segmentLabel${b}" class="form-control" placeholder="Label">
                                        <label for="segmentLabel${b}">Label</label>
                                    </div>
                                </div>
                                <div class="questionContainer" style="display: none;">
                                    <div class="input-group">
                                        <div class="fw-bold col-1 d-flex align-items-center justify-content-center border rounded-start">
                                            <span>1</span>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" id="question1" class="form-control" name="question" value="" placeholder="Pertanyaan 1">
                                            <label for="question1">Pertanyaan</label>
                                        </div>
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
            let url = "{{ route('evaluations.update', $data->slug) }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            segmentForm();

            $(".toolbar").hover(function () {
                    tl = false;
                    
                    
                }, function () {
                    tl = true;
                }
            );

            $('#title').on('input', function (){
                let old = "{{ $data->slug }}";
                $(this).val($(this).val().replace(/[^a-zA-Z0-9 ?,.:;]/g, ''));
                let t = $(this).val() ? $(this).val().toLowerCase().replace(/ /g, '-').replace(/[.,;:]/g, '') : old;
                $(this).parent().siblings('input[name="slug"]').val(t);
                $(this).parent().siblings('small.text-secondary').find('span').text(`{{ env('APP_URL') }}/evaluasi/${t}`);
            });

            $('#addSegment').click(function (){
                $('.segments').append(evTag(0,$(".segments form").length + 1));
                segmentForm();
            });

            $('#addQuestion').click(function (){
                $('form.onFocus .questionContainer').append(evTag(1,$('form.onFocus .questionContainer .input-group').length + 1));
                segmentForm();
                $('.toolbar').css('top', ($("form.onFocus").position().top + $("form.onFocus").height() - $('.toolbar').height()) + 'px');
            });

            function alerts(status, message){
                return `<div id="alertPanel" class="position-absolute alert alert-${status} alert-dismissible fade show col-12 z-1">
                            <div class="row">
                                <div class="col-12">
                                    ${message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>`;
            }

            $("#saveChanges").click(function (){
                let hrefOld = "{{ $data->slug }}";
                let data = {
                    '_method': 'PUT',
                    'title' : $('input[name="title"]').val(),
                    'slug' : $('input[name="slug"]').val(),
                    'description' : $('textarea[name="description"]').val(),
                    'periode': {
                        'start' : $('input[name="periodeStart"]').val(),
                        'end' : $('input[name="periodeEnd"]').val(),
                    },
                    'segments' : [],
                };

                $('.segments form').each(function (a,b){
                    data.segments.push({
                        'index': a + 1,
                        'label': $(b).find('input[name="label"]').val(),
                        'questions': [],
                    });

                    $(b).find('.questionContainer .input-group').each(function (c,d){
                        data.segments[a].questions.push({
                            'index': c + 1,
                            'question': $(d).find('input').val(),
                        });
                    });
                });
                
                let s, obj;
                

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data
                }).always(function (r){
                    console.log(r);
                    
                    clearTimeout(s);
                    if(r.status === 200){
                        if(hrefOld !== $('input[name="slug"]').val()){
                            url = "/dashboard/evaluations/" + $('input[name="slug"]').val();
                            history.pushState({}, '', url + "/edit");
                        }
                        $("#mainContainer").append(alerts('success', r.message));
                    }

                    if(r.status === 422){
                        $("#mainContainer").append(alerts('danger', r.errors[Object.keys(r.errors)[0]][0]));
                    }

                    s = setTimeout(() => {
                        obj = new bootstrap.Alert("#alertPanel");
                        if($("#alertPanel").length){
                            obj.close();
                        }
                    }, 2000);
                });
            });
        });
    </script>
@endsection