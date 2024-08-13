@extends('layouts.public')

@section('styles')
<style>
    .welcome.container h1{
        font-size: 54px
    }
</style>
@endsection

@section('contents')
<x-header :content="[
    'title' => false,
    'data' => false
]"></x-header>
<main class="contents flex-fill overflow-y-auto">
    <div class="welcome container h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col text-center">
                <h1>Selamat Datang</h1>
            </div>
        </div>
    </div>
</main>
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