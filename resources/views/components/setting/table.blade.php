@props([
    'title'=> '',
    'titleButton' => '',
    'idModal' => '',
    'idTable' => '',
    'editTable' => false
])

<div class="card mb-4">
    <div class="card-header">
        <strong>Tables</strong>
        <span class="small ms-1">{{ $title }}</span>
        @if (!$editTable)
            <button class="btn btn-outline-primary rounded-pill btn-sm" data-coreui-toggle="modal" data-coreui-target="#{{ $idModal }}" data-coreui-whatever="@mdo" style="float: right">{{ $titleButton }}</button>
        @endif
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