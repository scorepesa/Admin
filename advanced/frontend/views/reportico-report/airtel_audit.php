<?php

use yii\helpers\Url;
?>

<div id="scorepesa" class="tab-pane fade in active">
        <?php
        $reportico = \Yii::$app->getModule('reportico');
        $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
        $engine->access_mode = "AirtelAudit";             // Allows access to a project and all reports in that project
        $engine->initial_execute_mode = "MENU";            // Starts user in Project Menu mode
        $engine->initial_project = "AirtelAudit";            // Name of report project folder
        $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
        $engine->force_reportico_mini_maintains = true;    // Often required
        $engine->bootstrap_preloaded = false;               // true if you dont need Reportico to load its own bootstrap
        $engine->clear_reportico_session = true;           // Normally required
        /* dynamic grid turn on dynamic sortable, searchable, pageable grids */
        $engine->dynamic_grids = true;
        $engine->dynamic_grids_sortable = true;
        $engine->dynamic_grids_searchable = true;
        $engine->dynamic_grids_paging = true;
        $engine->dynamic_grids_page_size = 20;

        $engine->execute();                                // Run Reportico
        ?>
</div>
