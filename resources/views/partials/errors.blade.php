@if ($message = Session::get('success'))
    <div class="alert alert-success position-fixed end-0 me-5" style="top: 22%;" role="alert">
        <strong><i class="fa-solid fa-check-circle"></i> {{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger position-fixed end-0 me-5" style="top: 22%;" role="alert">
        <strong><i class="fa-solid fa-exclamation-triangle"></i> {{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger position-fixed end-0 me-5" style="top: 22%;" role="alert">
            <strong><i class="fa-solid fa-exclamation-triangle"></i> {{ $error }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
