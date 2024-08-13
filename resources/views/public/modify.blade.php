@extends('layouts.public')

@section('contents')
<x-header :content="[
    'title' => false,
    'respondent' => $data->evaluation
]"></x-header>
<main class="contents flex-fill overflow-y-auto">
    <form class="container h-100 d-flex flex-column py-3 overflow-y-auto" action="{{ route('evaluate.store', $data->token) }}" method="POST">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-lg-12 py-3 border">
                <div class="row">
                    <div class="col-lg-12 text-bg-dark h2 py-2 text-truncate">
                        <span>{{ $data->evaluation->title }}</span>
                    </div>
                    <div class="col-lg-12 small text-bg-secondary">
                        <div class="row">
                            <div class="col-lg-auto">
                                <span>Dipublikasi : </span>
                                <span>{{ \Carbon\Carbon::parse(json_decode($data->evaluation->periode)->start)->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="col-lg-auto ms-auto">
                                <span>Berakhir : </span>
                                <span>{{ \Carbon\Carbon::parse(json_decode($data->evaluation->periode)->end)->locale('id')->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        {{ $data->evaluation->description }}
                    </div>
                </div>
            </div>
        </div>
        @foreach ($data->evaluation->segments as $segment)
        <div class="row mb-3 border">
            <div class="col-lg-12 h4 py-2 text-truncate">
                <span>{{ $segment->label }}</span>
            </div>
            <div class="col-lg-12">
                @foreach ($segment->question as $item)
                    @if ($item->question !== null)
                    <div class="questionContainer row mb-3 border-top">
                        <div class="col-lg-1 d-flex align-items-center justify-content-center fw-bold fs-5">
                            <span>{{ $item->index }}</span>
                        </div>
                        <div class="col-lg-11">
                            <div class="col-lg-12 fs-5 mb-2 bor">{{ $item->question }}</div>
                            <div class="answersOptions col-lg-12">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="s{{ $segment->index }}q{{ $item->index }}" value="4" id="s{{ $segment->index }}q{{ $item->index }}opt1" {{ $item->answers->where('response_id', $data->id)->first()->answer === 4 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="s{{ $segment->index }}q{{ $item->index }}opt1">Sangat Setuju</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="s{{ $segment->index }}q{{ $item->index }}" value="3" id="s{{ $segment->index }}q{{ $item->index }}opt2" {{ $item->answers->where('response_id', $data->id)->first()->answer === 3 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="s{{ $segment->index }}q{{ $item->index }}opt2">Setuju</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="s{{ $segment->index }}q{{ $item->index }}" value="2" id="s{{ $segment->index }}q{{ $item->index }}opt3" {{ $item->answers->where('response_id', $data->id)->first()->answer === 2 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="s{{ $segment->index }}q{{ $item->index }}opt3">Netral</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="s{{ $segment->index }}q{{ $item->index }}" value="1" id="s{{ $segment->index }}q{{ $item->index }}opt4" {{ $item->answers->where('response_id', $data->id)->first()->answer === 1 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="s{{ $segment->index }}q{{ $item->index }}opt4">Tidak Setuju</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="s{{ $segment->index }}q{{ $item->index }}" value="0" id="s{{ $segment->index }}q{{ $item->index }}opt5" {{ $item->answers->where('response_id', $data->id)->first()->answer === 0 ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="s{{ $segment->index }}q{{ $item->index }}opt5">Sangat Tidak Setuju</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach
        <div class="mb-3 text-center">
            <button class="btn btn-primary" type="submit">Kirim</button>
        </div>
    </form>
</main>
@endsection

@section('scripts')
    <script>
        let a = [
            {
                'segmentIndex': 1,
                'questionAnswers': [
                    {
                        'index': 1,
                        'answers': 'setuju'
                    },
                    ...
                ]
            },
            ...
        ];
    </script>
@endsection