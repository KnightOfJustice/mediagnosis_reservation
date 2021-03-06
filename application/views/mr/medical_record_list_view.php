<!DOCTYPE html>
<!-- By Designscrazed.com , just a structure for easy usage. -->

<html lang='en'>
<head>
    <meta charset="UTF-8" />
    <title>
        Mediagnosis | MRIS
    </title>
    <!--Main CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/doctor.css">
    <!--Grid W3 System-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/grid.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <!--Sweet Alert-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <!--DatePicker-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-material-datepicker/css/bootstrap-material-datetimepicker.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Alertify -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/alertify/alertify.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/alertify/themes/default.min.css">

    <!--Sweet Alert-->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url();?>assets/plugins/alertify/alertify.min.js"></script>
    <!--Select2-->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!--DatePicker-->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datepicker/js/moment.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datepicker/js/bootstrap-material-datetimepicker.js"></script>

</head>
<style>

    #btn-save-medical-record,#btn-cancel-medical-record{
        margin-top: 32px;
        padding-left: 128px;
        padding-right: 128px;
        padding-top: 24px;
        padding-bottom: 24px;
    }
    .w3-padding-lr{
        padding-left: 12px;
        padding-right: 12px;
    }

    .fa-icon{
        font-size: 70px;
    }
    .search-btn-container button{
        min-width: 150px;
    }
    .hiden{
        display: none;
    }
    .search-text-container{
        margin-top: -30px;
    }
</style>
<body>
<!--  Start here -->

<body>
<div class="headline">

    <h6></h6>
    <h1>
        <b>REKAM MEDIS</b>
    </h1>
    <h6></h6>
    <h2><?php echo $patient_data->patientName;?></h2>
    <input type="hidden" id="detail-reservation-value" value="<?php echo $detail_reservation;?>"/>
</div>

<div id="wrap">
    <div class="we-col-m12">
        <div class="w3-col m12 l6 w3-left search-text-container">
            <div class="w3-padding w3-margin-left">
                <label class="w3-label w3-text-teal"><b>Kata Kunci</b></label>
                <input class="w3-input w3-border" id="table-search-input" placeholder="Kata yang di cari" type="text">
            </div>
        </div>
        <div class="w3-btn-group w3-right search-btn-container">
            <button id="btn-search-all" class="w3-btn w3-padding-medium w3-margin-left w3-teal">ALL</button>
            <button onclick="document.getElementById('id01').style.display='block'"
                    id="btn-search-date" class="w3-btn w3-padding-medium w3-margin-left w3-teal">TANGGAL</button>
            <button onclick="document.getElementById('id01').style.display='block'"
                        id="btn-search-period" class="w3-btn w3-padding-medium w3-margin-left w3-teal">PERIODE</button>
        </div>
        <div class="w3-clear"></div>
    </div>
    <div id="accordian">
        <div class="w3-row content">
            <div class="w3-col m12">
                <table id="dataTables-mr" class="w3-table">
                    <thead>
                        <tr class="hidden">
                            <th></th>
                            <th>disease</th>
                            <th>clinic</th>
                            <th>poli</th>
                            <th>doctor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($medical_record_data as $row){?>
                        <tr class="w3-card-4 w3-margin">
                            <td class="w3-padding-16 w3-hover-green">
                                <div class="w3-row">
                                    <div class="w3-col m6">
                                        <div class="w3-padding-medium w3-left w3-circle ">
                                            <i class="fa fa-file-text fa-icon"></i>
                                        </div>
                                        <span class="w3-xlarge">
                                            <?php
                                                $date_created=date_create($row['created']);
                                                echo date_format($date_created,"d F Y");
                                            ?>
                                        </span><br>
                                        <span class="w3-large"><?php echo $row['clinicName']." - ".$row['poliName'];?></span><br>
                                        <span class="w3-large"><?php echo $row['doctorName'];?></span>
                                    </div>
                                    <div class="w3-col m6">
                                        <div class="w3-padding-medium w3-left w3-circle ">
                                            <i class="fa fa-stethoscope fa-icon"></i>
                                        </div>
                                        <span class="w3-large">DIAGNOSA</span><br>
                                        <span class="w3-large"><b><?php echo $row['diseaseName'];?></b></span><br>
                                        <div class="w3-padding-medium">
                                            <a href="<?php echo site_url("MedicalRecord/getMedicalRecordDetail/".$detail_reservation."/".$row['patientID']."/".$row['medicalRecordID']);?>">
                                                <button class="w3-btn w3-light-grey"> <i class="fa fa-search"></i> Lihat Detail</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden"><?php echo $row['diseaseName'];?></td>
                            <td class="hidden"><?php echo $row['clinicName'];?></td>
                            <td class="hidden"><?php echo $row['poliName'];?></td>
                            <td class="hidden"><?php echo $row['doctorName'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--MODAL-->
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <form class="w3-container w3-margin-top" action="">
                <div class="w3-section">
                    <div id="search-date-field">
                        <label><b>Pilih Tanggal</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" id="date" type="text" placeholder="Tahun-Bulan-tanggal" required>
                    </div>

                    <div id="search-period-field">
                        <label><b>Periode</b></label>
                        <div class="w3-row">
                            <div class="w3-half">
                                <input class="w3-input w3-border" id="date-start" type="text" placeholder="Tanggal Mulai" name="psw">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" id="date-end" type="text" placeholder="Sampai Tanggal" name="psw">
                            </div>
                        </div>
                    </div>
                    <button class="w3-btn-block w3-green w3-section w3-padding" id="btn-search-modal" data-search="" type="button">CARI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Data Table -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#date').bootstrapMaterialDatePicker
        ({
            time: false,
            clearButton: true
        });

        $('#date-end').bootstrapMaterialDatePicker
        ({
            weekStart: 0, time: false
        });
        $('#date-start').bootstrapMaterialDatePicker
        ({
            weekStart: 0, time: false
        }).on('change', function(e, date)
        {
            $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $("#btn-search-date").click(function(){
            $("#search-period-field").hide();
            $("#search-date-field").show();
            $("#btn-search-modal").attr("data-search","date");
        });
        $("#btn-search-period").click(function(){
            $("#search-date-field").hide();
            $("#search-period-field").show();
            $("#btn-search-modal").attr("data-search","period");
        });
        $("#btn-search-all").click(function(){
            var $patient = "<?php echo $patient_data->patientID;?>";
            var $detail_reservation = "<?php echo $detail_reservation;?>";
            $base_url = "<?php echo site_url("MedicalRecord/getMedicalRecordList");?>";

            $base_url += "/"+$detail_reservation+"/"+$patient;
            location.href = $base_url;
        });

        $("#btn-search-modal").click(function(){
            var $base_url,$data;
            var $search = $("#btn-search-modal").attr("data-search");
            var $patient = "<?php echo $patient_data->patientID;?>";
            var $detail_reservation = "<?php echo $detail_reservation;?>";

            if($search == "date"){
                $base_url = "<?php echo site_url("MedicalRecord/getMedicalRecordBySearchDate");?>";
                var $date = $('#date').val();

                $base_url += "/"+$detail_reservation+"/"+$patient+"/"+$date;
                location.href = $base_url;

            }else if($search == "period"){
                $base_url = "<?php echo site_url("MedicalRecord/getMedicalRecordBySearchPeriod");?>";
                var $start_date = $('#date-start').val();
                var $end_date = $('#date-end').val();

                $base_url += "/"+$detail_reservation+"/"+$patient+"/"+$start_date+"/"+$end_date;
                location.href = $base_url;
            }

        });

        function renderList(){
            var $li = $("<li>", {class: "w3-padding-16 w3-hover-green"});
            var $row = $("<div>", {class: "w3-row"});
            var $container_1 = $("<div>", {class: "w3-col m6"});
            var $icon_container_1= $("<div>", {class: "w3-padding-medium w3-left w3-circle"});
            var $icon_1= $("<i>", {class: "fa fa-file-text fa-icon"});
            var $container_2 = $("<div>", {class: "w3-col m6"});
            var $icon_container_2= $("<div>", {class: "w3-padding-medium w3-left w3-circle"});
            var $icon_2= $("<i>", {class: "fa fa-stethoscope fa-icon"});

            var $date = $("<span>", {class: "w3-xlarge"}).text("date");
            var $clinic = $("<span>", {class: "w3-large"}).text("clinic");
            var $doctor = $("<span>", {class: "w3-large"}).text("doctor");
            var $text_1 = $("<span>", {class: "w3-large"}).text("DIAGNOSA");
            var $disease = $("<span>", {class: "w3-large"}).text("disease").css("font-weight","Bold");

            var $button_container = $("<div>", {class: "w3-padding-medium"});
            var $a_href = $("<a>", {class: "w3-padding-medium"});
            var $button_detail = $("<div>", {class: "w3-btn w3-light-grey"});
            var $icon_search = $("<i>", {class: "fa fa-search"});

            //button search
            $icon_search.appendTo($button_detail);
            $("<span>LIHAT DETAIL</span>").appendTo($button_detail);
            $button_detail.appendTo($a_href);
            $a_href.appendTo($button_container);

            // INFO MEDICAL RECORD
            $icon_1.appendTo($icon_container_1);
            $icon_container_1.appendTo($container_1);
            $date.appendTo($container_1);
            $("<br>").appendTo($container_1);
            $clinic.appendTo($container_1);
            $("<br>").appendTo($container_1);
            $doctor.appendTo($container_1);

            // INFO DIAGNOSE
            $icon_2.appendTo($icon_container_2);
            $icon_container_2.appendTo($container_2);
            $text_1.appendTo($container_2);
            $("<br>").appendTo($container_2);
            $disease.appendTo($container_2);
            $("<br>").appendTo($container_2);
            $button_container.appendTo($container_2);

            $row.append($container_1);
            $row.append($container_2);
            $li.append($row);

            var $ul = $("ul#mr-ul");
            $li.appendTo($ul);
        }

        var data_table_mr = $('#dataTables-mr').DataTable( {
            bFilter: false,
            dom: 't',
            searching: true,
            "pageLength": 15,
            "lengthChange": false,
            "autoWidth": false,
            "columnDefs": [
                {
                    "targets": 0,
                    "searchable": false
                }
            ]
        } );

        $('#table-search-input').keyup(function(){
            data_table_mr.search($(this).val()).draw() ;
        })
    });
</script>
</body>
</html>
