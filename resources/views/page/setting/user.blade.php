@extends('layouts.layout')

@section('content')
    <x-setting.table title="List User" titleButton="Add User" idModal="addUser" idTable="tableUser">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Blocked</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="RoleTable">
            @forelse ($users as $k => $val)
                <tr id="user{{ $val->id }}">
                    <th scope="row">{{ $k + 1 }}</th>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->email }}</td>
                    <td>
                        @if ($val->blocked == 1)
                            <i class="icon icon-2xl mt-5 mb-2 cil-check"></i>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-outline-primary rounded-pill btn-sm modalEditRole" data-id="{{ $val->id }}" data-coreui-toggle="modal" data-coreui-target="#updateRole" data-coreui-whatever="@mdo"><i class="fa fa-edit" style="font-size:20px"></i></button>
                        <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeleteRole" data-id="{{ $val->id }}" data-name="{{ $val->name }}">Xóa</button>
                        <button class="btn btn-outline-primary rounded-pill btn-sm">
                            <i class="icon icon-2xl cil-user-x"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
            @endforelse
            
        </tbody>
    </x-setting.table> 
    <x-modal idModal="addUser" titleModal="Add User" titleButton="Save" idButton="CreateUser">
        <form id="formCreateUser">
            <div class="form-floating mb-3">
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="name" id="floatingName" required> 
                <label class="form-label" for="recipient-name" >Name:</label>
               
            </div>
            <div class="form-floating mb-3">
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="email" id="floatingEmail" required>
                <label class="" for="message-text">Email:</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control @error('title') is-invalid @enderror" type="password" name="password" id="floatingPassword" required>
                <label class="" for="message-text">Password:</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="password" name="" required id="passwordConfirm">
                <label class="" for="message-text">Confirm Password:</label>
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
    <x-toast-success title="Thành công" mess="Bạn đã thêm user thành công"></x-toast-success>

@endsection

@push('other-scripts')
    <script>
        // (function() {
        //     'use strict'
        //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
        //     var forms = document.querySelectorAll('.needs-validation')
        //     // Loop over them and prevent submission
        //     Array.prototype.slice.call(forms).forEach(function(form) {
        //     form.addEventListener('submit', function(event) {
        //         if (!form.checkValidity()) {
        //         event.preventDefault()
        //         event.stopPropagation()
        //         }
        //         form.classList.add('was-validated')
        //     }, false)
        //     })
        // })()
        $(function () {
            $('#CreateUser').click(function () { 
                var data = serializeArrayIncludingDisabledFields($('#formCreateUser'));
                var html = "";
                console.log()
                if(data.email=='' || !validateEmail(data.email)){
                    html += "Email rỗng hoặc chưa đúng định dạng<br>";
                }
                if(data.name == ''){
                    html += "Name không được để trống<br>";
                }
                if(data.password == ''){
                    html += "Password không được để trống";
                }
                if(data.password != $('#passwordConfirm').val()){
                    html += "Password không khớp";
                }
                if(html != ''){
                    $('.error-form').html(html);
                    $('.error-form').css('display', '');
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.create') }}",
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
                                            <td>${res.email}</td>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm modalEditRole" data-id="${res.id}" data-coreui-toggle="modal" data-coreui-target="#updateRole" data-coreui-whatever="@mdo">Sửa</button>
                                                <button class="btn btn-outline-primary rounded-pill btn-sm confirmDeleteRole" data-id="${res.id}" data-name="${res.name}">Xóa</button>
                                            </td>
                                        </tr>`;
                            $('#tableUser').prepend(html);
                            $('#formCreateUser')[0].reset();
                            $('#addUser').modal('toggle');
                            $('.error-form').html();
                            $('.error-form').css('display', 'none');
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
                        if(typeof response.error !== "undefined" && response){
                            $('.error-form').html(textRes.error[0]);
                            $('.error-form').css('display', '');
                        }else{
                            if(response.result){
                                console.log(response.result);
                                let id = $('#formEditRole').find('input[name=id]').val();
                                var currentRow = $("tr#role"+id); 
                                currentRow.find("td:eq(0)").text(data.name)
                                currentRow.find("td:eq(1)").text(data.slug)
                                $('#formCreateRole')[0].reset();
                                $('#updateRole').modal('toggle');
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