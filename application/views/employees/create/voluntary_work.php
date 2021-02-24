<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; text-transform: uppercase"><?=get_page_title('voluntary_work');?></p>
        <hr style="margin: 0 -15px">
    </div>
</div>
<div class="form-horizontal voluntary-work">

    <div class="voluntary-work-row">        

        <h2 class="card-inside-title">
            1.
        </h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Name & Address of Organization</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="voluntary_name[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-12">Inclusive Dates</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">From</span>
                            <div class="form-line demo-masked-input">
                                <input name="voluntary_from[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">To</span>
                            <div class="form-line demo-masked-input">
                                <input name="voluntary_to[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
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
                            <input name="voluntary_hours[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Position/Nature of Work</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="voluntary_position[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<button type="button" class="btn btn-warning waves-effect remove-voluntary-work" onclick="removeRowHelper('voluntary-work')" style="display: none">
    <i class="material-icons">remove</i>
    <span>Remove</span>
</button>
<button type="button" class="btn btn-primary waves-effect" onclick="addRowHelper('voluntary-work')">
    <i class="material-icons">add</i>
    <span>Add</span>
</button>
