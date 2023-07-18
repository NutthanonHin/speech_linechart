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

     $dataPoints = '{
        "traffic": {
          "data": [
            {
              "date": "2023-07-01",
              "traffic_volume": 1200
            },
            {
              "date": "2023-07-02",
              "traffic_volume": 1400
            },
            {
              "date": "2023-07-03",
              "traffic_volume": 1100
            },
            {
              "date": "2023-07-04",
              "traffic_volume": 1300
            },
            {
              "date": "2023-07-05",
              "traffic_volume": 1150
            },
            {
              "date": "2023-07-06",
              "traffic_volume": 1450
            },
            {
              "date": "2023-07-07",
              "traffic_volume": 1250
            },
            {
              "date": "2023-07-08",
              "traffic_volume": 1350
            },
            {
              "date": "2023-07-09",
              "traffic_volume": 1220
            },
            {
              "date": "2023-07-10",
              "traffic_volume": 1180
            },
            {
              "date": "2023-07-11",
              "traffic_volume": 1280
            },
            {
              "date": "2023-07-12",
              "traffic_volume": 1350
            },
            {
              "date": "2023-07-13",
              "traffic_volume": 1400
            },
            {
              "date": "2023-07-14",
              "traffic_volume": 1320
            },
            {
              "date": "2023-07-15",
              "traffic_volume": 1280
            },
            {
              "date": "2023-07-16",
              "traffic_volume": 1360
            },
            {
              "date": "2023-07-17",
              "traffic_volume": 1420
            },
            {
              "date": "2023-07-18",
              "traffic_volume": 1290
            },
            {
              "date": "2023-07-19",
              "traffic_volume": 1380
            },
            {
              "date": "2023-07-20",
              "traffic_volume": 1450
            },
            {
              "date": "2023-07-21",
              "traffic_volume": 1520
            },
            {
              "date": "2023-07-22",
              "traffic_volume": 1390
            },
            {
              "date": "2023-07-23",
              "traffic_volume": 1420
            },
            {
              "date": "2023-07-24",
              "traffic_volume": 1550
            },
            {
              "date": "2023-07-25",
              "traffic_volume": 1480
            },
            {
              "date": "2023-07-26",
              "traffic_volume": 1450
            },
            {
              "date": "2023-07-27",
              "traffic_volume": 1510
            },
            {
              "date": "2023-07-28",
              "traffic_volume": 1580
            },
            {
              "date": "2023-07-29",
              "traffic_volume": 1620
            },
            {
              "date": "2023-07-30",
              "traffic_volume": 1550
            },
            {
              "date": "2023-07-31",
              "traffic_volume": 1680
            },
            {
              "date": "2023-08-01",
              "traffic_volume": 1750
            },
            {
              "date": "2023-08-02",
              "traffic_volume": 1620
            },
            {
              "date": "2023-08-03",
              "traffic_volume": 1680
            },
            {
              "date": "2023-08-04",
              "traffic_volume": 1820
            },
            {
              "date": "2023-08-05",
              "traffic_volume": 1650
            },
            {
              "date": "2023-08-06",
              "traffic_volume": 1750
            },
            {
              "date": "2023-08-07",
              "traffic_volume": 1820
            },
            {
              "date": "2023-08-08",
              "traffic_volume": 1950
            },
            {
              "date": "2023-08-09",
              "traffic_volume": 1780
            },
            {
              "date": "2023-08-10",
              "traffic_volume": 1850
            },
            {
              "date": "2023-08-11",
              "traffic_volume": 1920
            },
            {
              "date": "2023-08-12",
              "traffic_volume": 2050
            },
            {
              "date": "2023-08-13",
              "traffic_volume": 1980
            },
            {
              "date": "2023-08-14",
              "traffic_volume": 1920
            },
            {
              "date": "2023-08-15",
              "traffic_volume": 2100
            },
            {
              "date": "2023-08-16",
              "traffic_volume": 2150
            },
            {
              "date": "2023-08-17",
              "traffic_volume": 2020
            },
            {
              "date": "2023-08-18",
              "traffic_volume": 2080
            },
            {
              "date": "2023-08-19",
              "traffic_volume": 2150
            },
            {
              "date": "2023-08-20",
              "traffic_volume": 2220
            },
            {
              "date": "2023-08-21",
              "traffic_volume": 2050
            },
            {
              "date": "2023-08-22",
              "traffic_volume": 2120
            },
            {
              "date": "2023-08-23",
              "traffic_volume": 2250
            },
            {
              "date": "2023-08-24",
              "traffic_volume": 2280
            },
            {
              "date": "2023-08-25",
              "traffic_volume": 2180
            },
            {
              "date": "2023-08-26",
              "traffic_volume": 2250
            },
            {
              "date": "2023-08-27",
              "traffic_volume": 2320
            },
            {
              "date": "2023-08-28",
              "traffic_volume": 2450
            },
            {
              "date": "2023-08-29",
              "traffic_volume": 2380
            },
            {
              "date": "2023-08-30",
              "traffic_volume": 2320
            },
            {
              "date": "2023-08-31",
              "traffic_volume": 2450
            },
            {
              "date": "2023-09-01",
              "traffic_volume": 10050
            },
            {
              "date": "2023-09-02",
              "traffic_volume": 1620
            },
            {
              "date": "2023-09-03",
              "traffic_volume": 1680
            },
            {
              "date": "2023-09-04",
              "traffic_volume": 1820
            },
            {
              "date": "2023-09-05",
              "traffic_volume": 1650
            },
            {
              "date": "2023-09-06",
              "traffic_volume": 1750
            },
            {
              "date": "2023-09-07",
              "traffic_volume": 1820
            },
            {
              "date": "2023-09-08",
              "traffic_volume": 1950
            },
            {
              "date": "2023-09-09",
              "traffic_volume": 1780
            },
            {
              "date": "2023-09-10",
              "traffic_volume": 1850
            },
            {
              "date": "2023-09-11",
              "traffic_volume": 1920
            },
            {
              "date": "2023-09-12",
              "traffic_volume": 2050
            },
            {
              "date": "2023-09-13",
              "traffic_volume": 1980
            },
            {
              "date": "2023-09-14",
              "traffic_volume": 1920
            },
            {
              "date": "2023-09-15",
              "traffic_volume": 2100
            },
            {
              "date": "2023-09-16",
              "traffic_volume": 2150
            },
            {
              "date": "2023-09-17",
              "traffic_volume": 2020
            },
            {
              "date": "2023-09-18",
              "traffic_volume": 2080
            },
            {
              "date": "2023-09-19",
              "traffic_volume": 2150
            },
            {
              "date": "2023-09-20",
              "traffic_volume": 2220
            },
            {
              "date": "2023-09-21",
              "traffic_volume": 2050
            },
            {
              "date": "2023-09-22",
              "traffic_volume": 2120
            },
            {
              "date": "2023-09-23",
              "traffic_volume": 2250
            },
            {
              "date": "2023-09-24",
              "traffic_volume": 2280
            },
            {
              "date": "2023-09-25",
              "traffic_volume": 2180
            },
            {
              "date": "2023-09-26",
              "traffic_volume": 2250
            },
            {
              "date": "2023-09-27",
              "traffic_volume": 2320
            },
            {
              "date": "2023-09-28",
              "traffic_volume": 2450
            },
            {
              "date": "2023-09-29",
              "traffic_volume": 2380
            },
            {
              "date": "2023-09-30",
              "traffic_volume": 2320
            },
            {
              "date": "2023-09-31",
              "traffic_volume": 2450
            }
          ]
        }
    }';
      
    
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
        var startDate;
        var endDate;
        var selectedStartDate;
        var selectedEndDate;
        var daysDiff;
        var formatdate = "DD MMMM";

        jQuery(function($) {

            var jsonData = <?php echo $dataPoints; ?>;

            // สร้างอาร์เรย์ของจุดข้อมูลสำหรับ CanvasJS
            var dataPoints = jsonData.traffic.data.map(function(item) {
                return {
                    x: new Date(item.date),
                    y: item.traffic_volume
                };
            });
            // สร้างกราฟครั้งแรกตอนเรียกเข้าหน้า plugin
            console.log(dataPoints)
            var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Months"
            },
            axisY: {
                title: "Reaches",
                // lineColor: "rgba(105,105,105,.8)"
                gridColor: "rgba(83,199,188,.5)",

            },
            axisX: {
                valueFormatString: formatdate,
                // interlacedColor: "#F0F8FF",
                // lineColor: "rgba(105,105,105,.8)"

            },
            data: [{
                type: "line",
                dataPoints: dataPoints
            }]
            });
            chart.render();
            // console.log('update2')

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
                    selectedStartDate = startDate.format('YYYY-MM-DD');
                    selectedEndDate = endDate.format('YYYY-MM-DD');

                    $('#start-date').text(startDate.format('dddd DD/M/YYYY'));
                    $('#end-date').text(endDate.format('dddd DD/M/YYYY'));

                    var jsonData = <?php echo $dataPoints; ?>;

                    // คำนวณจำนวนวันระหว่างวันที่เลือก
                    var daysDiff = moment(selectedEndDate).diff(selectedStartDate, 'days');

                    // if(daysDiff > 365){
                    //     formatdate = "YY"
                    // } 
                    // else if(daysDiff > 30) {
                    //     formatdate = "MMMM";
                    // }
                    // else if(daysDiff > 7){
                    //     formatdate = "D MMMM";

                    // }
                    // else {
                    //     formatdate = "D MMMM hh:mm tt";
                    // }

                    console.log(formatdate)

                    // กรองข้อมูลตามวันที่ระหว่าง selectedStartDate และ selectedEndDate
                    var filteredData = jsonData.traffic.data.filter(function(item) {
                        var date = moment(item.date, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        return moment(date).isBetween(selectedStartDate, selectedEndDate, null, '[]');
                    });

                    console.log(filteredData)

                    // สร้างอาร์เรย์ของจุดข้อมูลสำหรับ CanvasJS
                    var dataPoints = [];
                    
                    {
                        // ใช้ข้อมูลทั้งหมด
                        dataPoints = filteredData.map(function(item) {
                            return {
                            x: new Date(item.date),
                            y: item.traffic_volume
                            };
                        });
                    }

                    // อัปเดตข้อมูลใหม่ให้กับกราฟ
                    chart.options.data[0].dataPoints = dataPoints;
                    chart.options.axisX.valueFormatString = formatdate;

                    chart.render();
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