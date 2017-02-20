<?php if ( ! defined( 'BASEPATH' )) {

    exit( 'No direct script access allowed' );
}
/**
 * OPS Panel
 * Application for monitoring and managing LC app and assets.
 *
 * @package OPSPanel
 * @author  Ayush Sharma
 */

/**
 * Calendar Helper
 *
 * @package     OPSPanel
 * @subpackage  Helpers
 * @author      Ayush Sharma
 */

/**
 * Generate Timespan
 *
 * @access public
 * @param integer $start_time       beginning unix timestamp
 * @param integer $end_time         ending unix timestamp
 * @param bool    $show_str         display timestamp string for $start_time or not
 * @param bool    $show_icon        display calendar icon after timespan which contains full date/time string in hover title or not
 * @param mixed   $zero_string      text to display if $start_time is zero; if FALSE, return
 * @param bool    $detail           whether to display two time units or one
 * @param string  $detail_separator details seperator
 * @param bool    $show_timespan    whether to display timespan or not
 * @return string
 */
if ( ! function_exists('helper_date_time_span') ) {

    function helper_date_time_span ( $start_time, $end_time = '', $show_icon = FALSE, $show_string = TRUE ) {

        $detail = '';

        // Check
        if ( $start_time - $end_time == 0 ) {

            return NULL;
        }

        // Prepare
        $time_span = '';
        if ( $end_time == '' ) {

            $end_time = time();
        }

        // Calculate Actual Time (Duration) IN SECONDS
        $elapsed_time = $end_time - $start_time;

        // Set Prefix/Suffix
        if ( $elapsed_time >= 0 ) {

            $tmp = '+';
        }
        else {

            $tmp = '-';
        }

        // Get Absolute Value
        $elapsed_time = abs($elapsed_time);

        if ( $elapsed_time < 1 ) {

            $time_span = '0 seconds';
        }
        else {

            $a = array (12 * 30 * 24 * 60 * 60 => 'year',
                        30 * 24 * 60 * 60      => 'month',
                        24 * 60 * 60           => 'day',
                        60 * 60                => 'hour',
                        60                     => 'minute',
                        1                      => 'second');

            foreach ( $a as $secs => $str ) {

                $d = $elapsed_time / $secs;
                if ( $d >= 1 ) {

                    if ( ! $detail ) {

                        $r      = round($d);
                        $detail = '';
                    }
                    else {

                        $r      = floor($d);
                        $detail = ( $d - floor($d) == 0 ? '' : helper_date_timespan(0, $secs * ( $d - floor($d) ), FALSE) );
                    }

                    $time_span = ( $show_string && $tmp == "-" ? 'in ' : '' ) . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . $detail . ( $show_string && $tmp == "+" ? ' ago' : '' );
                    break;
                }
            }
        }

        return $time_span . ( $show_icon ? '&nbsp;<img src="' . base_url() . 'assets/images/icon_main_time.png" width="15" height="15" title="' . date('d M Y g:i A', $start_time) . '" style="vertical-align:text-top;">' : '' );
    }
}

/* End of file calendar_helper.php */
/* Location: ./application/helpers/calendar_helper.php */