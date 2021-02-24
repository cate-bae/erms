
<div class="card">
    <div class="body">
        <form id="form-agreement">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <div class="row clearfix">
            <div class="col-sm-12">
                <button id="edit-button" type="button" class="btn btn-warning waves-effect pull-right" onclick="enableFields('form-agreement')">
                    <i class="material-icons">edit</i>
                    <span>Edit</span>
                </button>
                <button id="cancel-button" type="button" class="btn btn-default waves-effect pull-right" onclick="location.reload()" style="display: none">
                    <i class="material-icons">close</i>
                    <span>Cancel</span>
                </button>
            </div>
        </div>
        <div class="form-horizontal">
            <h2 class="card-inside-title text-justify">I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated herein. I  agree that any misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s against me.</h2>

            <!-- <h2 class="card-inside-title">
                Government Issued ID
            </h2> -->

            <div class="form-group m-b-10">
                <label class="col-md-12 m-b-10">Government Issued ID: </label>
                <div class="col-md-12 m-b-10">
                    <div class="form-line">
                        <input name="govt_issued_id" value="<?=issetor($info->govt_issued_id)?>" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group m-b-10">
                <label class="col-md-12 m-b-10">ID/License/Passport No.: </label>
                <div class="col-md-12 m-b-10">
                    <div class="form-line">
                        <input name="govt_issued_id_no" value="<?=issetor($info->govt_issued_id_no)?>" type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 m-b-10">
                    <div class="form-group m-b-10">
                        <label class="col-md-12 m-b-10">Date of Issuance:</label>
                        <div class="col-md-12 m-b-10">
                            <div class="form-line demo-masked-input">
                                <input name="govt_issued_id_date" value="<?=issetor($info->govt_issued_id_date)?>" type="text" class="form-control date" placeholder="mm/dd/yyyy" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 m-b-10">
                    <div class="form-group m-b-10">
                        <label class="col-md-12 m-b-10">Place of Issuance:</label>
                        <div class="col-md-12 m-b-10">
                            <div class="form-line">
                                <input name="govt_issued_id_place" value="<?=issetor($info->govt_issued_id_place)?>" type="text" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row clearfix" id="save-button" style="display: none">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success text-uppercase pull-right">
                    <i class="material-icons">save</i>
                    <span>Save</span>
                </button>
            </div>
        </div>
        </form>
    </div>
</div>