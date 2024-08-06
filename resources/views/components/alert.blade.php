<div id="alertPanel" class="position-absolute alert alert-{{ $type }} alert-dismissible fade show col-12 z-1">
    <div class="row">
        <div class="col-12">
            {{ $slot }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>