@props(['idModal' => '',
        'titleModal' => '',
        'titleButton' => '',
        'idButton' => ''
])

<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ $titleModal }} </h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit" id={{ $idButton }}>{{ $titleButton }}</button>
            </div>
        </div>
    </div>
</div>
