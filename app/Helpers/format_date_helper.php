<?php
if (! function_exists('format_date')) {
    /**
     * Restituisce data europea dd-mm-yyyy per formati db tipo yyyy-mm-dd.
     *

     */
    function format_date($odate)
    {
        $fdate = date("d-m-Y", strtotime($odate));
        log_message('info', $odate. ' '. $fdate);
        return $fdate;
    }
}