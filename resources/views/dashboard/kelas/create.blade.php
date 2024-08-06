@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 py-3">
                <form class="p-3 border rounded shadow text-secondary" method="POST" action="{{ route('rooms.store') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="">
                            <label for="name">Nama Kelas</label>
                        </div>
                        @error('name')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <x-search-selection :config="[
                        'components' => 'view',
                        'options' => $teachers,
                        'name' => 'teacher',
                        'label' => 'Wali Kelas',
                        'request' => 'teachers',
                        'value' => old('teacher'),
                        'text' => old('teacherName')]"></x-search-selection>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img src="' + reader.result + '" class="border" height="160px" alt="Product Image">';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<x-search-selection :config="['components' => 'script']"></x-search-selection>
@endsection