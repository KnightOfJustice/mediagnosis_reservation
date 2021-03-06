<!--Modal ADD-->
<div class="modal fade" id="clinic-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title-add">Tambah Klinik Baru</h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form id="clinic-form-add" action="">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-master" data-toggle="tab">Master</a></li>
                            <li><a href="#tab-account" data-toggle="tab">Akun</a></li>
                        </ul>

                        <div class="tab-content">
                            <!--Tab Master-->
                            <div class="tab-pane active" id="tab-master">
                                <div class="form-group">
                                    <label for="master-name-add" class="control-label cd-name">Nama Klinik :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-name-add"></span>
                                    <input type="text" class="form-control" id="master-name-add" name="clinic_name"
                                           placeholder="Nama Klinik Anda" data-label="#err-master-name-add" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="master-search-address-add" class="control-label">Cari Alamat :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-address-add"></span>
                                    <input type="text" class="form-control" id="master-search-address-add" placeholder="Alamat Klinik Anda"
                                              data-label="#err-master-address-add" />
                                    <textarea type="text" class="form-control" id="master-address-add" placeholder="Alamat Klinik Anda"
                                              data-label="#err-master-address-add" disabled></textarea>
                                </div>
                                <div class="map_canvas" id="map-canvas-add"></div>
                            </div>
                            <!--Tab Account-->
                            <div class="tab-pane" id="tab-account">
                                <div class="form-group">
                                    <label for="master-username-add" class="control-label">Username :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-username-add"></span>
                                    <input type="text" class="form-control" id="master-username-add" name="acc_username"
                                           placeholder="Username Anda" data-label="#err-master-username-add" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="master-password-add" class="control-label">Password :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-password-add"></span>
                                    <input type="password" class="form-control" id="master-password-add" name="acc_password"
                                           placeholder="Password Anda" data-label="#err-master-password-add" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="master-confirm-password-add" class="control-label">Konfirmasi Password :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-confirm-password-add"></span>
                                    <input type="password" class="form-control" id="master-confirm-password-add" name="acc_confirm_password"
                                           placeholder="Ulangi Password Anda" data-label="#err-master-confirm-password-add" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="master-email-add" class="control-label">Email :</label>
                                    <span class="cd-error-message label label-danger" id="err-master-email-add"></span>
                                    <input type="text" class="form-control" id="master-email-add" name="acc_email"
                                           placeholder="Email Anda" data-label="#err-master-email-add" autofocus>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--modal body-->

            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>

<!--Modal EDIT-->
<div class="modal fade" id="clinic-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title-edit"></h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form id="clinic-form-edit" action="">
                    <input type="hidden" class="form-control" id="master-id">
                    <div class="form-group">
                        <label for="master-name-edit" class="control-label cd-name">Nama Klinik :</label>
                        <span class="cd-error-message label label-danger" id="err-master-name-edit"></span>
                        <input type="text" class="form-control" id="master-name-edit"
                               placeholder="Name" data-label="#err-master-name-edit">
                    </div>
                    <div class="form-group">
                        <label for="master-search-address-edit" class="control-label">Cari Alamat :</label>
                        <span class="cd-error-message label label-danger" id="err-master-address-edit"></span>
                        <input type="text" class="form-control" id="master-search-address-edit" placeholder="Alamat Klinik Anda"
                               data-label="#err-master-address-edit" />
                        <textarea type="text" class="form-control" id="master-address-edit" placeholder="Alamat Klinik Anda"
                                  data-label="#err-master-address-edit" disabled></textarea>
                    </div>
                    <div class="map_canvas" id="map-canvas-edit"></div>

                    <div class="form-group">
                        <label for="master-isactive-edit" class="control-label">Status :</label>
                        <input type="hidden" class="form-control" id="master-isactive-edit">
                        <br/>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-isactive" data-status="1" id="btn-status-active">ACTIVE</button>
                            <button type="button" class="btn btn-default btn-isactive" data-status="0" id="btn-status-no-active">NO ACTIVE</button>
                        </div>
                    </div>
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <p id="created"></p>
                <p id="last_modified"></p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-update">Edit</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>

<!--Modal EDIT Account-->
<div class="modal fade" id="clinic-modal-edit-account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Akun Klinik</h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form id="clinic-form-edit-account" action="">
                    <input type="hidden" class="form-control" id="master-user-id">
                    <div class="form-group">
                        <label for="master-username-edit" class="control-label">Ubah Username :</label>
                        <span class="cd-error-message label label-danger" id="err-master-username-edit"></span>
                        <input type="text" class="form-control" id="master-username-edit"
                               placeholder="Ubah Username" data-value="" data-label="#err-master-username-edit">
                    </div>
                    <div class="form-group">
                        <label for="master-email-add" class="control-label">Ubah Email :</label>
                        <span class="cd-error-message label label-danger" id="err-master-email-edit"></span>
                        <input type="text" class="form-control" id="master-email-edit" name="acc_email"
                               placeholder="Email Anda" data-value="" data-label="#err-master-email-edit" autofocus>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="btn-change-password" data-value="0">Ubah Password</button>
                    </div>
                    <div class="form-group change-password-group">
                        <label for="master-password-edit" class="control-label">Reset Password :</label>
                        <span class="cd-error-message label label-danger" id="err-master-password-edit"></span>
                        <input type="password" class="form-control" id="master-password-edit"
                               placeholder="Reset Password" data-label="#err-master-password-edit">
                    </div>
                    <div class="form-group change-password-group">
                        <label for="master-confirm-password-edit" class="control-label">Konfirmasi Reset Password :</label>
                        <span class="cd-error-message label label-danger" id="err-master-confirm-password-edit"></span>
                        <input type="password" class="form-control" id="master-confirm-password-edit"
                               placeholder="Konfirmasi Reset Password" data-label="#err-master-confirm-password-edit">
                    </div>
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-update-account">Edit</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>

<script src="//maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyDmzn_NKO9LsuSuhg4McW8oj_zXJk9h6Ig"></script>
<script src="<?php echo base_url();?>assets/plugins/geocomplete/jquery.geocomplete.js"></script>
<script>

    $(document).ready( function($) {

        var $superUser = "<?php echo $superUserID;?>";
        $(".change-password-group").hide();

        $("#master-search-address-add").geocomplete({
            map: "#map-canvas-add"
        }).bind("geocode:result", function(event, result){
            var lat = result.geometry.location.lat();
            var lng = result.geometry.location.lng();
            var address = result.formatted_address;

            $("#master-address-add").val(address);
            $("#master-address-add").attr("data-lng", lng);
            $("#master-address-add").attr("data-lat", lat);
            console.log(result.geometry.location.lat());
        });

        $("#master-search-address-edit").geocomplete({
            map: "#map-canvas-edit"
        }).bind("geocode:result", function(event, result){
            var lat = result.geometry.location.lat();
            var lng = result.geometry.location.lng();
            var address = result.formatted_address;

            $("#master-address-edit").val(address);
            $("#master-address-edit").attr("data-lng", lng);
            $("#master-address-edit").attr("data-lat", lat);
            console.log(result.geometry.location.lat());
        });


        $(".btn-isactive").click(function(){
            var $status = $(this).attr("data-status");
            if($status == 1){
                $("#btn-status-active").removeClass("btn-default").addClass("btn-success");
                $("#btn-status-no-active").removeClass("btn-danger").addClass("btn-default");
                $("#master-isactive-edit").val(1);
            }else if($status==0){
                $("#btn-status-active").removeClass("btn-success").addClass("btn-default");
                $("#btn-status-no-active").removeClass("btn-default").addClass("btn-danger");
                $("#master-isactive-edit").val(0);
            }
        });

        $("#btn-change-password").click(function(){
            var $value = $(this).attr("data-value");
            if($value == 1){
                $(this).attr("data-value",0);
            }else{
                $(this).attr("data-value",1);
            }
            $(".change-password-group").toggle();
        });

        function validate() {
            var err = 0;
            var regex = /\W/;

            if (!$('#master-name-add').validateRequired()) {
                err++;
                $('.nav-tabs a[href="#tab-master"]').tab('show');
            }

            if (!$('#master-address-add').validateRequired()) {
                err++;
                $('.nav-tabs a[href="#tab-master"]').tab('show');
            }

            if (!$('#master-username-add').validateUsername()) {
                err++;
                $('.nav-tabs a[href="#tab-account"]').tab('show');
            }

            if (!$('#master-password-add').validateLengthRange({minLength:6,maxLength:50})) {
                err++;
                $('.nav-tabs a[href="#tab-account"]').tab('show');
            }

            if(!$('#master-confirm-password-add').validateRequired()) {
                err++;
                $('.nav-tabs a[href="#tab-account"]').tab('show');
            }

            if(!$('#master-confirm-password-add').validateConfirmPassword({
                    compareValue : $('#master-password-add').val()}) ) {
                err++;
                $('.nav-tabs a[href="#tab-account"]').tab('show');
            }

            if (!$('#master-email-add').validateEmailForm()) {
                err++;
                $('.nav-tabs a[href="#tab-account"]').tab('show');
            }

            if (err != 0) {
                return false;
            } else {
                return true;
            }
        }
        function validateEdit() {
            var err = 0;

            if (!$('#master-name-edit').validateRequired()) {
                err++;
            }
            if (!$('#master-address-edit').validateRequired()) {
                err++;
            }

            if (err != 0) {
                return false;
            } else {
                return true;
            }
        }

        function validateEditAccount() {
            var err = 0;
            var change_pass_flag = $("#btn-change-password").attr("data-value");

            if (!$('#master-username-edit').validateUsername()) {
                err++;
            }

            if(change_pass_flag == 1){
                if (!$('#master-password-edit').validateLengthRange({minLength:6,maxLength:50})) {
                    err++;
                }

                if(!$('#master-confirm-password-edit').validateRequired()) {
                    err++;
                }

                if(!$('#master-confirm-password-edit').validateConfirmPassword({
                        compareValue : $('#master-password-edit').val()}) ) {
                    err++;
                }
            }

            if (!$('#master-email-edit').validateEmailForm()) {
                err++;
            }
            if (err != 0) {
                return false;
            } else {
                return true;
            }
        }

        var saveDataEvent = function(e) {
            if (validate()) {
                var formData = new FormData();
                formData.append("name", $("#master-name-add").val());
                formData.append("address", $("#master-address-add").val());
                formData.append("lat", $("#master-address-add").attr("data-lat"));
                formData.append("lng", $("#master-address-add").attr("data-lng"));
                formData.append("username", $("#master-username-add").val());
                formData.append("password", $("#master-password-add").val());
                formData.append("email", $("#master-email-add").val());

                formData.append("superUserID", $superUser);

                $(this).saveData({
                    url: "<?php echo site_url('Clinic/createClinic')?>",
                    data: formData,
                    locationHref: "<?php echo site_url('Clinic/index/'.$superUserID)?>",
                    hrefDuration : 1000
                });
            }
            e.preventDefault();
        };

        var updateDataEvent = function(e){
            if (validateEdit()) {
                var formData = new FormData();
                formData.append("id", $("#master-id").val());
                formData.append("name", $("#master-name-edit").val());
                formData.append("address", $("#master-address-edit").val());
                formData.append("lat", $("#master-address-edit").attr("data-lat"));
                formData.append("lng", $("#master-address-edit").attr("data-lng"));
                formData.append("isActive", $("#master-isactive-edit").val());
                formData.append("superUserID", $superUser);

                $(this).saveData({
                    url: "<?php echo site_url('Clinic/editClinic')?>",
                    data: formData,
                    locationHref: "<?php echo site_url('Clinic/index/'.$superUserID)?>",
                    hrefDuration : 1000
                });
            }
            e.preventDefault();
        };

        var updateAccountDataEvent = function(e){
            if (validateEditAccount()) {
                var formData = new FormData();

                var $username =  $("#master-username-edit").val();
                var $email =  $("#master-email-edit").val();
                var $username_old =  $("#master-username-edit").attr("data-value");
                var $email_old =  $("#master-email-edit").attr("data-value");
                var $password =  $("#master-password-edit").val();

                if($username != $username_old){
                    formData.append("username",$username);
                }
                if($email != $email_old){
                    formData.append("email",$email);
                }
                if($password != ""){
                    formData.append("password", $password);
                }
                formData.append("id", $("#master-user-id").val());
                formData.append("superUserID", $superUser);

                $(this).saveData({
                    url: "<?php echo site_url('Clinic/editAccountClinic')?>",
                    data: formData,
                    locationHref: "<?php echo site_url('Clinic/index/'.$superUserID)?>",
                    hrefDuration : 1000
                });
            }
            e.preventDefault();
        };

        // SAVE DATA TO DB
        $('#btn-save').click(saveDataEvent);
        $("#clinic-form-add").on("submit", saveDataEvent);

        // UPDATE DATA TO DB
        $('#btn-update').click(updateDataEvent);
        $("#clinic-form-edit").on("submit", updateDataEvent);

        // UPDATE ACCOUNT TO DB
        $('#btn-update-account').click(updateAccountDataEvent);
        $("#clinic-form-edit-account").on("submit", updateAccountDataEvent);
    });

</script>