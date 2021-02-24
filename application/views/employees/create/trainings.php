<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; text-transform: uppercase"><?=get_page_title('trainings');?></p>
        <hr style="margin: 0 -15px">
    </div>
</div>
<div class="form-horizontal trainings">

    <div class="trainings-row">        

        <h2 class="card-inside-title">
            1.
        </h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Title of Learning and Development Interventions/Training Programs</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="training_title[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-12">Inclusive Dates of Attendance</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">From</span>
                            <div class="form-line demo-masked-input">
                                <input name="training_from[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">To</span>
                            <div class="form-line demo-masked-input">
                                <input name="training_to[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-md-12">Number of Hours</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="training_hours[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Type of LD (Managerial/Supervisory/Technical/etc.)</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="training_type[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Conducted/Sponsored by</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="training_sponsor[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<button type="button" class="btn btn-warning waves-effect remove-trainings" onclick="removeRowHelper('trainings')" style="display: none">
    <i class="material-icons">remove</i>
    <span>Remove</span>
</button>
<button type="button" class="btn btn-primary waves-effect" onclick="addRowHelper('trainings')">
    <i class="material-icons">add</i>
    <span>Add</span>
</button>
