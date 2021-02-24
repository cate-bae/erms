<div class="row clearfix">
    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 text-center" style="left: 50%; transform: translateX(-50%);">
        <div class="card">
            <div class="body">
                <div style="font-size: 18px">Current time:</div>
                <h1 class="current-time m-b-25 m-t-10"><?=date('h:i:s A')?></h1>
                
                <button type="button" 
                    class="btn btn-success waves-effect btn-lg" 
                    style="font-size: 1.8rem; width: 80%"
                    <?=!empty($log) && !empty(issetor($log->time_out)) ? 'disabled' : ''?>
                    onclick="log()">
                    <?=$log_time?>
                </button>               
                
                <div class="m-t-30">
                    <table class="table">
                            <tr>
                                <th style="width: 30%">Time In</th>
                                <td class="text-uppercase text-left"><?=!empty($log) && isset($log->time_in) ? $log->time_in: '--' ?></td>
                            </tr>
                            <tr>
                                <th>Break</th>
                                <td class="text-uppercase text-left"><?=!empty($log) && isset($log->break) ? $log->break: '--' ?></td>
                            </tr>
                            <tr>
                                <th>Resume</th>
                                <td class="text-uppercase text-left"><?=!empty($log) && isset($log->resume) ? $log->resume: '--' ?></td>
                            </tr>
                            <tr>
                                <th>Time Out</th>
                                <td class="text-uppercase text-left"><?=!empty($log) && isset($log->time_out) ? $log->time_out: '--' ?></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>