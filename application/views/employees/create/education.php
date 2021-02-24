
<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; text-transform: uppercase"><?=get_page_title('education');?></p>
        <hr style="margin: 0 -15px">
    </div>
</div>

<div class="form-horizontal education">


    <div class="education-row">        

        <h2 class="card-inside-title">
            1.
        </h2>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Level</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <select name="edu_level[0]" class="form-control show-tick">

                            <?php foreach(get_education_levels() as $level) {?>

                                <option value="<?=$level?>"><?=$level?></option>
                            <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Name of School</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="edu_school[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Basic Education/Degree/Course</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="edu_course[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-md-12">Period of Attendance</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">From</span>
                            <div class="form-line demo-masked-input">
                                <input name="edu_from[0]" type="text" class="form-control year" placeholder="yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">To</span>
                            <div class="form-line demo-masked-input">
                                <input name="edu_to[0]" type="text" class="form-control year" placeholder="yyyy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-md-12">Highest Level/Units Earned</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="edu_units[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-md-12">Year Graduated</label>
                    <div class="col-md-12">
                        <div class="form-line demo-masked-input">
                            <input name="edu_year[0]" type="text" class="form-control year" placeholder="yyyy">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">            
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Scholarship/Academic Honors Received</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="edu_honors[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


<button type="button" class="btn btn-warning waves-effect remove-education" onclick="removeRowHelper('education')" style="display: none">
    <i class="material-icons">remove</i>
    <span>Remove</span>
</button>
<button type="button" class="btn btn-primary waves-effect" onclick="addRowHelper('education')">
    <i class="material-icons">add</i>
    <span>Add</span>
</button>