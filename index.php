<?php
    include('eTables.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Error Logger</title>

    <!-- Custom fonts for this template -->
    <link href="external/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/saf.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="external/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script type="text/javascript">
        function readLog(inputFile){
            let fr = new FileReader();
            let readingFile = inputFile.files[0];
            fr.readAsText(readingFile);
            fr.onload = function() {
                getStr(fr.result);
            }
            // let file = inputFile.files[0];
            // alert(`File name: ${file.name}`);
        }
        function getStr(viewedData) {
            let error_date = viewedData.substring(0, 10);
            const logs = viewedData.split(error_date);
            for (let i = 1; i < logs.length; i++) {
                const splitIndivError = logs[i].split('|');
                let error_time = splitIndivError[0];
                let error_type = splitIndivError[5];
                let error_spec = null;
                if (!(splitIndivError[2].includes("Internal"))) {
                    const splitForSpec = splitIndivError[6].split('at ');
                    error_spec = splitForSpec[0];
                }
                let error_file = null;
                let error_line = null;
                if (logs[i].includes("C:\\agent\\_work\\7\\s\\")) {
                    const splitForFile1 = logs[i].split('C:\\agent\\_work\\7\\s\\');
                    const splitForFile2 = splitForFile1[1].split(':line');
                    error_file = splitForFile2[0];
                    error_line = splitForFile2[1].substring(0,5);
                }
                // console.log("Information: " + error_date + ", " + error_time + ", " + error_type + ", " + error_spec + ", " + error_file + ", " + error_line);

                $.ajax({
                     type: "GET",
                     url: 'addError.php',
                     data: {err_date: error_date, err_time: error_time, err_type: error_type, err_spec: error_spec, err_file: error_file, err_line: error_line},
                     success: function(response) {
                         console.log(response);
                     }
                });
            }
        }
    </script>

</head>

<body id="page-top">
<br>
<br>
<h1 class = "m-0 font-weight-bold text-secondary" style = "text-align: center"> Novarata Error Logger</h1>
<hr>
<br>
<br>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <pre id="output" class="text-secondary"></pre>
            <div class="container-fluid">
                <div class="uploadError">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Upload Log</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <input type="file" id="myFile" name="myFile" onchange="readLog(this)">
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">DB</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="errTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th>Frequency</th>
                                    <th>File</th>
                                    <th>Line</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="external/jquery/jquery.min.js"></script>
<script src="external/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="external/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/saf.min.js"></script>

<!-- Page level plugins -->
<script src="external/datatables/jquery.dataTables.min.js"></script>
<script src="external/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/tableLister.js"></script>


</body>

</html>