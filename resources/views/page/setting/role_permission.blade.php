@extends('layouts.layout')

@section('content')
<style>
    td.diagonalFalling
    {
        background: linear-gradient(to right top, #ffffff 0%,#ffffff 49.9%,#000000 50%,#000000 51%,#ffffff 51.1%,#ffffff 100%);
    }
</style>
    <x-setting.table title="List Role" titleButton="Add Role" idModal="addRole" idTable="tableRole">
        <thead>
            <tr>
                <th scope="col" class="diagonalFalling">#</th>
                <th scope="col">Name</th>
                <th scope="col">slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
            </tr>

        </tbody>
    </x-setting.table>
@endsection