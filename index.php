<?php
require_once 'includes/session.php';
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Task Manager</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <header>
        <nav id="navbar" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php"><b>TM</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Tasks</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="logout.php" class="btn btn-secondary" type="submit">Logout</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">

        <div class="container  mt-5">
            <div class="row justify-content-start align-items-center">
                <div class="col-4">
                    <h1>Tasks</h1>
                </div>
                <div class="col-3">
                    <button id="openModalButton" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#uploadImageModal">Upload Image</button>
                </div>
            </div>
            <table id="data-table" class="table table-bordered table-striped mt-5">
                <div class="col-md-3 float-end">
                    <input id="search-input" type="text" class="form-control form-control-sm" placeholder="Search tasks...">

                </div>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Color Code</th>
                        <th>Last Refresh</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Copyright &copy; 2024.</span>
        </div>
    </footer>
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-thumbnail" id="selected-image" src="#" alt="Selected Image" style="display: none;">
                    <input class="form-control mt-2" type="file" id="image-input" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Fetch and load data on the table on page load
        function fetchDataAndPopulateTable() {
            $.ajax({
                url: 'includes/api-handler.php',
                method: 'GET',
                success: function(data) {
                    var tasks = JSON.parse(data);
                    var tableBody = $('#data-table tbody');
                    tableBody.empty();
                    tasks.forEach(function(task) {
                        var row = $('<tr>');
                        row.append($('<td>').text(task.task));
                        row.append($('<td>').text(task.title));
                        row.append($('<td>').text(task.description));
                        if (task.colorCode) {
                            // If colorCode exists, create a cell with the colorCode as the background color
                            var colorCell = $('<td>').text(task.colorCode);
                            colorCell.css('background-color', task.colorCode);
                            row.append(colorCell);
                        } else {
                            var defaultCell = $('<td>').text('No color code provided');
                            row.append(defaultCell);
                        }
                        var timestampCell = $('<td>').text(new Date().toLocaleString());
                        row.append(timestampCell);
                        tableBody.append(row);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401) {

                        // Redirect to the login page
                        window.location.href = '/login.php'; // Replace with the path to your login page
                    } else {
                        console.error('An error occurred: ', textStatus, ', ', errorThrown);
                    }
                }
            });
        }

        //Search functionality
        $('#search-input').on('input', function() {
            var value = $(this).val().toLowerCase();
            $('#data-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
        fetchDataAndPopulateTable();

        //Refresh the table every 60 minutes 
        setInterval(fetchDataAndPopulateTable, 60 * 60 * 1000);

        $('#image-input').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#selected-image').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(this.files[0]);
        });

        //Reset the image and the input when the modal is dismissed
        $('#uploadImageModal').on('hidden.bs.modal', function(e) {
            // Reset the image
            $('#selected-image').attr('src', '').hide();
            // Clear the file input
            $('#image-input').val('');
        });
    </script>
</body>

</html>