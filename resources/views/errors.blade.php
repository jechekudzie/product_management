<div class="col-lg-8">
    <div class="alert alert-dismissible fade show" role="alert">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Errors</h6>
                    </div>
                </div>
            </div>
            <div class="card-body collapse show" id="collapseexample1">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="ri-close-circle-fill text-danger"></i>
                            </div>
                            <div class="flex-grow-1 ms-2 text-muted">
                                {{$error}}
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
