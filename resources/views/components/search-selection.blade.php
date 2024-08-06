@if ($callComponents == "view")
<div class="mb-3 position-relative">
    <div class="searchOptions form-floating position-relative z-1">
        <input type="hidden" name="{{ $attrName }}" value="{{ $valHidden }}">
        <input type="text" name="{{ $attrName }}Name" id="dataName" class="form-control" value="{{ $valText }}" placeholder="" data-request="{{ $req }}">
        <label for="dataName">{{ $attrLabel }}</label>
    </div>
    <div class="selectGroups d-none z-1 container position-absolute border bg-secondary-subtle">
        @foreach ($options as $item)
        <div class="row">
            <button type="button" class="col-12 btn btn-light rounded-0 d-flex" data-code="{{ $item->code }}">{{ $item->name }}</button>
        </div>
        @endforeach
    </div>
    @error($attrName)
        <small class="text-danger d-flex align-items-center">
            <span class="material-symbols-outlined fs-5 pe-1">error</span>
            {{ $message }}
        </small>
    @enderror
</div>
@elseif ($callComponents == "script")
<script>
    $(document).ready(function () {
        var i;

        function selectActions() {
            $('.selectGroups .row button').each(function () {
                let x = $(this).parents('.selectGroups').siblings('.searchOptions');
                $(this).click(function () {
                    $(x).find('input[type="text"]').val('');
                    $(x).find('input[type="text"]').val($(this).text());
                    $(x).find('input[type="hidden"]').val($(this).data('code'));
                })
            });
        }
        selectActions();

        function searchData(element, data, search) {
            $.ajax({
                url: `{{ route('dashboard') }}/${data}/search`,
                type: "POST",
                data: {
                    '_token' : "{{ csrf_token() }}",
                    'data' : data,
                    'search' : search
                },
                success: function (r){
                    let x = $(element).parent().siblings('.selectGroups');
                    $(x).html('');
                    console.log(x);
                    if(r.length){
                        r.forEach(item => {
                            $(x).append(`<div class="row"><button type="button" class="col-12 btn btn-light rounded-0 d-flex" data-code="${item.code}">${item.name}</button></div>`);
                        });
                    }
                    selectActions();
                }
            });
        }

        $(".searchOptions input[type='text']").focus(function (){
            $(this).val('');
            $(this).siblings("input[type='hidden']").val('');
            $(this).parent().siblings('.selectGroups').removeClass('d-none');
        }).blur(function () {
            let x = $(this).siblings("input[type='hidden']");
            let y = $(this).parent().siblings('.selectGroups').find('.row:first-child button');
            setTimeout(() => {
                $(this).parent().siblings('.selectGroups').addClass('d-none');

                if($(x).val() == ''){
                    $(x).val($(y).data('code'));
                    $(this).val($(y).text());
                }
            }, 100);
        }).on('input', function () {
            $(this).siblings("input[type='hidden']").val('');
            clearTimeout(i);

            i = setTimeout(() => {
                searchData($(this), $(this).data('request'), $(this).val());
            }, 500);
        })
    });
</script>
@endif