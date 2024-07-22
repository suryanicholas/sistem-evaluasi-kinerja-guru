@extends('layouts.public')

@section('styles')
    
@endsection

@section('contents')
    <div class="d-flex align-items-center col-12 h-100 z-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center bg-white border rounded p-3">
                    <div class="identifiedImage mb-2">
                        <img class="rounded-circle border border-3 shadow border-dark" src="{{ asset('sample.jpg') }}" height="240px" width="240px" alt="" srcset="">
                    </div>
                    <div class="identifiedName mb-2">
                        <div class="fs-3">Steve Jhonson</div>
                    </div>
                    <hr>
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
                        <a class="col-auto btn btn-secondary" href="/">Kembali</a>
                        <button class="col-auto btn btn-primary" type="submit">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection