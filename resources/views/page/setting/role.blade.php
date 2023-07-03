@extends('layouts.layout')

@section('content')
    <x-setting.table title="List Role" titleButton="Add Role" idModal="addRole" idTable="tableRole">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="RoleTable">
            @forelse ($roles as $k => $val)
                <tr id="role{{ $val->id }}">
                    <th scope="row">{{ $k + 1 }}</th>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->slug }}</td>
                    <td>
                        <button class="btn btn-outline-primary rounded-pill btn-sm modalEditRole" data-id="{{ $val->id }}" data-coreui-toggle="modal" data-coreui-target="#updateRole" data-coreui-whatever="@mdo">Sửa</button>
                        <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeleteRole" data-id="{{ $val->id }}" data-name="{{ $val->name }}">Xóa</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
            @endforelse
            
        </tbody>
    </x-setting.table> 
    <x-modal idModal="addRole" titleModal="Add Role" titleButton="Save" idButton="CreateRole">
        <form id="formCreateRole">
            <div class="mb-3">
                <label class="col-form-label" for="recipient-name" >Name:</label>
                <input class="form-control nameRole" type="text" name="name" class="@error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label class="col-form-label" for="message-text">Slug:</label>
                <input class="form-control slugRole" type="text" name="slug" readonly class="@error('title') is-invalid @enderror">
            </div>
            <div class="alert alert-danger error-form" style="display: none"></div>
        </form>
    </x-modal>
    <x-modal idModal="updateRole" titleModal="Edit Role" titleButton="Update" idButton="submitEditRole">
        <form id="formEditRole">
            <input type="hidden" name="id" value="" readonly>
            <div class="mb-3">
                <label class="col-form-label" for="recipient-name" >Name:</label>
                <input class="form-control nameRole" type="text" name="name" class="@error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label class="col-form-label" for="message-text">Slug:</label>
                <input class="form-control slugRole" type="text" name="slug" readonly class="@error('title') is-invalid @enderror">
            </div>
            <div class="alert alert-danger error-form" style="display: none"></div>
        </form>
    </x-modal>

    <x-toast-success title="Thành công" mess="Bạn đã thêm role thành công"></x-toast-success>

@endsection

@push('other-scripts')
    <script>
        $(function () {
            
            $('.nameRole').keyup(function (e) { 
                $('.slugRole').val(removeAccents($(this).val()))
            });

            $('#CreateRole').click(function () { 
                var data = serializeArrayIncludingDisabledFields($('#formCreateRole'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('role.create') }}",
                    data: data,
                    success: function (response) {
                        if(typeof response.error != "undefined" && response){
                            let html = ''
                             response.error.forEach(element => {
                                html += `${element}<br>` ;
                            });
                            $('#addRole .error-form').html(html);
                            $('#addRole .error-form').css('display', '');
                        }else{
                            var res = response.data;
                            var html = `<tr>
                                            <th scope="row">#</th>
                                            <td>${res.name}</td>
                                            <td>${res.slug}</td>
                                            <td>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm modalEditRole" data-id="${res.id}" data-coreui-toggle="modal" data-coreui-target="#updateRole" data-coreui-whatever="@mdo">Sửa</button>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeleteRole" data-id="${res.id}" data-name="${res.name}">Xóa</button>
                                            </td>
                                        </tr>`;
                            $('#RoleTable').prepend(html);
                            $('#formCreateRole')[0].reset();
                            $('#addRole').modal('toggle');
                            $('#addRole .error-form').css('display', 'none');
                            showToast();
                        }
                    }
                })
            });
            $("#tableRole").on('click','.modalEditRole',function(){
                let modal = $('#updateRole');                
                // get the current row
                var currentRow=$(this).closest("tr"); 
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=name]').val(currentRow.find("td:eq(0)").text())
                modal.find('input[name=slug]').val(currentRow.find("td:eq(1)").text())
            });
            $("#submitEditRole").on('click', function(){
                var data = serializeArrayIncludingDisabledFields($('#formEditRole'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('role.update') }}",
                    data: data,
                    success: function (response) {
                        if(typeof response.error != "undefined" && response){
                            let html = ''
                             response.error.forEach(element => {
                                html += `${element}<br>` ;
                            });
                            $('#updateRole .error-form').html(html);
                            $('#updateRole .error-form').css('display', '');
                        }else{
                            if(response.result){
                                let id = $('#formEditRole').find('input[name=id]').val();
                                var currentRow = $("tr#role"+id); 
                                currentRow.find("td:eq(0)").text(data.name)
                                currentRow.find("td:eq(1)").text(data.slug)
                                $('#formCreateRole')[0].reset();
                                $('#updateRole').modal('toggle');
                                $('#updateRole .error-form').css('display', 'none');
                                showToast();
                            }
                        }
                    }
                });
            })
            $('.confirmDeleteRole').on('click', function(){
                let data = {'id': $(this).data('id')};
                let id = $(this).data('id');
                $.confirm({
                    title: `You are sure you want to delete Role <b>${$(this).data('name')}</b>`,
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
                                    url: "{{ route('role.delete') }}",
                                    data: data,
                                    success: function (response) {
                                        if(response.result){
                                            console.log(`#role${id}`);
                                            $(`#role${id}`).remove()
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