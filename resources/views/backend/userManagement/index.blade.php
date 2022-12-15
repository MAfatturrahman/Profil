@extends('adminlte::page')
@extends('css.card')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        @if (auth()->user()->can('create-userManagement'))
            <a class="btn btn-success mb-3 mt-3" href="{{ route('userManagement.create') }}">Tambah</a>
        @endif
        <p class="btn btn-primary mb-3 mt-3">Halaman User</p>
    </div>

    @if ($message = Session::get('success'))
        <div id="peringatan" class="alert alert-success">
            <p class="notif-create">{{ $message }}</p>
        </div>
    @endif

    @if ($role->id === 1)
        <div class="my_card" style="width: 100%; margin: auto;">
            {{-- Table User Management --}}
            @php
                $heads = [['label' => 'No', 'no-export' => true, 'width' => 1], 'Nama', 'Email', 'Role', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
                $no = 1;
                
                $dataUserManagement = [];
                foreach ($user as $userManagement) {
                    $btnEdit = auth()
                        ->user()
                        ->can('edit-userManagement')
                        ? '<a href="' . route('userManagement.edit', $userManagement->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" ><i class="fa fa-lg fa-fw fa-pen"></i></a>'
                        : '';
                
                    $btnDelete = auth()
                        ->user()
                        ->can('delete-userManagement')
                        ? '<button class="btn btn-xs btn-default text-danger mx-1 shadow" type="submit" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></button>'
                        : '';
                
                    if ($userManagement->id == 1) {
                        $dataUserManagement[] = [$no++, $userManagement->name, $userManagement->email, $userManagement->getRoleNames()[0], '<form onsubmit="return confirm(\'Apa Kah Anda Yakin?\')" class="d-flex justify-content-center" method="POST" action="' . route('userManagement.destroy', $userManagement->id) . '">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"/>' . '</form></nobr>'];
                    } else {
                        $dataUserManagement[] = [$no++, $userManagement->name, $userManagement->email, $userManagement->getRoleNames()[0], '<form onsubmit="return confirm(\'Apa Kah Anda Yakin?\')" class="d-flex justify-content-center" method="POST" action="' . route('userManagement.destroy', $userManagement->id) . '">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"/>' . $btnEdit . $btnDelete . '</form></nobr>'];
                    }
                }
                
                $config = [
                    'data' => $dataUserManagement,
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, ['orderable' => false]],
                ];
            @endphp

            <x-adminlte-datatable id="table1" head-theme="navbar navbar-dark bg-primary" :heads="$heads">
                @foreach ($config['data'] as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            {{-- End Table Fasilitas --}}
        </div>
    @else
        <div class="my_card w-75" style="margin: auto">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label mb-3">Nama</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="name" placeholder="Nama" value="{{ $users->name }}"
                        required readonly>
                </div>

                <label class="col-sm-3 col-form-label mb-3">Email</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="email" placeholder="pengguna@gmail.com"
                        value="{{ $users->email }}" required readonly>
                </div>

                <label class="col-sm-3 col-form-label mb-3">Role</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="email" placeholder="pengguna@gmail.com"
                        value="{{ $users->getRoleNames()[0] }}" required readonly>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script>
        const massage = document.getElementById('peringatan');
        massage !== null && setTimeout(() => {
            massage.style.display = 'none'
        }, 3000);
    </script>
@endsection
