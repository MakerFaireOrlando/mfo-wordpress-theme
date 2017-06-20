<?php
/*
Template Name: CSV-Exhibit ALL
Description: CSV Output for Exhibits
Author: Ian Cole ian.cole@gmail.com
Date: Aug 30th, 2016
*/


/*
        //set the filename from parameter if exists
        $fname = "exhibit-checkin";
        if(isset($wp_query->query_vars['csv-filename'])) {
                $fname = urldecode($wp_query->query_vars['csv-filename']);
        }
        //append the date & time to make file unique
        $fname=$fname."_".date('Y_m_d_His');
        $fname=$fname.".csv";
        //set the headers so the browser knows this is a download
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        //header("Content-Type: application/octet-stream");
        header("Content-Type: text/csv");
        //header("Content-Disposition: attachment; filename=\"report.csv\";" );
        header("Content-Disposition: attachment; filename=\"".$fname."\";" );
        //header("Content-Transfer-Encoding: binary");

*/


$args = array(
  'post_type' => 'exhibit',
  'post_status' => 'publish',
  'posts_per_page' => 20, // all
  'orderby' => 'title',
  'order' => 'ASC',
  'meta_query' => array(array('key' => 'wpcf-approval-status', 'value' => '1'))
);

mysqli_set_charset("utf8");
$exhibits_array = get_posts($args);

//echo "out";

//print_r($exhibits_array);


foreach ($exhibits_array as $exhibit) {

        //current year only. In theory this could be in meta_query, but I'm stumped on getting it to work
        $approval_year = get_post_meta($exhibit->ID, "wpcf-approval-year", true);
        if (get_post_meta($exhibit->ID, "wpcf-approval-year", true) != mfo_event_year()) continue;

        $meta = get_post_meta($exhibit->ID);
	echo html_entity_decode($exhibit->post_title); //exhibit name
	echo json_encode($meta);

        $exout[$exhibit->ID]= $meta;
        echo "<br>";
}//end for each exhibit

 print_r($exout);

//echo json_encode[$exout];


?>
