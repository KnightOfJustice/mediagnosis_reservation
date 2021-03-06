<?php $this->load->helper('HTML');
?>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
<!--Autocomplete-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/easyAutocomplete-1.3.5/easy-autocomplete.min.css">

<!--Autofit for Textarea-->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.min.js"></script>
<!--Autocomplete-->
<script src="<?php echo base_url();?>assets/plugins/easyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script>
<style>
    .cd-error-message{
        font-size:12px;
        visibility: visible;
    }
    .lookup-btn:hover{
        background-color: #3c8dbc;
        color: #fff;
        cursor: pointer;
    }
    .hidden{
        display: none;
    }
    table.dataTable thead > tr > th{
        padding-right: 8px!important;
    }
    th.dt-center, td.dt-center { text-align: center; }
    .alert-header{
        margin: 0px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Form Pengisian Rekam Medis
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Form Pengisian Rekam Medis</a></li>
        <li class="active">Clinic</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="" id="content-container" >
        <div class="box-header">
            <h3 class="box-title">Data Awal Rekam Medis</h3>
        </div>

        <div class="box-body">
            <p>
            <div class="row">
                <div class="col-lg-8">
                    <button type="button" class="btn btn-success btn-xl" id="next-mr-btn">
                        <span class="glyphicon glyphicon-floppy-save"></span>&nbsp LANJUT
                    </button>
                </div>
            </div>
            </p>

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Reservasi</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form class="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="clinic-name-input" class="control-label cd-name">Klinik : </label>
                                    <span class="cd-error-message label label-danger" id="err-clinic-input"></span>
                                    <input type="text" class="form-control" id="clinic-name-input" name="clinic_name"
                                           data-label="#err-clinic-input"
                                           value="<?php echo $clinic_data->clinicName;?>" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="master-name-add" class="control-label cd-name">Tanggal Kunjungan :</label>
                                    <span class="cd-error-message label label-danger" id="err-reservation-date-input"></span>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservation-date" data-label="#err-reservation-date-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="poli-select" class="control-label cd-name">Pilih Poli :</label>
                                    <span class="cd-error-message label label-danger" id="err-poli-input"></span>
                                    <select class="form-control" id="poli-select" style="width: 100%;" tabindex="-1" aria-hidden="true" data-label="#err-poli-input">
                                        <option value="">--Pilih Poli--</option>
                                        <?php foreach($poli_data as $row){ ?>
                                            <option value="<?php echo $row['sClinicID'];?>" data-poli="<?php echo $row['poliID'];?>"><?php echo $row['poliName'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="master-name-add" class="control-label cd-name">Pilih Dokter :</label>
                                    <span class="cd-error-message label label-danger" id="err-doctor-input"></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control pull-right" id="doctor-input" data-label="#err-doctor-input" disabled="disabled">
                                        <span class="input-group-addon lookup-btn" id="lookup-doctor-btn">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="master-isactive-edit" class="control-label">Pilih Jenis Kunjungan :</label>
                                    <span class="cd-error-message label label-danger" id="err-reserve-type-input"></span>
                                    <input type="hidden" class="form-control" id="reserve-type-input" data-label="#err-reserve-type-input">
                                    <br/>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-reserve-type" data-status="bpjs" id="btn-type-bpjs">BPJS</button>
                                        <button type="button" class="btn btn-default btn-reserve-type" data-status="umum" id="btn-type-umum">UMUM</button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Pasien</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="master-name-add" class="control-label cd-name">Pilih Pasien :</label>
                                <span class="cd-error-message label label-danger" id="err-patient-input"></span>
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right" id="patient-input" data-label="#err-patient-input" disabled="disabled">
                                            <span class="input-group-addon lookup-btn" id="lookup-patient-btn">
                                                <i class="fa fa-search"></i>
                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Detil Pasien</h3>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Nama Pasien" id="patient-name-input" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">KTP</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Nomor KTP" id="patient-ktp-input" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">BPJS</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Nomor BPJS" id="patient-bpjs-input" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Jenis Kelamin</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Jenis Kelamin" id="patient-gender-input" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" placeholder="Alamat" id="patient-address-input" disabled="disabled">
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php $this->load->view('lookup/lookup_doctor_poli')?>
<?php $this->load->view('lookup/lookup_patient')?>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        var $base_url = "<?php echo site_url();?>/";
        var selected = [];

        autosize($('textarea'));

        $(".btn-reserve-type").click(function(){
            var $status = $(this).attr("data-status");
            if($status == "bpjs"){
                $("#btn-type-bpjs").removeClass("btn-default").addClass("btn-primary");
                $("#btn-type-umum").removeClass("btn-primary").addClass("btn-default");
                $("#reserve-type-input").val("bpjs");
            }else if($status == "umum"){
                $("#btn-type-bpjs").removeClass("btn-primary").addClass("btn-default");
                $("#btn-type-umum").removeClass("btn-default").addClass("btn-primary");
                $("#reserve-type-input").val("umum");
            }
        });

        //Date picker
        $('#reservation-date').datepicker({
            autoclose: true,
            format: 'dd-MM-yyyy'
        });

        $("#poli-select").change(function() {
            $("#doctor-input").val("");
            $("#doctor-input").attr("data-value","");
            //alert(this.value);
        });

        $('#lookup-doctor-btn').click(function(){
            var $poli = $("#poli-select").val();
            if($poli != ""){
                // Quickly and simply clear a table
                $('#table-lookup-doctor').dataTable().fnClearTable();
                // Restore the table to it's original state in the DOM by removing all of DataTables enhancements, alterations to the DOM structure of the table and event listeners
                $('#table-lookup-doctor').dataTable().fnDestroy();

                $.ajax({
                    url: $base_url+"Doctor/getLookupDoctorList",
                    data: {sClinic : $poli},
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    success:function(data){
                        if(data.status != "error"){
                            renderDoctorData(data);
                            $("#lookup-doctor-modal").modal("show");
                            $(".overlay").hide();
                        }else{
                            alertify.alert(data.msg).setHeader("<h3 class='alert-header text-red'>Error</h3>");
                            $(".overlay").show();
                        }
                    },
                    error: function(xhr, status, error) {
                        //var err = eval("(" + xhr.responseText + ")");
                        //alertify.error(xhr.responseText);
                        alertify.error("Cannot response server !");
                    }
                });

            }else{
                alertify.alert("Anda belum memilih Poli, silahkan cek kembali...").setHeader("<h3 class='alert-header text-red'>Error</h3>");
            }
        });

        function renderDoctorData($data){
            //alert(JSON.stringify($data.data));
            $('#table-lookup-doctor').DataTable( {
                "aaData": $data.data,
                "lengthChange": false,
                "autoWidth": false,
                "aoColumns": [
                    { "mDataProp": "doctorName"},
                    { "mDataProp": "doctorID"}
                ],
                "columnDefs": [
                    {
                        "width": "80%",
                        "targets": 0
                    },
                    {
                        "width": "20%",
                        "targets": [ -1 ], //last column
                        "orderable": false,//set not orderable
                        "className": "dt-center",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var $btn_add = $("<button>", { class:"btn btn-primary btn-xs add-doctor-btn","type": "button",
                                "data-value": cellData, "data-name": rowData.doctorName });
                            $btn_add.append("<span class='glyphicon glyphicon-plus'></span>&nbsp PILIH");
                            $(td).html($btn_add);
                        }
                    },
                ]
            } );
        }

        $('#table-lookup-doctor tbody').on('click', 'button.add-doctor-btn', function () {
            var $id =  $(this).attr("data-value");
            var $name =  $(this).attr("data-name");
            // SET DATA
            $("#doctor-input").val($name);
            $("#doctor-input").attr("data-value",$id);

            // Close Lookup
            $("#lookup-doctor-modal").modal("hide");
        });

        $('#lookup-patient-btn').click(function(){
            var $clinic = "<?php echo $clinic_data->clinicID;?>";
            var $isOpen = $("#lookup-patient-modal").attr("data-isopen");

            if($isOpen != 0){
                $.ajax({
                    url: $base_url+"Patient/getLookupPatientList",
                    data: {clinic : $clinic},
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    success:function(data){
                        if(data.status != "error"){
                            $("#lookup-patient-modal").attr("data-isopen","0");
                            renderPatientData(data);
                            $("#lookup-patient-modal").modal("show");
                            $(".overlay").hide();
                        }else{
                            alertify.alert(data.msg).setHeader("<h3 class='alert-header text-red'>Error</h3>");
                            $(".overlay").show();
                        }
                    },
                    error: function(xhr, status, error) {
                        //var err = eval("(" + xhr.responseText + ")");
                        //alertify.error(xhr.responseText);
                        alertify.error("Cannot response server !");
                    }
                });
            }else{
                $("#lookup-patient-modal").modal("show");
            }
        });

        function renderPatientData($data){
            //alert(JSON.stringify($data.data));
            $('#table-lookup-patient').DataTable( {
                "aaData": $data.data,
                "lengthChange": false,
                "autoWidth": false,
                "aoColumns": [
                    { "mDataProp": "patientName"},
                    { "mDataProp": "ktpID"},
                    { "mDataProp": "bpjsID"},
                    { "mDataProp": "gender"},
                    { "mDataProp": "address"},
                    { "mDataProp": "patientID"}
                ],
                "columnDefs": [
                    {
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "width": "15%",
                        "targets": 1
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    },
                    {
                        "width": "10%",
                        "targets": 3
                    },
                    {
                        "width": "40%",
                        "targets": 4
                    },
                    {
                        "width": "10%",
                        "targets": [ -1 ], //last column
                        "orderable": false,//set not orderable
                        "className": "dt-center",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            var $btn_add = $("<button>", { class:"btn btn-primary btn-xs add-patient-btn","type": "button",
                                "data-value": cellData, "data-name": rowData.patientName,"data-ktp": rowData.ktpID,
                                "data-bpjs": rowData.bpjsID,"data-gender": rowData.gender,"data-address": rowData.address});
                            $btn_add.append("<span class='glyphicon glyphicon-plus'></span>&nbsp PILIH");
                            $(td).html($btn_add);
                        }
                    },
                ]
            } );
        }

        $('#table-lookup-patient tbody').on('click', 'button.add-patient-btn', function () {
            var $id =  $(this).attr("data-value");
            var $name =  $(this).attr("data-name");
            var $ktp =  $(this).attr("data-ktp");
            var $bpjs =  $(this).attr("data-bpjs");
            var $gender =  $(this).attr("data-gender");
            var $alamat =  $(this).attr("data-address");

            // SET DATA
            $("#patient-input").val($name);
            $("#patient-input").attr("data-value",$id);

            $("#patient-name-input").val($name);
            $("#patient-ktp-input").val($ktp);
            $("#patient-bpjs-input").val($bpjs);
            $("#patient-gender-input").val($gender);
            $("#patient-address-input").val($alamat);

            // Close Lookup
            $("#lookup-patient-modal").modal("hide");
        });

        $("#next-mr-btn").click(function(){
            if(validateInput()){
                var $clinic = "<?php echo $clinic_data->clinicID;?>";
                var $poli = $("#poli-select").find('option:selected').data('poli');
                var $reserve_date = $("#reservation-date").data('datepicker').getFormattedDate('yyyy-mm-dd');
                var $doctor = $("#doctor-input").attr("data-value");
                var $patient = $("#patient-input").attr("data-value");
                var $reserve_type =  $("#reserve-type-input").val();

                var $data = {
                    clinic : $clinic,
                    poli : $poli,
                    doctor : $doctor,
                    patient : $patient,
                    reserve_date : $reserve_date,
                    reserve_type : $reserve_type
                }

                $.ajax({
                    url: $base_url+"MedicalRecord/saveHeaderReservationManual",
                    data: $data,
                    type: "POST",
                    dataType: 'json',
                    cache:false,
                    success:function(data){
                        if(data.status != "error"){
                            location.href = "<?php echo site_url("MedicalRecord/goToDetailMedicalRecordManual")?>";
                        }else{
                            alertify.alert(data.msg).setHeader("<h3 class='alert-header text-red'>Error</h3>");
                            $(".overlay").show();
                        }
                    },
                    error: function(xhr, status, error) {
                        //var err = eval("(" + xhr.responseText + ")");
                        //alertify.error(xhr.responseText);
                        alertify.error("Cannot response server !");
                    }
                });

            }
        });

        function validateInput(){
            var $err=0;
            var $clinic = "<?php echo $clinic_data->clinicID;?>";
            var $poli = $("#poli-select");
            var $reserve_date = $("#reservation-date");
            var $reserve_date_val = $reserve_date.data('datepicker').getFormattedDate('yyyy-mm-dd');
            var $doctor = $("#doctor-input");
            var $patient = $("#patient-input");
            var $reserve_type = $("#reserve-type-input");

            $(".cd-error-message").html("");

            if($poli.val() == ""){
                $err=1;
                var $label_err = $($poli).attr("data-label");
                showErrorLabel($label_err, "Poli tidak boleh kosong..");
            }
            if($reserve_date_val == ""){
                $err=1;
                var $label_err = $($reserve_date).attr("data-label");
                showErrorLabel($label_err, "Tanggal Kunjugan tidak boleh kosong..");
            }
            if($doctor.attr("data-value")=="" || $doctor.attr("data-value")==null ){
                $err=1;
                var $label_err = $($doctor).attr("data-label");
                showErrorLabel($label_err, "Dokter tidak boleh kosong..");
            }
            if($patient.attr("data-value")=="" || $patient.attr("data-value")==null){
                $err=1;
                var $label_err = $($patient).attr("data-label");
                showErrorLabel($label_err, "Pasien tidak boleh kosong..");
            }

            if($reserve_type.val() == ""){
                $err=1;
                var $label_err = $($reserve_type).attr("data-label");
                showErrorLabel($label_err, "Jenis Kunjungan tidak boleh kosong..");
            }

            if($err!=0){
                alertify.alert("Data yang Anda masukan belum lengkap, Silahkan diperiksa kembali..").setHeader("<h3 class='alert-header text-red'>Error</h3>");
                return false;
            }else{
                return true;
            }
        }

        function showErrorLabel($element, $msg){
            $($element).html($msg);
        }
    });
</script>