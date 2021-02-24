
<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; text-transform: uppercase"><?=get_page_title('civil_service');?></p>
        <hr style="margin: 0 -15px">
    </div>
</div>
<div class="form-horizontal civil-service">

    <div class="civil-service-row">        

        <h2 class="card-inside-title">
            1.
        </h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Career Service/RA 1080 (Board/Bar) under Special Laws/CES/CSEE Barangay Elegibility/Driver's License</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="civil_title[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Rating (If Applicable)</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="civil_rating[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-md-12">Date of Examination/Conferment</label>
                    <div class="col-md-12">
                        <div class="form-line demo-masked-input">
                            <input name="civil_date[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-md-12">Place of Examination/Conferment</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="civil_place[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-12">License (If Applicable)</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">Number</span>
                            <div class="form-line">
                                <input name="civil_license[0]" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">Date of Validity</span>
                            <div class="form-line">
                                <input name="civil_validity[0]" type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>  

<button type="button" class="btn btn-warning waves-effect remove-civil-service" onclick="removeRowHelper('civil-service')" style="display: none">
    <i class="material-icons">remove</i>
    <span>Remove</span>
</button>
<button type="button" class="btn btn-primary waves-effect" onclick="addRowHelper('civil-service')">
    <i class="material-icons">add</i>
    <span>Add</span>
</button>
