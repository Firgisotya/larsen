@extends('layouts.app')

@section('style')
    <style>
        #pdfViewer {
            width: 100%;
            overflow: auto;
            padding-bottom: 20px;
            /* Add some padding at the bottom to separate the PDF viewer from the download button */
        }

        /* CSS for PDF canvas */
        #pdfViewer canvas {
            display: block;
            margin: 0 auto;
            /* Center the canvas horizontally */
            max-width: 100%;
        }

        /* Optional: If you want to limit the width of the PDF viewer on larger screens */
        @media (min-width: 768px) {
            #pdfViewer {
                max-width: 800px;
                /* Adjust the max-width as needed */
                margin: 0 auto;
                /* Center the PDF viewer on larger screens */
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col shadow-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('tugas.index') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="d-inline">Detail Tugas</h1>
                            </div>
                        </div>
                        <hr>
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama Karyawan </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $tugas->karyawan->nama_karyawan }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama </h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>{{ $tugas->destinasi->nama_destinasi }}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Nama Tugas</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->nama_tugas }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Deskripsi Tugas</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->deskripsi_tugas }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Tanggal</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->tanggal }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Jam Mulai</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->jam_mulai }}
                                            </h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <h5>Jam Selesai</h5>
                                        </th>
                                        <th>:</th>
                                        <td>
                                            <h5>
                                                {{ $tugas->jam_selesai }}
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            @if (Illuminate\Support\Str::endsWith($file_path, '.pdf'))
                                <div id="pdfViewer"></div>
                            @elseif (Illuminate\Support\Str::endsWith($file_path, ['.jpg', '.png', '.jpeg']))
                                <img src="{{ asset($file_path) }}" alt="" class="img-fluid" width="100%">
                            @endif

                            @if (Illuminate\Support\Str::endsWith($file_path, ['.pdf', '.jpg', '.png', '.jpeg', 'PNG']))
                                <a href="/download-file/{{ $tugas->id }}" class="btn btn-info">
                                    <i class="fas fa-file-download"></i> Download File
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        const pdfPath = "{{ asset($file_path) }}"; // Ubah untuk memuat URL file PDF

        // Fungsi untuk menampilkan PDF menggunakan PDF.js
        function showPdf(pdfPath) {
            const pdfViewer = document.getElementById('pdfViewer');
            const loadingTask = pdfjsLib.getDocument(pdfPath);

            loadingTask.promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    const viewport = page.getViewport({
                        scale: 1
                    });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    pdfViewer.appendChild(canvas);

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    page.render(renderContext);
                });
            });
        }

        // Panggil fungsi untuk menampilkan PDF saat halaman selesai dimuat
        document.addEventListener("DOMContentLoaded", function() {
            showPdf(pdfPath);
        });
    </script>
@endsection
