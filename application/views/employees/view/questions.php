
<div class="card">
    <div class="body">
        <div class="row clearfix">
            <div class="col-sm-12">
                <a type="button" class="btn btn-warning waves-effect pull-right" href="<?=base_url('Employees/view/'.$user_id.'/edit_questions')?>">
                    <i class="material-icons">edit</i>
                    <span>Edit</span>
                </a>
            </div>
        </div>
        <div class="form-horizontal">
            
            <h2 class="card-inside-title text-justify">
                34. Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be apppointed,
            </h2>
            <div class="row">        
                <label class="col-md-12 m-b-10">a. within the third degree?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->third_degree, 'No')?>
                </div>
            </div>
            
            <div class="row">   
                <label class="col-md-12 m-b-10">b. within the fourth degree (for Local Government Unit - Career Employees)?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->fourth_degree, 'No') != 'No' ? 'Yes, '.issetor($info->fourth_degree_details) : 'No'?>
                </div>
            </div>
            
            <h2 class="card-inside-title">
                35.
            </h2>
            <div class="row">        
                <label class="col-md-12 m-b-10">a. Have you ever been found guilty of any administrative offense?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->offence_guilty, 'No') != 'No' ? 'Yes, '.issetor($info->offence_guilty_details) : 'No'?>
                </div>
            </div>
            
            <div class="row">   
                <label class="col-md-12 m-b-10">b. Have you been criminally charged before any court?</label>
                <div class="col-md-12 m-l-20">
                    <div>
                        <?=issetor($info->criminally_charged, 'No')?>
                    </div>
                    <div class="yes-details" <?=issetor($info->criminally_charged, 'No') != 'No' ? '': 'style="display: none"'?>>
                        <label class="m-t--10">Details:</label>
                        <div class="m-l-20">
                            <label>Date Filed:</label><?=issetor($info->criminally_charged_date)?>
                            <br>
                            <label>Status of Case/s:</label><?=issetor($info->criminally_charged_status)?>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="card-inside-title text-justify m-b-10">
                36. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
            </h2>
            <div class="row">
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->convicted_crime, 'No') != 'No' ? 'Yes, '.issetor($info->convicted_crime_details) : 'No'?>
                </div>
            </div>
            
            <h2 class="card-inside-title text-justify m-b-10">
                37. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?
            </h2>
            <div class="row">
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->separated_service, 'No') != 'No' ? 'Yes, '.issetor($info->separated_service_details) : 'No'?>
                </div>
            </div>

            <h2 class="card-inside-title">
                38.
            </h2>
            <div class="row">        
                <label class="col-md-12 text-justify m-b-10">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->election_candidate, 'No') != 'No' ? 'Yes, '.issetor($info->election_candidate_details) : 'No'?>
                </div>
            </div>
            <div class="row">        
                <label class="col-md-12 text-justify m-b-10">b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->resigned_govt, 'No') != 'No' ? 'Yes, '.issetor($info->resigned_govt_details) : 'No'?>
                </div>
            </div>
            
            <h2 class="card-inside-title m-b-10">
                39. Have you acquired the status of an immigrant or permanent resident of another country?
            </h2>
            <div class="row">
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->immigrant, 'No') != 'No' ? 'Yes, '.issetor($info->immigrant_details) : 'No'?>
                </div>
            </div>

            <h2 class="card-inside-title text-justify m-b-10">
                40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
            </h2>
            <div class="row">        
                <label class="col-md-12 m-b-10">a. Are you a member of any indigenous group?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->indigent, 'No') != 'No' ? 'Yes, '.issetor($info->indigency) : 'No'?>
                </div>
            </div>
            <div class="row">        
                <label class="col-md-12 m-b-10">b. Are you a person with disability?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->disabled, 'No') != 'No' ? 'Yes, '.issetor($info->disabled_id) : 'No'?>
                </div>
            </div>
            <div class="row">        
                <label class="col-md-12 m-b-10">c. Are you a solo parent?</label>
                <div class="col-md-12 m-l-20">
                    <?=issetor($info->solo_parent, 'No') != 'No' ? 'Yes, '.issetor($info->solo_parent_id) : 'No'?>
                </div>
            </div>

        </div>
    </div>
</div>