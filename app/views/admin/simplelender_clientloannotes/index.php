<div class = "">

    <div class="">
        <div class="simplelender_flow_stats">
            <center>
                <div id="simplelender_application"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('simplelenderClientloan')->count(array('conditions'=>array('loan_stage'=>1))); ?> <br><span class="sl_stat_flow_description">Applications >></span></div>
                <div id="simplelender_processed"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('simplelenderClientloan')->count(array('conditions'=>array('loan_stage'=>array('2','4')))); ?> <br><span class="sl_stat_flow_description">Applications Being Processing >></span></div>
                <div id="simplelender_repayment"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('simplelenderClientloan')->count(array('conditions'=>array('loan_stage'=>3))); ?> <br><span class="sl_stat_flow_description">Repayment / approved >></span></div>
                <div id="simplelender_close"><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo mvc_model('simplelenderClientloan')->count(array('conditions'=>array('loan_stage'=>5))); ?> <br><span class="sl_stat_flow_description">Closed</span></div>
            </center>
        </div>
        <div>
            <div id="simplelender_process_sumary"></div>
            <div id="simplelender_more_info ">
                <div id="simplelender_approved"></div>
                <div id="simplelender_Declined"></div>
            </div>
        </div>
    </div>
    <div></div>

</div>