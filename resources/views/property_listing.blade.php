<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Property Details List View</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
        
    </head>
    <body>
        
        <div class="container">
            <h2>Property Details List View</h2>
            <table class="table table-striped table-bordered data-table" style="width:100%" id="list_view">
                <thead>
                    <tr>
                        <th>#</th>
                        <!-- <th>House ID</th> -->
                        <!-- <th>Property Address</th> -->
                        <th>Task Title</th>
                        <th>Task ID</th>
                        <th>Updated Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <script>
            // $(document).ready(function() {
            //     var table = $('#list_view').DataTable( {
            //         "lengthChange": false,
            //         "pageLength": 5,
            //         "responsive": true
            //     });
            // } );
                var table = $('.data-table').DataTable({

                    processing: true,
                    pageLength: 5,

                    serverSide: true,

                    ajax: "{{ route('list') }}",

                    columns: [

                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                        {data: 'title', name: 'title'},

                        {data: 'task_id', name: 'task_id'},
                        {data: 'assigned_created_at', name: 'assigned_created_at'},

                        // {data: 'action', name: 'action', orderable: false, searchable: false},

                    ]

                });
        </script>
    </body>
</html>
