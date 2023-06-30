@props([
    'title'=> '',
    'titleButton' => '',
    'idModal' => '',
    'idTable' => ''
])

<div class="card mb-4">
    <div class="card-header">
        <strong>Tables</strong>
        <span class="small ms-1">{{ $title }}</span>
        <button class="btn btn-outline-primary rounded-pill btn-sm" data-coreui-toggle="modal" data-coreui-target="#{{ $idModal }}" data-coreui-whatever="@mdo" style="float: right">{{ $titleButton }}</button>
    </div>
    <div class="card-body">
        <div class="example">
            <div class="tab-content rounded-bottom">
                <table class="table table-striped table-hover" id="{{ $idTable }}">
                    {{ $slot }}
                </table>
            </div>
        </div>
    </div>
</div>