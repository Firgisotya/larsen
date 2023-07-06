@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow-lg">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Divisi</h1>
            </div>
            <div class="col">
                <div class="text-end">
                    <a href="{{ route('divisi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Divisi
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
                                <th scope="col">Nama Divisi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisi as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $item->nama_divisi }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- edit --}}
                                            <a href="{{ route('divisi.edit', $item->id) }}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('divisi.destroy', $item->id) }}" method="POST"
                                                class="d-inline" id="data-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp me-1 delete"
                                                    data-name="{{ $item->nama_divisi }}" data-id="{{ $item->id }}"><i
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

              const divisiId = this.dataset.id;
              const divisiName = this.dataset.name;
              Swal.fire({
                  title: 'Anda Yakin Menghapus Data Ini ?',
                  text: "Nama Divisi : " + divisiName,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              const dataId = document.getElementById('data-' + divisiId);
                              dataId.submit();
                          }
              })
          })
      });
  </script>
@endsection
@endsection
