<style>
.card .body .form-group .col-xs-12, 
.card .body .form-group .col-sm-12, 
.card .body .form-group .col-md-12, 
.card .body .form-group .col-lg-12 {
    margin-bottom: 0;
}
.demo-radio-button {
    margin-bottom: 10px;
}
.demo-checkbox label, .demo-radio-button label {
    min-width: 100px;
}
.input-group {
    margin-bottom: 0;
}
.form-horizontal .form-group {
    margin-right: 0;
    margin-left: 0;
}
.form-horizontal .form-group {
  margin-bottom: 0; }
</style>
<div class="row clearfix">
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <span class="col-red" style="display: inline-block;">
                            <b>Please fill each of the fields when applicable.</b>
                            <br>
                            <a target="_blank" href="<?=base_url()?>assets/excel/PDS-Guidelines.pdf">View guide in filling out the personal data.</a>
                        </span>

                        <?php if (in_array(get_user_type(), [-1, 0])) { ?>

                        <a href="<?=base_url()?>Employees" class="btn btn-default text-uppercase waves-effect pull-right">
                            <i class="material-icons">close</i>
                            <span>Cancel</span>
                        </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="body">
                <form id="create_employee_wizard">
                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                    <h2>I.</h2>
                    <section>
                        <?php
                        echo (isset($create['personal'])) ? $create['personal'] : '';
                        ?>
                    </section>

                    <h2>II.</h2>
                    <section>
                        <?php
                        echo (isset($create['family'])) ? $create['family'] : '';
                        ?>
                    </section>

                    <h2>III.</h2>
                    <section>
                        <?php
                        echo (isset($create['education'])) ? $create['education'] : '';
                        ?>
                    </section>

                    <h2>IV.</h2>
                    <section>
                        <?php
                        echo (isset($create['civil_service'])) ? $create['civil_service'] : '';
                        ?>
                    </section>

                    <h2>V.</h2>
                    <section>
                        <?php
                        echo (isset($create['experience'])) ? $create['experience'] : '';
                        ?>
                    </section>

                    <h2>VI.</h2>
                    <section>
                        <?php
                        echo (isset($create['voluntary'])) ? $create['voluntary'] : '';
                        ?>
                    </section>

                    <h2>VII.</h2>
                    <section>
                        <?php
                        echo (isset($create['training'])) ? $create['training'] : '';
                        ?>
                    </section>

                    <h2>VIII.</h2>
                    <section>
                        <?php
                        echo (isset($create['other_info'])) ? $create['other_info'] : '';
                        ?>
                    </section>

                    <h2># 34-40</h2>
                    <section>
                        <?php
                        echo (isset($create['questions'])) ? $create['questions'] : '';
                        ?>
                    </section>

                    <h2># 41</h2>
                    <section>
                        <?php
                        echo (isset($create['references'])) ? $create['references'] : '';
                        ?>
                    </section>

                    <h2># 42</h2>
                    <section>
                        <?php
                        echo (isset($create['agreement'])) ? $create['agreement'] : '';
                        ?>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>