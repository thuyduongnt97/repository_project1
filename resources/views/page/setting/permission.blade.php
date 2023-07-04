@extends('layouts.layout')

@section('content')
    <x-setting.table title="List Permission" titleButton="Add Permission" idModal="addPermission" idTable="tablePermission">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="PermissionTable">
            @forelse ($permissions as $k => $val)
                <tr id="permission{{ $val->id }}">
                    <th scope="row">{{ $k + 1 }}</th>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->slug }}</td>
                    <td>
                        <button class="btn btn-outline-primary rounded-pill btn-sm modalEditPermission" data-id="{{ $val->id }}" data-coreui-toggle="modal" data-coreui-target="#updatePermission" data-coreui-whatever="@mdo">Sửa</button>
                        <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeletePermission" data-id="{{ $val->id }}" data-name="{{ $val->name }}">Xóa</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
            @endforelse
            
        </tbody>
    </x-setting.table> 
    <x-modal idModal="addPermission" titleModal="Add Permission" titleButton="Save" idButton="CreatePermission">
        <form id="formCreatePermission">
            <div class="mb-3">
                <label class="col-form-label" for="recipient-name" >Name:</label>
                <input class="form-control namePermission" type="text" name="name" class="@error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label class="col-form-label" for="message-text">Slug:</label>
                <input class="form-control slugPermission" type="text" name="slug" readonly class="@error('title') is-invalid @enderror">
            </div>
            <div class="alert alert-danger error-form" style="display: none"></div>
        </form>
    </x-modal>
    <x-modal idModal="updatePermission" titleModal="Edit Permission" titleButton="Update" idButton="submitEditPermission">
        <form id="formEditPermission">
            <input type="hidden" name="id" value="" readonly>
            <div class="mb-3">
                <label class="col-form-label" for="recipient-name" >Name:</label>
                <input class="form-control namePermission" type="text" name="name" class="@error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label class="col-form-label" for="message-text">Slug:</label>
                <input class="form-control slugPermission" type="text" name="slug" readonly class="@error('title') is-invalid @enderror">
            </div>
            <div class="alert alert-danger error-form" style="display: none"></div>
        </form>
    </x-modal>

    <x-toast-success title="Thành công" mess="Bạn đã thêm permission thành công"></x-toast-success>

@endsection

@push('other-scripts')
    <script>
        $(function () {
            
            $('.namePermission').keyup(function (e) { 
                $('.slugPermission').val(removeAccents($(this).val()))
            });

            $('#CreatePermission').click(function () { 
                var data = serializeArrayIncludingDisabledFields($('#formCreatePermission'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('permission.create') }}",
                    data: data,
                    success: function (response) {
                        if(typeof response.error !== "undefined" && response){
                            $('.error-form').html(textRes.error[0]);
                            $('.error-form').css('display', '');
                        }else{
                            console.log(response);
                            var res = response.data;
                            var html = `<tr>
                                            <th scope="row">#</th>
                                            <td>${res.name}</td>
                                            <td>${res.slug}</td>
                                            <td>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm modalEditPermission" data-id="${res.id}" data-coreui-toggle="modal" data-coreui-target="#updatePermission" data-coreui-whatever="@mdo">Sửa</button>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeletePermission" data-id="${res.id}" data-name="${res.name}">Xóa</button>
                                            </td>
                                        </tr>`;
                            $('#PermissionTable').prepend(html);
                            $('#formCreatePermission')[0].reset();
                            $('#addPermission').modal('toggle');
                            showToast();
                        }
                    }
                })
            });
            $("#tablePermission").on('click','.modalEditPermission',function(){
                let modal = $('#updatePermission');                
                // get the current row
                var currentRow=$(this).closest("tr"); 
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=name]').val(currentRow.find("td:eq(0)").text())
                modal.find('input[name=slug]').val(currentRow.find("td:eq(1)").text())
            });
            $("#submitEditPermission").on('click', function(){
                var data = serializeArrayIncludingDisabledFields($('#formEditPermission'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('permission.update') }}",
                    data: data,
                    success: function (response) {
                        if(typeof response.error !== "undefined" && response){
                            $('.error-form').html(textRes.error[0]);
                            $('.error-form').css('display', '');
                        }else{
                            if(response.result){
                                console.log(response.result);
                                let id = $('#formEditPermission').find('input[name=id]').val();
                                var currentRow = $("tr#permission"+id); 
                                currentRow.find("td:eq(0)").text(data.name)
                                currentRow.find("td:eq(1)").text(data.slug)
                                $('#formCreatePermission')[0].reset();
                                $('#updatePermission').modal('toggle');
                                showToast();
                            }
                        }
                    }
                });
            })
            $('.confirmDeletePermission').on('click', function(){
                let data = {'id': $(this).data('id')};
                let id = $(this).data('id');
                $.confirm({
                    title: `You are sure you want to delete Permission <b>${$(this).data('name')}</b>`,
                    content: 'Click confirm or cancel for another modal',
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    opacity: 0.5,
                    buttons: {
                        'confirm': {
                            text: 'Confirm',
                            btnClass: 'btn-blue',
                            action: function(){
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('permission.delete') }}",
                                    data: data,
                                    success: function (response) {
                                        if(response.result){
                                            console.log(`#permission${id}`);
                                            $(`#permission${id}`).remove()
                                            showToast();
                                        }
                                    }
                                });
                            }
                        },
                        cancel: function(){
                        },
                    }
                });
            });
        });
    </script>
@endpush