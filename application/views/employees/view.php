
<div class="row clearfix">
    <?php if (in_array(get_user_type(), [-1, 0])) { ?>

    <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <img src="<?=$employee->avatar?>" 
                    class="thumb-lg img-thumbnail profile-picture profile-picture-view" 
                    alt="img" style="max-width: 100%; max-height: 200px; object-fit: contain;">

                <h4><?=$employee->last_name . ', ' . $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->ext_name?></h4>
                <?=empty($value->position_name) ? '' : '<h5>'.$value->position_name.'</h5>'?>
            </div>
            
            <div class="body padding-0 card-bar">
                <div class="menu">
                    <div class="list-group">
                        <a href="<?=base_url('Employees/view/'.$user_id.'/general')?>" 
                            class="header list-group-item <?php if (isset($view_active) && $view_active == 'general') { echo 'active'; } ?>">
                            GENERAL INFORMATION
                        </a>
                        <div class="header">PERSONAL DATA</div>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/personal')?>" style="border-top: 0"
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'personal') { echo 'active'; } ?>">
                            Personal Information
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/family')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'family') { echo 'active'; } ?>">
                            Family Background
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/education')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'education') { echo 'active'; } ?>">
                            Educational Background
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/civil_service')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'civil_service') { echo 'active'; } ?>">
                            Civil Service Eligibility
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/work_experience')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'work_experience') { echo 'active'; } ?>">
                            Work Experience
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/voluntary_work')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'voluntary_work') { echo 'active'; } ?>">
                            Voluntary Work
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/trainings')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'trainings') { echo 'active'; } ?>">
                            Trainings
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/other_info')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'other_info') { echo 'active'; } ?>">
                            Other Information
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/questions')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'questions' || $view_active == 'edit_questions') { echo 'active'; } ?>">#
                            34-40
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/references')?>" 
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'references') { echo 'active'; } ?>">
                            References
                        </a>
                        <a href="<?=base_url('Employees/view/'.$user_id.'/agreement ')?>"  style="border-bottom: 0"
                            class="list-group-item <?php if (isset($view_active) && $view_active == 'agreement') { echo 'active'; } ?>">
                            Agreement
                        </a>
                        
                        <a href="<?=base_url('Employees/view/'.$user_id.'/attendance')?>" 
                            class="header list-group-item <?php if (isset($view_active) && $view_active == 'attendance') { echo 'active'; } ?>">
                            ATTENDANCE
                        </a>
                        
                        <a href="<?=base_url('Employees/view/'.$user_id.'/leaves')?>" 
                            class="header list-group-item <?php if (isset($view_active) && $view_active == 'leaves') { echo 'active'; } ?>">
                            LEAVE
                        </a>
                        
                        <a href="<?=base_url('Employees/view/'.$user_id.'/benefits')?>" 
                            class="header list-group-item <?php if (isset($view_active) && $view_active == 'benefits') { echo 'active'; } ?>">
                            BENEFITS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php } ?>

    <div class="<?=in_array(get_user_type(), [-1, 0]) ? 'col-md-9 col-sm-8 employee-content' : ''?> col-xs-12">
        <input type="hidden" id="employee-id" value="<?=$user_id?>">
        <?php
            echo (isset($view_page)) ? $view_page : '';
        ?>
    </div>
</div>


<style>
@media (min-width: 768px) {
    .employee-content {
        padding-left: 0;
    }
}
.card-bar .menu .list-group .header.active {
    background-color: #2196F3;
    border-color: #2196F3;
    color: #fff;
}
.card-bar .menu .list-group .header {
    border: 1px solid #ddd;
}
.card-bar .menu .list-group .list-group-item:not(.header) {
    padding-left: 30px;
}
</style>