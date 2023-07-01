@extends('layouts.layout')

@section('content')
@php
    // dd($role_permission); exit;
@endphp
    <x-setting.table title="List Role" idTable="tableRole" editTable="true">
        <thead >
            <tr>
                <th scope="col" class="diagonalFalling">Action</th>
                @foreach ($roles as $valR)
                    <th>{{ $valR->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $valP)

                <tr>
                    <td>{{ $valP->name }}</td>
                    @foreach ($roles as $valR)
                        <td><input type="checkbox" name="" id="" class="form-check-input" @if (count($role_permission->where('role_id', $valR->id)->where('permission_id',$valP->id)) > 0)
                            checked
                        @endif></td>
                    @endforeach
                    <td></td>
                </tr>
            @endforeach
            

        </tbody>
    </x-setting.table>
@endsection