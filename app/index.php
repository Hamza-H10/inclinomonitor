<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inclino Device Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

</head>

<body>
    <div class="container mt-5">
        <h2>Inclino Device Data</h2>
        <!-- DataTable -->
        <table id="deviceDataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Date Time</th>
                    <th>Device Number</th>
                    <th>Sensor</th>
                    <th>X Angle(Deg)</th>
                    <th>Y Angle(Deg)</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <!-- DataTables Buttons - Export buttons -->
        <!-- <div class="mt-3">
        <button class="btn btn-primary" id="exportCSV">Export to CSV</button>
        <button class="btn btn-success" id="exportExcel">Export to Excel</button>
    </div> -->
        <!-- Graph Button -->
        <a href="inclino_graph.php" class="btn btn-primary mt-3">Show Graph</a>
    </div>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function() {
            // DataTable Initialization
            var dataTable = $('#deviceDataTable').DataTable({
                "ajax": {
                    "url": "inclino_api.php", // Relative path to the file
                    "dataSrc": "data"
                },
                "columns": [{
                        "data": "date_time"
                    },
                    {
                        "data": "device_number"
                    },
                    {
                        "data": "sensor"
                    },
                    {
                        "data": "value1"
                    },
                    {
                        "data": "value2"
                    }
                ],
                // DataTables Buttons - Export buttons configuration
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ]
            });

            // Export to CSV button click event
            $('#exportCSV').on('click', function() {
                dataTable.button('csv').trigger();
            });

            // Export to Excel button click event
            $('#exportExcel').on('click', function() {
                dataTable.button('excel').trigger();
            });
        });
    </script>

</body>

</html>