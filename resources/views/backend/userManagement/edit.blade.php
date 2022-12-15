@extends('adminlte::page')
@extends('css.card')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        <p class="btn btn-primary mt-3">Halaman Tambah User</p>
    </div>
    <div class="d-flex flex-row gap-4">
        <div class="my_card w-75">
            <form method="POST" action="{{ route('userManagement.update', $user->id) }}">
                <div class="form-group row">
                    @csrf
                    @method('PUT')
                    <label class="col-sm-3 col-form-label mb-3">Nama</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" name="name" placeholder="Nama"
                            value="{{ $user->name }}" required>
                    </div>
                    <label class="col-sm-3 col-form-label mb-3">Email</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" name="email" placeholder="pengguna@gmail.com"
                            value="{{ $user->email }}" required>
                    </div>
                    <label class="col-sm-3 col-form-label mb-5">Role</label>
                    <div class="col-sm-3">
                        <x-adminlte-select2 name="role" label-class="text-lightblue" igroup-size="sm"
                            data-placeholder="Pilih Role ...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-fw fa-lock"></i>
                                </div>
                            </x-slot>
                            </option>
                            <option selected disabled>Pilih Role</option>
                            @foreach ($roles as $role)
                                @if ($role->id == 1)
                                    <option disabled value="{{ $role->name }}">{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                    <label class="col-sm-3 col-form-label mb-3" hidden>Password</label>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" name="password" placeholder="Pa$$w0rd"
                            value="{{ $user->password }}" required hidden>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <a class="btn btn-primary" href="{{ url('userManagement') }}">Kembali</a>
                    <button class="btn btn-success" type="submit">Perbaharui</button>
                </div>
            </form>
        </div>
        <div class="my_card w-50">
            <p class="text-center" style="color: red; font-size: 24px;">Perhatian</p>
            <p style="line-height: 1.8">Tata cara pengisian untuk menambahkan user baru :
                <br> 1. Nama Harus di isi, nama tersebut akan menjadi nama panggilan
                <br> 2. Email yang di masukkan harus sesuai dan tidak boleh sama dengan email yang sudah ada
                <br> 3. Password yang digunakan minimal menggandung 8 karakter
                <br> 4. Role yang di berikan tidak boleh sama seperti super admin
            </p>
        </div>
    </div>
@endsection
