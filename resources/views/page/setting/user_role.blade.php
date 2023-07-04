@extends('layouts.layout')

@section('content')

    <x-setting.table title="List Role" idTable="tableRolePermission" editTable="true">
        <thead >
            <tr>
                <th scope="col" class="diagonalFalling">Action</th>
                @foreach ($roles as $valR)
                    <th class="tdCenter">{{ $valR->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $valU)

                <tr>
                    <td><b>{{ $valU->name }}</b> <br>
                        <small style="color: #2353ff">{{ $valU->email }}</small>
                    </td>
                    @foreach ($roles as $valR)
                        <td class="tdCenter">
                            <div class="center-value">
                                @if (count($user_role->where('role_id', $valR->id)->where('user_id',$valU->id)) > 0)
                                    <i class="icon icon-2xl cib-verizon showIcon" style="margin: auto"></i>
                                @endif
                                <input type="checkbox" name="user_role" class="form-check-input showCheckbox" data-rol="{{ $valR->id }}" data-user="{{ $valU->id }}" style="display: none; " @if (count($user_role->where('role_id', $valR->id)->where('user_id',$valU->id)) > 0)
                                    checked
                                @endif>
                            </div>
                        </td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </x-setting.table>
    <x-toast-success title="Thành công" mess="Bạn đã sửa quyền thành công"></x-toast-success>
@endsection

@push('other-scripts')
    <script>
        var checkEdit = true;
        $(document).ready(function () {
            $("#editTable").click(function(){
                if(checkEdit == true){
                    $('.showCheckbox').css('display', 'block');
                    $('.showIcon').css('display', 'none');
                    $("#editTable").html('<i class="icon icon-2xl cib-verizon showIcon" style=""></i>');
                    checkEdit = false
                }else{
                    $('.showCheckbox').css('display', 'none');
                    $('.showIcon').css('display', 'block');
                    $("#editTable").text("Edit");
                    checkEdit = true
                }
            })
            $('.showCheckbox').on('change', function(){
                window.showCheckbox = $(this);
                if($(this).is(':checked')) {
                    $(this).prop('checked',true);
                    // add
                    var data = {};
                    data.user_role =  {'role_id': $(this).data('rol'), 'user_id' : $(this).data('user')}
                    $(this).parent().prepend(`<i class="icon icon-2xl cib-verizon showIcon" style="display:none; margin: auto"></i>`);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user-role.add') }}",
                        data: data,
                        success: function (response) {
                        }
                    });
                } else {
                    $(this).prop('checked',false);
                    // delete
                    var data = {};
                    data.user_role =  {'role_id': $(this).data('rol'), 'user_id' : $(this).data('user')}
                    $(this).parent().find('.cib-verizon').remove();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user-role.delete') }}",
                        data: data,
                        success: function (response) {
                            $(this).parent().html('');
                        }
                    });
                    
                }
                showToast();
            })

        });
       
    </script>
@endpush