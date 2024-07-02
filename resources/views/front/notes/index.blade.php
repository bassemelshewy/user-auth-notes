@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="box">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h3 class="box-title">Notes</h3>
                    <a href="{{ route('notes.create') }}" class="btn btn-info btn-sm">
                        Add New
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            var token = "{{ csrf_token() }}";
            $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('notes.search') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        "_token": token
                    }
                },
                "columnDefs": [{
                        "targets": [0], // column or columns numbers
                        "orderable": true // set orderable for selected columns
                    },
                    {
                        "targets": [1, 2],
                        "render": function(data, type, row) {
                            return '<div style="white-space: normal;">' + data + '</div>';
                        },
                    },
                ],
                "order": [
                    [0, "dasc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault()
            if (confirm('Are you sure?')) {
                $(e.target).closest('form').submit()
            }
        });
    </script>
@stop
