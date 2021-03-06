<!--Modal ADD-->
<div class="modal fade" id="poli-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-title-add">Tambah Poli Baru</h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form id="poli-form-add" action="">
                    <div class="form-group">
                        <label for="master-name-add" class="control-label cd-name">Nama Poli :</label>
                        <span class="cd-error-message label label-danger" id="err-master-name-add"></span>
                        <input type="text" class="form-control" id="master-name-add" name="poli_name"
                               placeholder="Name" data-label="#err-master-name-add" autofocus>
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
<div class="modal fade" id="poli-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form id="poli-form-edit" action="">
                    <input type="hidden" class="form-control" id="master-id">
                    <div class="form-group">
                        <label for="master-name-edit" class="control-label cd-name">Nama Poli :</label>
                        <span class="cd-error-message label label-danger" id="err-master-name-edit"></span>
                        <input type="text" class="form-control" id="master-name-edit" name="poli_name"
                               placeholder="Name" data-label="#err-master-name-edit">
                    </div>

                    <?php if($this->session->userdata('role')=="mediagnosis_admin"){ ?>
                        <div class="form-group" id="is-active-container">
                            <label for="master-isactive-edit" class="control-label">Status :</label>
                            <br/>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-isactive" data-status="1" id="btn-status-active">ACTIVE</button>
                                <button type="button" class="btn btn-default btn-isactive" data-status="0" id="btn-status-no-active">NO ACTIVE</button>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" class="form-control" id="master-isactive-edit">
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

<script>

    $(document).ready( function($) {

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

        function validate() {
            var err = 0;

            if (!$('#master-name-add').validateRequired()) {
                err++;
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

                $(this).saveData({
                    url: "<?php echo site_url('Poli/createPoli')?>",
                    data: formData,
                    locationHref: "<?php echo site_url('Poli')?>",
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
                formData.append("isActive", $("#master-isactive-edit").val());

                $(this).saveData({
                    url: "<?php echo site_url('Poli/editPoli')?>",
                    data: formData,
                    locationHref: "<?php echo site_url('Poli')?>",
                    hrefDuration : 1000
                });
            }
            e.preventDefault();
        };

        // SAVE DATA TO DB
        $('#btn-save').click(saveDataEvent);
        $("#poli-form-add").on("submit", saveDataEvent);

        // UPDATE DATA TO DB
        $('#btn-update').click(updateDataEvent);
        $("#poli-form-edit").on("submit", updateDataEvent);
    });

</script>