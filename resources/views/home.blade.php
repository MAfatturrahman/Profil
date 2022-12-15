@extends('adminlte::page')
@extends('css.card')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="my_card w-75 mt-5" style="margin: auto">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label mb-3">Nama</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="name" placeholder="Nama" value="{{ $user->name }}" required
                    readonly>
            </div>

            <label class="col-sm-3 col-form-label mb-3">Email</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="email" placeholder="pengguna@gmail.com"
                    value="{{ $user->email }}" required readonly>
            </div>

            <label class="col-sm-3 col-form-label mb-3">Role</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="email" placeholder="pengguna@gmail.com"
                    value="{{ $user->getRoleNames()[0] }}" required readonly>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
