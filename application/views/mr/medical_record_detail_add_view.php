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
    <!--Font Awesome-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <!--Autocomplete-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/easyAutocomplete-1.3.5/easy-autocomplete.min.css">
    <!--Sweet Alert-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.css">

    <!--Sweet Alert-->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!--Select2-->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!--Autofit for Textarea-->
    <script src="<?php echo base_url();?>assets/plugins/autosize/autosize.min.js"></script>
    <!--Autocomplete-->
    <script src="<?php echo base_url();?>assets/plugins/easyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script>

</head>
<style>
    #identity-table{
        width: 100%;
        position: relative;
    }
    #identity-table tr td{
        padding: 10px;
        margin-top: 10px;
        font-size: 16px;
    }
    #identity-table tr td:first-child{
        width: 35%;
        min-width: 250px;
    }
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
    .margin-wrap{
        width: 90%;
        margin: 20px auto;
    }
    #back-to-top-btn{
        position: fixed;
        bottom: 10%;
        right: 10px;
        z-index: 99;
    }
</style>
<body>

<button id="back-to-top-btn" class="w3-btn w3-xlarge w3-teal w3-padding">
    <i class="fa fa-chevron-up"></i>
</button>

    <div class="headline">

        <h6></h6>

        <h1>
            <b><?php echo $header_data->clinicName;?></b> - <b><?php echo $header_data->poliName;?></b>
            <h6></h6>
        </h1>
        <h4> <?php echo $header_data->clinicAddress;?></h4>
        <h1>
            <b>REKAM MEDIS</b>
        </h1>

    </div>

<div class="w3-container w3-row margin-wrap">
    <div class="w3-col m6">
        <span class="w3-large w3-text-green">Diperiksa oleh : <?php echo $header_data->doctorName;?></span>
    </div>
    <div class="w3-col m6 w3-right-align">
        <span class="w3-large w3-text-green" id="date-name"></span>
        <span class="w3-large w3-text-green">, pkl </span>
        <span class="w3-large w3-text-green" id="time-name"></span>
    </div>
</div>
<div id="wrap">
    <div id="accordian">
        <div class="step" id="step1">
            <div class="number">
                <span>1</span>
            </div>
            <div class="title">
                <h1>IDENTITAS PASIEN</h1>
            </div>
            <div class="modify">
                <i class="fa fa-plus-circle"></i>
            </div>
        </div>
        <div class="content w3-row" id="email">
            <div class="w3-col m6">


            </div>
            <div class="w3-col m6">
                <table class="w3-table-all w3-hoverable" id="identity-table">
                    <tr>
                        <td>No. Kartu BPJS</td>
                        <td><?php echo $patient_data->bpjsID;?></td>
                    </tr>
                    <tr>
                        <td>NO KTP</td>
                        <td><?php echo $patient_data->ktpID;?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $patient_data->patientName;?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>
                            <?php
                            $date_created=date_create($patient_data->dob);
                            echo date_format($date_created,"d F Y");?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td><?php echo $patient_data->gender;?></td>
                    </tr>
                    <tr>
                        <td>Status Peserta</td>
                        <td><?php echo $patient_data->participantStatus;?></td>
                    </tr>
                    <tr>
                        <td>Jenis Peserta</td>
                        <td><?php echo $patient_data->participantType;?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?php echo $patient_data->address;?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><?php echo $patient_data->phoneNumber;?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- HASIL PEMERIKSAAN -->
        <div class="step" id="step2">
            <div class="number">
                <span>2</span>
            </div>
            <div class="title">
                <h1>HASIL PEMERIKSAAN</h1>
            </div>
            <div class="modify">
                <i class="fa fa-plus-circle"></i>
            </div>
        </div>
        <div class="content w3-row">
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-bottombar w3-border-blue w3-margin-right">
                    <h4>SUBJEKTIF</h4>
                </div>

                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4>KELUHAN UTAMA   <!--ERROR MSG--><span class="w3-tag w3-red err-msg" id="main-condition-err-msg"></span></h4>
                    </div>

                    <div class="w3-container">
                        <p>
                            <textarea class="w3-input" id="main-condition-text"
                                data-ul="#main-condition-ul" data-li="#main-condition-value"
                                data-label="#main-condition-err-msg"></textarea>

                            <!--VALUE-->
                            <ul class="w3-ul w3-card-4 w3-hide" id="main-condition-ul">
                                <li class="w3-padding-8">
                                    <span class="w3-large" id="main-condition-value" data-value="" data-status=""></span>
                                      <span
                                          data-input-value="#main-condition-value"
                                            data-input-element="#main-condition-text"
                                            data-ul="#main-condition-ul"
                                            class="w3-closebtn w3-margin-right w3-medium"><i class="fa fa-pencil"></i></span>
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>

                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4>MULAI SEJAK  <span class="w3-tag w3-red err-msg" id="condition-date-err-msg"></span></h4>
                    </div>
                    <div class="w3-container">
                        <p>
                            <textarea class="w3-input" id="condition-date-text" data-label="#condition-date-err-msg"></textarea>
                            <br/>
                            <!--ERROR MSG-->
                        </p>
                    </div>
                </div>

                <!--ADDITIONAL CONDITION-->
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">KELUHAN TAMBAHAN           <!--ERROR MSG-->
                            <span class="w3-tag w3-red err-msg" id="add-condition-err-msg"></span></h4>
                    </div>
                    <div class="w3-container w3-margin-top">

                        <p>
                            <ul class="w3-ul w3-card-4 w3-ul-list" id="additional-condition-ul">
                                <li class="w3-padding-8">
                                    <span class="w3-closebtn w3-closebtn-list w3-large w3-margin-right">x</span><br/>
                                    <div class="w3-medium w3-padding-medium">
                                        <textarea class="w3-input add-codition-li-text" data-label="#add-condition-err-msg"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </p>
                        <button class="w3-btn w3-round-xxlarge w3-ripple w3-left w3-red w3-margin"
                                id="btn-add-additional-condition">+ TAMBAH BARU</button>
                    </div>
                </div>
            </div>

            <div class="w3-col m6 w3-padding-small">
                <div class="w3-bottombar w3-border-blue w3-margin-right">
                    <h4>OBJEKTIF</h4>
                </div>

                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4>PEMERIKSAAN FISIK</h4>
                    </div>

                    <form class="w3-container">
                        <p>
                            <label class="w3-label">Kesadaran</label> <span class="w3-tag w3-red" id="conscious-err-msg"></span>
                            <div class="w3-row">
                            <select class="w3-select" name="option" id="conscious-input">
                                <option value="Compos Mentis" selected>Compos Mentis</option>
                                <option value="Apatis">Apatis</option>
                                <option value="Delirium">Delirium</option>
                                <option value="Somnolen">Somnolen</option>
                                <option value="Stupor">Stupor</option>
                                <option value="Semi Coma">Semi Coma</option>
                                <option value="Coma">Coma</option>
                            </select>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Tekanan Darah</label> <span class="w3-tag w3-red" id="blood-preasure-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m2">
                                    <input class="w3-input input-number" id="blood-preasure-low-input" data-label="#blood-preasure-err-msg" type="text">
                                </div>
                                <div class="w3-col m1 w3-center"><span class="w3-xlarge">/</span></div>
                                <div class="w3-col m2">
                                    <input class="w3-input input-number" id="blood-preasure-high-input" data-label="#blood-preasure-err-msg" type="text">
                                </div>
                                <div class="w3-col m3">
                                    <label class="w3-padding">mmHg</label>
                                </div>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Tekanan Pernapasan</label> <span class="w3-tag w3-red" id="respiration-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m6">
                                    <input class="w3-input input-number" id="respiration-input" type="text" data-label="#respiration-err-msg">
                                </div>
                                <div class="w3-col m6">
                                    <label class="w3-padding">x/minutes</label>
                                </div>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Denyut Nadi</label> <span class="w3-tag w3-red" id="pulse-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m6">
                                    <input class="w3-input input-number" id="pulse-input" data-label="#pulse-err-msg" type="text">
                                </div>
                                <div class="w3-col m6">
                                    <label class="w3-padding">x/minutes</label>
                                </div>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Suhu Tubuh</label> <span class="w3-tag w3-red" id="temperature-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m6">
                                    <input class="w3-input input-number" id="temperature-input" data-label="#temperature-err-msg" type="text">
                                </div>
                                <div class="w3-col m6">
                                    <label class="w3-padding">&deg Celcius</label>
                                </div>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Tinggi Badan</label> <span class="w3-tag w3-red" id="height-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m6">
                                    <input class="w3-input input-number" id="height-input" data-label="#height-err-msg" type="text">
                                </div>
                                <div class="w3-col m6">
                                    <label class="w3-padding">cm</label>
                                </div>
                            </div>
                        </p>
                        <p>
                            <label class="w3-label">Berat Badan</label> <span class="w3-tag w3-red" id="weight-err-msg"></span>
                            <div class="w3-row">
                                <div class="w3-col m6">
                                    <input class="w3-input input-number" id="weight-input" data-label="#weight-err-msg" type="text">
                                </div>
                                <div class="w3-col m6">
                                    <label class="w3-padding">Kg</label>
                                </div>
                            </div>
                        </p>
                    </form>
                </div>

                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">PEMERIKSAAN PENUNJANG  <span class="w3-tag w3-red err-msg" id="support-examination-err-msg"></span></h4>
                    </div>
                    <form class="w3-container w3-margin-top">
                        <!--ERROR MSG-->
                        <p>
                            <ul class="w3-ul w3-ul-list w3-card-4" id="support-examination-ul">
                                <li class="w3-padding-small">
                                    <span class="w3-closebtn w3-closebtn-list w3-large w3-margin-right">x</span><br/>
                                    <span class="w3-clear"></span>
                                    <div class="w3-row">
                                        <div class="w3-col m6 w3-padding-small">
                                            <textarea class="w3-input w3-border support-examination-column" data-label="#support-examination-err-msg"></textarea>
                                        </div>
                                        <div class="w3-col m6 w3-padding-small">
                                            <textarea class="w3-input w3-border support-examination-value" data-label="#support-examination-err-msg"></textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </p>
                        <button class="w3-btn w3-round-xxlarge w3-ripple w3-left w3-red w3-margin"
                                id="btn-add-support-examination">+ TAMBAH BARU</button>
                        <br/>
                    </form>
                </div>
            </div>
        </div>

        <!-- DIAGNOSA / ANALISA -->
        <div class="step" id="step3">
            <div class="number">
                <span>3</span>
            </div>
            <div class="title">
                <h1>DIAGNOSA / ANALISA</h1>
            </div>
            <div class="modify">
                <i class="fa fa-plus-circle"></i>
            </div>
        </div>
        <div class="content w3-row">
            <!--WORKING DIAGNOSE-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">DIAGNOSA KERJA  <span class="w3-tag w3-red err-msg" id="working-diagnose-err-msg"></span></h4>
                    </div>

                    <form class="w3-container">
                        <p>
                            <textarea class="w3-input" id="working-diagnose-text"
                                data-label="#working-diagnose-err-msg"
                                data-ul="#working-diagnose-ul" data-li="#working-diagnose-value"></textarea>
                            <br>
                            <!--ERROR MSG-->
                            <!--VALUE-->
                            <ul class="w3-ul w3-card-4 w3-hide" id="working-diagnose-ul">
                                <li class="w3-padding-8">
                                    <span class="w3-large" id="working-diagnose-value" data-value="" data-status=""></span>
                                          <span
                                              data-input-value="#working-diagnose-value"
                                              data-input-element="#working-diagnose-text"
                                              data-ul="#working-diagnose-ul"
                                              class="w3-closebtn w3-margin-right w3-medium">x</span>
                                </li>
                            </ul>
                        </p>
                        <br/>
                    </form>
                </div>
            </div>
            <!--SUPPORT DIAGNOSE-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">DIAGNOSA BANDING  <span class="w3-tag w3-red err-msg" id="support-diagnose-err-msg"></span></h4>
                    </div>
                    <form class="w3-container w3-margin-top">
                        <!--ERROR MSG-->
                        <p>
                            <ul class="w3-ul w3-ul-list w3-card-4" id="support-diagnose-ul">
                                <li class="w3-padding-8">
                                        <span class="w3-closebtn w3-large w3-margin-right w3-closebtn-list">x</span><br>
                                    <div class="w3-medium w3-padding-medium">
                                        <textarea class="w3-input support-diagnose-li-text" data-label="#support-diagnose-err-msg"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </p>
                        <button class="w3-btn w3-round-xxlarge w3-ripple w3-left w3-red w3-margin"
                                id="btn-add-support-diagnose">+ TAMBAH BARU</button>
                        <br/>
                    </form>
                </div>
            </div>
        </div>

        <!-- PENATALAKSANAAN -->
        <div class="step" id="step4">
            <div class="number">
                <span>4</span>
            </div>
            <div class="title">
                <h1>PENATALAKSANAAN</h1>
            </div>
            <div class="modify">
                <i class="fa fa-plus-circle"></i>
            </div>
        </div>
        <div class="content w3-row">
            <!--MEDICATION-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">TERAPI   <span class="w3-tag w3-red err-msg" id="medication-err-msg"></span></h4>
                    </div>
                    <form class="w3-container w3-margin-top">
                        <!--ERROR MSG-->
                        <p>
                            <ul class="w3-ul w3-ul-list w3-card-4" id="medication-ul">
                                <li class="w3-padding-8">
                                        <span class="w3-closebtn w3-closebtn-list w3-large w3-margin-right">x</span><br>
                                    <div class="w3-medium w3-padding-medium">
                                        <textarea class="w3-input medication-li-text" data-label="#medication-err-msg"></textarea>
                                    </div>
                                </li>
                            </ul>
                        </p>
                       <button class="w3-btn w3-round-xxlarge w3-ripple w3-left w3-red w3-margin" id="btn-add-medication">+ TAMBAH BARU</button>
                        <br/>
                    </form>
                </div>
            </div>

            <!--Rujukan-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">RUJUKAN</h4>
                    </div>

                    <form class="w3-container">
                        <p>
                            <textarea class="w3-input" id="rujukan-text"></textarea>
                        </p>
                        <br/>
                    </form>
                </div>
            </div>
        </div>

        <!-- KUNJUNGAN -->
        <div class="step" id="step4">
            <div class="number">
                <span>5</span>
            </div>
            <div class="title">
                <h1>KUNJUNGAN</h1>
            </div>
            <div class="modify">
                <i class="fa fa-plus-circle"></i>
            </div>
        </div>
        <div class="content w3-row">

            <!--Rujukan-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">JENIS KUNJUNGAN</h4>
                    </div>

                    <form class="w3-container" id="visit-form">
                        <p>
                            <div class="w3-row-padding">
                                <div class="w3-half">
                                    <input class="w3-radio" type="radio" name="visit-type-input" value="Kunjungan Sehat">
                                    <label class="w3-validate w3-large">Kunjungan Sehat</label>
                                </div>
                                <div class="w3-half">
                                    <input class="w3-radio" type="radio" name="visit-type-input" value="Kunjungan Sakit" checked>
                                    <label class="w3-validate w3-large">Kunjungan Sakit</label>
                                </div>
                            </div>
                        </p>
                        <br/>
                    </form>
                </div>
            </div>

            <!--Rujukan-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">PERAWATAN</h4>
                    </div>

                    <form class="w3-container" id="treatment-form">
                        <p>
                            <div class="w3-row-padding">
                                <div class="w3-half">
                                    <input class="w3-radio" type="radio" name="treatment-input" value="Rawat Jalan">
                                    <label class="w3-validate w3-large">Rawat Jalan</label>
                                </div>
                                <div class="w3-half">
                                    <input class="w3-radio" type="radio" name="treatment-input" value="Rawat Inap" checked>
                                    <label class="w3-validate w3-large">Rawat Inap</label>
                                </div>
                            </div>
                        </p>
                        <br/>
                    </form>
                </div>
            </div>

            <!--Rujukan-->
            <div class="w3-col m6 w3-padding-small">
                <div class="w3-card-4 w3-margin">
                    <div class="w3-container w3-green">
                        <h4 class="w3-left">STATUS PULANG</h4>
                    </div>

                    <form class="w3-container">
                        <p>
                            <select class="w3-select" name="option" id="status-diagnose-input">
                                <option value="Sembuh" selected>Sembuh</option>
                                <option value="Sakit">Sakit</option>
                            </select>
                        </p>
                        <br/>
                    </form>
                </div>
            </div>

            <input type="hidden" id="base-url" value="<?php echo site_url();?>"/>
            <input type="hidden" id="detail-reservation" value="<?php echo $reservation_data->detailReservationID;?>"/>
            <input type="hidden" id="patient-id" value="<?php echo $reservation_data->patientID;?>"/>
        </div>

        <div class="w3-center">
            <button class="w3-btn w3-red" id="btn-cancel-medical-record">BATAL</button>
            <button class="w3-btn w3-green" id="btn-save-medical-record">SIMPAN</button>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/custom/validate_master.js"></script>
<script src="<?php echo base_url();?>assets/custom/medical_record_manual.js"></script>
<script>
    $(document).ready(function(){
        //$("#otp-input-form").hide();
        $(".w3-modal").show();


    });
</script>
<script>
    $(function(){
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $("#back-to-top-btn").click(function(){
            $("html, body").animate({scrollTop: 0}, 1000);
        });

    });
</script>
</body>
</html>
