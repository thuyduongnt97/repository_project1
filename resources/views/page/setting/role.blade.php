@extends('layouts.layout')

@section('content')
    <x-setting.table title="List Role" titleButton="Add Role" idModal="addRole">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $k => $val)
                <tr>
                    <th scope="row">{{ $k + 1 }}</th>
                    <td>{{ $val->name }}</td>
                    <td>{{ $val->slug }}</td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
            @endforelse
            
        </tbody>
    </x-setting.table> 
    <x-modal idModal="addRole" titleModal="Add Role" titleButton="Save" idButton="CreateRole">
        {{-- <x-form method="POST" action="{{ route('role.create') }}"> --}}
        <form id="form">
            <div class="mb-3">
                <label class="col-form-label" for="recipient-name" >Name:</label>
                <input class="form-control" id="nameRole" type="text" name="name" class="@error('title') is-invalid @enderror">
            </div>
            <div class="mb-3">
                <label class="col-form-label" for="message-text">Slug:</label>
                <input class="form-control" id="slugRole" type="text" name="slug" readonly class="@error('title') is-invalid @enderror">
            </div>
            <div class="alert alert-danger error-form" style="display: none"></div>
        </form>
          
        {{-- </x-form> --}}
    </x-modal>  
@endsection

@push('other-scripts')
    <script>
        $(function () {
            $('#nameRole').keyup(function (e) { 
                $('#slugRole').val(removeAccents($(this).val()))
            });

            $('#CreateRole').click(function () { 
                var data = serializeArrayIncludingDisabledFields($('#form'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('role.create') }}",
                    data: data,
                    success: function (response) {
                        if(typeof response.error !== "undefined" && response){
                            $('.error-form').html(textRes.error[0]);
                            $('.error-form').css('display', '');
                        }else{

                        }
                    }
                })
            });

        });
        
    </script>
@endpush