@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
