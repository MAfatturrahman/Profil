@extends('adminlte::page')
@extends('css.card')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        <p class="btn btn-primary mt-3">Halaman Tambah Role</p>
    </div>

    <div class="my_card">
        <form method="POST" action="{{ url('role') }}">
            @csrf
            <input class="form-control mb-4" type="text" name="name" placeholder="Nama Role" required>

            <div class="d-flex gap-5 flex-column flex-md-row">
                <div class="d-flex flex-column lh-1">
                    <div class="form-group">
                        <h5>Role Management</h5>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="view-role">
                        <label for="role">view-role</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="create-role">
                        <label for="role">create-role</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="edit-role">
                        <label for="role">edit-role</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="show-role">
                        <label for="role">show-role</label>
                    </div>
                </div>

                <div class="d-flex flex-column lh-1">
                    <div class="form-group">
                        <h5>User Management</h5>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="view-userManagement">
                        <label for="role">view-userManagement</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="create-userManagement">
                        <label for="role">create-userManagement</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="role" name="permission[]" value="edit-userManagement">
                        <label for="role">edit-userManagement</label>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <a class="btn btn-primary" href="{{ url('role') }}">Kembali</a>
                <button class="btn btn-success" type="submit">Tambahkan</button>
            </div>
        </form>


    </div>
@endsection
