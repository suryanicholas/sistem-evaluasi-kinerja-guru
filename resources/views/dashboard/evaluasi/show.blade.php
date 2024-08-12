@extends('layouts.dashboard')


@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-12 py-2 d-flex bg-light border rounded shadow gap-2">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary p-1 fs-6 material-symbols-outlined">keyboard_backspace</a>
                    <div class="vr me-auto"></div>
                    <a href="{{ route('evaluations.edit', $data->slug) }}" class="btn btn-secondary p-1 fs-6 material-symbols-outlined">edit</a>
                    <form action="{{ route('evaluations.destroy', $data->slug) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger p-1 fs-6 material-symbols-outlined" type="submit">delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center flex-fill py-3 overflow-y-auto">

        </div>
    </div>
@endsection