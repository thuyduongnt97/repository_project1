@extends('layouts.layout')

@section('content')
@php
    // dd($role_permission); exit;
@endphp
    <x-setting.table title="List Role" idTable="tableRolePermission" editTable="true">
        <thead >
            <tr>
                <th scope="col">Action</th>
                @foreach ($roles as $valR)
                    <th  class="tdCenter">{{ $valR->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $valP)

                <tr>
                    <td>{{ $valP->name }}</td>
                    @foreach ($roles as $valR)
                        <td  class="tdCenter">
                            @if (count($role_permission->where('role_id', $valR->id)->where('permission_id',$valP->id)) > 0)
                                <i class="icon icon-2xl cib-verizon showIcon" style="margin: auto"></i>
                            @endif
                            <input type="checkbox" name="role_permission" id="" value="" class="form-check-input showCheckbox" data-rol="{{ $valR->id }}" data-per="{{ $valP->id }}" style="display: none; " @if (count($role_permission->where('role_id', $valR->id)->where('permission_id',$valP->id)) > 0)
                                checked
                            @endif>
                        </td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            <tr class="tfoot" style="display:none">
                    <td>Tích all</td>
                    @foreach ($roles as $valR)
                        <td  class="tdCenter">
                            <input type="checkbox" name="" id="">
                        </td>
                    @endforeach
            </tr>
        </tbody>
        
    </x-setting.table>
@endsection

@push('other-scripts')
    <script>
        var checkEdit = true;
        var arrRP = $("#tableRolePermission input:checkbox:checked").map(function () {
            return {'role_id': $(this).data('rol'), 'permission_id' : $(this).data('per')}
        }).get();
        $(document).ready(function () {
            $("#editTable").click(function(){
                if(checkEdit == true){
                    $('.showCheckbox').css('display', 'block');
                    $('.showIcon').css('display', 'none');
                    $("#editTable").html('<i class="icon icon-2xl cib-verizon showIcon"></i>');
                    $('#tableRolePermission .tfoot').css('display', 'table-row')
                    checkEdit = false
                }else{
                 
                    checkEdit = true
                    var data = {};
                    data.role_permission = $("#tableRolePermission input:checkbox:checked").map(function () {
                        return {'role_id': $(this).data('rol'), 'permission_id' : $(this).data('per')}
                    }).get();
                    if(compare(arrRP, data.role_permission)){
                        $('.showCheckbox').css('display', 'none');
                        $('#tableRolePermission .tfoot').css('display', 'none')
                        $('.showIcon').css('display', 'block');
                        $("#editTable").text("Edit");
                        return false;
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{ route('role-permission.update') }}",
                        data: data,
                        success: function (response) {
                            window.location.href = "{{ route('role-permission.index') }}"
                        }
                    });
                }
            })


        });
       
    </script>
@endpush