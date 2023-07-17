<?php
/*
Plugin Name: Speech (line charts)
Description: This plugin generates a line chart in WordPress.
Version: 1.0
*/

// Check if WordPress is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue necessary scripts and styles
function enqueue_chart_scripts_and_styles()
{
    // Load CanvasJS from a CDN
    wp_enqueue_script('canvasjs', 'https://cdn.canvasjs.com/canvasjs.min.js', array(), '1.0', true);
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue Moment.js
    wp_enqueue_script('moment', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'));

    // Enqueue Daterangepicker
    wp_enqueue_script('daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery', 'moment'));

    // Enqueue Daterangepicker CSS
    wp_enqueue_style('daterangepicker-style', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
}

add_action('admin_enqueue_scripts', 'enqueue_chart_scripts_and_styles');

// Create a shortcode for displaying the line chart
function display_line_chart_shortcode()
{
    ob_start(); // Start output buffering
    wp_enqueue_style('speech-styles', plugin_dir_url(__FILE__) . '/speech.css');

    $dataPoints = array(
        array("50", "19-06-2022"),
        array("300", "20-06-2022"),
        array("250", "21-06-2022"),
        array("400", "22-06-2022"),
        array("700", "23-06-2022"),
        array("368", "24-06-2022"),
        array("203", "25-06-2022")
    );
    
    ?>
    <div id="datepicker-container">
        <h3 for="start-date"> Date</h3>
        <div class="fullcolumn">
            <div class="date halfcolumnleft">
                <input type="text" name="datetimes" />
            </div>
            <div class="halfcolumnright">
                <button class="button-datepicker"> Day </button>
                <button class="button-datepicker"> Week </button>
                <button class="button-datepicker"> Month </button>
                <button class="button-datepicker"> Year </button>
            </div>
        </div>
    </div>
    <div id="chartContainer"></div>
    <p id="start-date"></p>
    <p id="end-date"></p>

    <script>
    window.addEventListener('DOMContentLoaded', function() {
        
        var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
        console.log(dataPoints);

        var startDateInput = jQuery("#start-date");
        var endDateInput = jQuery("#end-date");

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Months"
            },
            axisY: {
                title: "Reaches"
            },
            data: [{
                type: "line",
                dataPoints: dataPoints
            }]
        });
        chart.render();

        jQuery(function($) {
    var startDate;
    var endDate;
    $('input[name="datetimes"]').daterangepicker({
        timePicker: false,
        startDate: moment().startOf('day').set({ hour: 0, minute: 0, second: 0 }),
        endDate: moment().startOf('day').add(32, 'day').set({ hour: 23, minute: 59, second: 59 }),
        locale: {
            format: 'DD/M/YYYY'
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        startDate = picker.startDate;
        endDate = picker.endDate;

        // ใช้ startDate และ endDate ในโค้ดที่คุณต้องการ
        // ตัวอย่าง:
        // console.log('StartDate:', startDate.format('M/DD/YYYY'));
        // console.log('EndDate:', endDate.format('M/DD/YYYY'));

        $('#start-date').text(startDate.format('dddd DD/M/YYYY'));
        $('#end-date').text(endDate.format('dddd DD/M/YYYY'));
        console.log(startDate.format('dddd DD/M/YYYY'));
    });
});

    });
    </script>
    <?php
    return ob_get_clean(); // Return the buffered output
}
add_shortcode('line_chart', 'display_line_chart_shortcode');


function speech_menu_page() {
    add_menu_page(
      'Speech',       // Page title
      'Speech',       // Menu title
      'manage_options', // Capability required to access the menu page
      'speech',       // Menu slug
      'speech_menu_display', // Callback function to display the menu page
      'dashicons-microphone', // Menu icon
      6               // Menu position
    );
  }
add_action('admin_menu', 'speech_menu_page');
  
function speech_menu_display() {
    echo '<h1 style="text-align:center;">Speech</h1>';
    echo display_line_chart_shortcode();
    }


