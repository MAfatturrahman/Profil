@extends('adminlte::page')
@extends('css.card')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        @if (auth()->user()->can('create-role'))
            <a class="btn btn-success mb-3 mt-3" href="{{ route('role.create') }}">Tambah</a>
        @endif
        <p class="btn btn-primary mb-3 mt-3">Halaman Role</p>
    </div>


    <div class="my_card" style="width: 100%; margin: auto;">
        @if ($message = Session::get('success'))
            <div id="peringatan" class="alert alert-success">
                <p class="notif-create">{{ $message }}</p>
            </div>
        @endif

        {{-- Table Role --}}
        @php
            $heads = [['label' => 'No', 'no-export' => true, 'width' => 5], 'Roles', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            $no = 1;
            
            $dataRole = [];
            foreach ($roles as $role) {
                $btnEdit = auth()
                    ->user()
                    ->can('edit-role')
                    ? '<a href="' . route('role.edit', $role->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" ><i class="fa fa-lg fa-fw fa-pen"></i></a>'
                    : '';
            
                $btnDelete = auth()
                    ->user()
                    ->can('delete-role')
                    ? '<button class="btn btn-xs btn-default text-danger mx-1 shadow" type="submit" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></button>'
                    : '';
            
                $btnDetails = auth()
                    ->user()
                    ->can('show-role')
                    ? '<a href="' . route('role.show', $role->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details"><i class="fa fa-lg fa-fw fa-eye"></i></a>'
                    : '';
            
                if ($role->id == 1) {
                    $dataRole[] = [$no++, $role->name, '<form class="d-flex justify-content-center">' . $btnDetails . '</form>'];
                } else {
                    $dataRole[] = [$no++, $role->name, '<form onsubmit="return confirm(\'Apa Kah Anda Yakin?\')" class="d-flex justify-content-center" method="POST" action="' . route('role.destroy', $role->id) . '">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"/>' . $btnEdit . $btnDelete . $btnDetails . '</form></nobr>'];
                }
            }
            
            $config = [
                'data' => $dataRole,
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
        {{-- End Table Role --}}
    </div>
@endsection


@section('js')
    <script>
        const massage = document.getElementById('peringatan');
        massage !== null && setTimeout(() => {
            massage.style.display = 'none'
        }, 3000);
    </script>
@endsection
