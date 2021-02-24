
<div class="card">
    <div class="body">
        <div class="row clearfix">
            <div class="col-sm-12">
                <a type="button" class="btn btn-default waves-effect pull-right" href="<?=base_url('Employees/view/'.$user_id.'/questions')?>">
                    <i class="material-icons">close</i>
                    <span>Cancel</span>
                </a>
            </div>
        </div>
        <form class="form-horizontal">
            
            <h2 class="card-inside-title text-justify">
                34. Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be apppointed,
            </h2>
            <div class="form-group">        
                <label class="col-md-12">a. within the third degree?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="third_degree" type="radio" id="q_34_a_y" class="with-gap" value="Yes" <?=issetor($info->third_degree, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_34_a_y">Yes</label>
                        
                        <input name="third_degree" type="radio" id="q_34_a_n" class="with-gap" value="No" <?=issetor($info->third_degree, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_34_a_n">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">   
                <label class="col-md-12">b. within the fourth degree (for Local Government Unit - Career Employees)?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="fourth_degree" type="radio" id="q_34_b_y" class="with-gap" value="Yes" <?=issetor($info->fourth_degree, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_34_b_y">Yes</label>
                        
                        <input name="fourth_degree" type="radio" id="q_34_b_n" class="with-gap" value="No" <?=issetor($info->fourth_degree, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_34_b_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->fourth_degree, 'No') == 'Yes' ? '' : 'style="display: none"'?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="fourth_degree_details" type="text" class="form-control" value="<?=issetor($info->fourth_degree_details)?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="card-inside-title">
                35.
            </h2>
            <div class="form-group">        
                <label class="col-md-12">a. Have you ever been found guilty of any administrative offense?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="offence_guilty" type="radio" id="q_35_a_y" class="with-gap" value="Yes" <?=issetor($info->offence_guilty, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_35_a_y">Yes</label>
                        
                        <input name="offence_guilty" type="radio" id="q_35_a_n" class="with-gap" value="No" <?=issetor($info->offence_guilty, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_35_a_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->offence_guilty, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="offence_guilty_details" type="text" class="form-control" value="<?=issetor($info->offence_guilty_details)?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">   
                <label class="col-md-12">b. Have you been criminally charged before any court?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="criminally_charged" type="radio" id="q_35_b_y" class="with-gap" value="Yes" <?=issetor($info->criminally_charged, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_35_b_y">Yes</label>
                        
                        <input name="criminally_charged" type="radio" id="q_35_b_n" class="with-gap" value="No" <?=issetor($info->criminally_charged, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_35_b_n">No</label>
                    </div>
                    <div class="yes-details" <?=issetor($info->criminally_charged, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <label class="m-t--10">If YES, give details:</label>
                        <div class="input-group m-l-20">
                            <span class="input-group-addon">
                                <label>Date Filed:</label>
                            </span>
                            <div class="form-line">
                                <input name="criminally_charged_date" type="text" class="form-control" value="<?=issetor($info->criminally_charged_date, 'No') == 'No' ? '' : issetor($info->criminally_charged_date)?>">
                            </div>
                        </div>
                        <div class="input-group m-l-20">
                            <span class="input-group-addon">
                                <label>Status of Case/s:</label>
                            </span>
                            <div class="form-line">
                                <input name="criminally_charged_status" type="text" class="form-control" value="<?=issetor($info->criminally_charged_status, 'No') == 'No' ? '' : issetor($info->criminally_charged_status)?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="card-inside-title text-justify">
                36. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
            </h2>
            <div class="form-group">
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="convicted_crime" type="radio" id="q_36_y" class="with-gap" value="Yes" <?=issetor($info->convicted_crime, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_36_y">Yes</label>
                        
                        <input name="convicted_crime" type="radio" id="q_36_n" class="with-gap" value="No" <?=issetor($info->convicted_crime, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_36_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->convicted_crime, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="convicted_crime_details" type="text" class="form-control" value="<?=issetor($info->convicted_crime_details)?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="card-inside-title text-justify">
                37. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?
            </h2>
            <div class="form-group">
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="separated_service" type="radio" id="q_37_y" class="with-gap" value="Yes" <?=issetor($info->separated_service, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_37_y">Yes</label>
                        
                        <input name="separated_service" type="radio" id="q_37_n" class="with-gap" value="No" <?=issetor($info->separated_service, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_37_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->separated_service, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="separated_service_details" type="text" class="form-control" value="<?=issetor($info->separated_service_details)?>">
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="card-inside-title">
                38.
            </h2>
            <div class="form-group">        
                <label class="col-md-12 text-justify">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="election_candidate" type="radio" id="q_38_a_y" class="with-gap" value="Yes" <?=issetor($info->election_candidate, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_38_a_y">Yes</label>
                        
                        <input name="election_candidate" type="radio" id="q_38_a_n" class="with-gap" value="No" <?=issetor($info->election_candidate, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_38_a_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->election_candidate, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="election_candidate_details" type="text" class="form-control" value="<?=issetor($info->election_candidate_details)?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">        
                <label class="col-md-12 text-justify">b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="resigned_govt" type="radio" id="q_38_b_y" class="with-gap" value="Yes" <?=issetor($info->resigned_govt, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_38_b_y">Yes</label>
                        
                        <input name="resigned_govt" type="radio" id="q_38_b_n" class="with-gap" value="No" <?=issetor($info->resigned_govt, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_38_b_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->resigned_govt, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details:</label>
                        </span>
                        <div class="form-line">
                            <input name="resigned_govt_details" type="text" class="form-control" value="<?=issetor($info->resigned_govt_details)?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <h2 class="card-inside-title">
                39. Have you acquired the status of an immigrant or permanent resident of another country?
            </h2>
            <div class="form-group">
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="immigrant" type="radio" id="q_39_y" class="with-gap" value="Yes" <?=issetor($info->immigrant, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_39_y">Yes</label>
                        
                        <input name="immigrant" type="radio" id="q_39_n" class="with-gap" value="No" <?=issetor($info->immigrant, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_39_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->immigrant, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, give details (country):</label>
                        </span>
                        <div class="form-line">
                            <input name="immigrant_details" type="text" class="form-control" value="<?=issetor($info->immigrant_details)?>">
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="card-inside-title text-justify">
                40. Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
            </h2>
            <div class="form-group">        
                <label class="col-md-12">a. Are you a member of any indigenous group?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="indigent" type="radio" id="q_40_a_y" class="with-gap" value="Yes" <?=issetor($info->indigent, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_40_a_y">Yes</label>
                        
                        <input name="indigent" type="radio" id="q_40_a_n" class="with-gap" value="No" <?=issetor($info->indigent, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_40_a_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->indigent, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, please specify:</label>
                        </span>
                        <div class="form-line">
                            <input name="indigency" type="text" class="form-control" value="<?=issetor($info->indigency)?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">        
                <label class="col-md-12">b. Are you a person with disability?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="disabled" type="radio" id="q_40_b_y" class="with-gap" value="Yes" <?=issetor($info->disabled, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_40_b_y">Yes</label>
                        
                        <input name="disabled" type="radio" id="q_40_b_n" class="with-gap" value="No" <?=issetor($info->disabled, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_40_b_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->disabled, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, please specify ID No:</label>
                        </span>
                        <div class="form-line">
                            <input name="disabled_id" type="text" class="form-control" value="<?=issetor($info->disabled_id)?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">        
                <label class="col-md-12">c. Are you a solo parent?</label>
                <div class="col-md-12 m-l-20">
                    <div class="demo-radio-button">
                        <input name="solo_parent" type="radio" id="q_40_c_y" class="with-gap" value="Yes" <?=issetor($info->solo_parent, 'No') == 'Yes' ? 'checked' : ''?>>
                        <label for="q_40_c_y">Yes</label>
                        
                        <input name="solo_parent" type="radio" id="q_40_c_n" class="with-gap" value="No" <?=issetor($info->solo_parent, 'No') == 'No' ? 'checked' : ''?>>
                        <label for="q_40_c_n">No</label>
                    </div>
                    <div class="input-group yes-details" <?=issetor($info->solo_parent, 'No') == 'No' ? 'style="display: none"' : ''?>>
                        <span class="input-group-addon">
                            <label>If YES, please specify ID No:</label>
                        </span>
                        <div class="form-line">
                            <input name="solo_parent_id" type="text" class="form-control" value="<?=issetor($info->solo_parent_id)?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
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