@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Role Permission</h1>
            </div>
            <div class="col">
                <div class="text-end">
                    <a href="{{ route('role.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Role Permission
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->nama_role }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- edit --}}
                                            <a href="{{ route('role.edit', $item->id) }}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('role.destroy', $item->id) }}" method="POST"
                                                class="d-inline" id="data-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="{{ $item->nama_role }}" data-id="{{ $item->id }}"><i
                                                        class='fa fa-trash'></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

@section('script')
<script>
    const deleteButton = document.querySelectorAll('.delete');
      deleteButton.forEach((dBtn) => {
          dBtn.addEventListener('click', function (event) {
              event.preventDefault();

              const roleId = this.dataset.id;
              const roleName = this.dataset.name;
              Swal.fire({
                  title: 'Anda Yakin Menghapus Data Ini ?',
                  text: "Nama Divisi : " + roleName,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              const dataId = document.getElementById('data-' + roleId);
                              dataId.submit();
                          }
              })
          })
      });
  </script>
@endsection
@endsection
