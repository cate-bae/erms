<div class="row">
    <div class="col-sm-12">
        <p>
            <span style="font-size: 18px; text-transform: uppercase"><?=get_page_title('work_experience');?></span>
            <br>
            <span>(Include private employment) Description of duties should be indicated in the attached Work Experience sheet.</span>
        </p>
        
        <hr style="margin: 0 -15px">
    </div>
</div>
<div class="form-horizontal work-experience">

    <div class="work-experience-row">        

        <h2 class="card-inside-title">
            1.
        </h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-sm-12">Inclusive Dates</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">From</span>
                            <div class="form-line demo-masked-input">
                                <input name="experience_from[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">To</span>
                            <div class="form-line demo-masked-input">
                                <input name="experience_to[0]" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Position Title (Write in full/Do not abbreviate)</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="experience_position[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Department/Agency/Office/Company (Write in full/Do not abbreviate)</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="experience_department[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Monthly Salary</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="experience_salary[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">        
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-md-12">Salary/Job/Pay Grade (if applicable) & Step (Format "00-0")/Increment</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="experience_salary_grade[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-md-12">Status of Appointment</label>
                    <div class="col-md-12">
                        <div class="form-line">
                            <input name="experience_status[0]" type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-md-12">Government Service</label>
                    <div class="col-md-12">
                        <div class="demo-radio-button">
                            <input name="experience_govt[0]" type="radio" id="radio_govt_1-1" class="with-gap" value="Yes" checked>
                            <label for="radio_govt_1-1">Yes</label>
                            
                            <input name="experience_govt[0]" type="radio" id="radio_govt_2-1" class="with-gap" value="No">
                            <label for="radio_govt_2-1" style="min-width: auto;">No</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<button type="button" class="btn btn-warning waves-effect remove-work-experience" onclick="removeRowHelper('work-experience')" style="display: none">
    <i class="material-icons">remove</i>
    <span>Remove</span>
</button>
<button type="button" class="btn btn-primary waves-effect" onclick="addExperience()">
    <i class="material-icons">add</i>
    <span>Add</span>
</button>

<script>
function addExperience() {
    
    addRowHelper('work-experience')

    let name = 'work-experience'
    $parentDiv = $('.'+name);
    $lastRow = $parentDiv.find('.'+name+'-row:last-child');
    
    $radioGroup = $lastRow.find('.demo-radio-button');
    
    let row_number = $parentDiv.find('.'+name+'-row').length;

    $radioGroup.find('input').eq(0).attr('id', 'radio_govt_1-' + row_number);
    $radioGroup.find('label').eq(0).attr('for', 'radio_govt_1-' + row_number);

    $radioGroup.find('input').eq(1).attr('id', 'radio_govt_2-' + row_number);
    $radioGroup.find('label').eq(1).attr('for', 'radio_govt_2-' + row_number);

    // default value
    $radioGroup.find('input#radio_govt_1-' + row_number).prop('checked', true);
}
</script>
