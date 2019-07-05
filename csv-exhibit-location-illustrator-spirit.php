<?php
/*
Template Name: CSV-Exhibit Location - Illustrator - Spirit
Description: CSV Output for Exhibits
Author: Ian Cole ian.cole@gmail.com
Date: November 6, 2018
*/


if (true) {

	//set the filename from parameter if exists
	$fname = "exhibit-location-spirit";
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
}

$args = array(
  'post_type' => 'exhibit',
  'post_status' => 'publish',
  'posts_per_page' => -1, // all
  'orderby' => 'title',
  'order' => 'ASC',
  'meta_query' => array(array('key' => 'wpcf-approval-status', 'value' => '1'))
);

$exhibits_array = get_posts($args);

//print_r($exhibits_array);

//	echo 'exhibit-id,exhibit-name,maker-id,maker-name,maker-last-name,maker-first-name,maker-email,maker-phone,';
//	echo 'location-floor,location-area,load-in,helper-qty,agreement-status,seller-fee-status,chase-score' . "\r\n";

//echo mfo_event_year();

/*
$view_array[];
$sei_array[];
$se_array[];
$e_array[];
*/

foreach ($exhibits_array as $exhibit) {

	$approval_year = get_post_meta($exhibit->ID, "wpcf-approval-year", true);

	if (get_post_meta($exhibit->ID, "wpcf-approval-year", true) != mfo_event_year()) continue;
	$space_array = get_post_meta($exhibit->ID, "wpcf-exhibit-space-number", false);

	$exhibit_name = html_entity_decode($exhibit->post_title);

	$width=30;
	if (strlen($exhibit_name) > $width) 
	{
    	$exhibit_name = wordwrap($exhibit_name, $width);
   	$exhibit_name = substr($exhibit_name, 0, strpos($exhibit_name, "\n"))."...";
	}

	$maker_id = wpcf_pr_post_get_belongs($exhibit->ID, 'maker');
	$maker = get_post($maker_id);
	$maker_name = html_entity_decode($maker->post_title);

	$width=30;
	if (strlen($maker_name) > $width) 
	{
    	$maker_name = wordwrap($maker_name, $width);
   	$maker_name = substr($maker_name, 0, strpos($maker_name, "\n"))."...";
	}

	$exhibit_name = str_replace('"', "", $exhibit_name);
	$exhibit_name = str_replace("'", "", $exhibit_name);
	$maker_name = str_replace('"', "", $maker_name);
	$maker_name = str_replace("'", "", $maker_name);


	$payment_status = get_post_meta($exhibit->ID, "wpcf-payment-status", true);
	$payment_status_code = "-ERR";
	switch ($payment_status) {
		case "1":
			$payment_status_code = '';
			break;
		case "2":
			$payment_status_code = '-$N';
			break;
		case "3":
			$payment_status_code = '-$Y';
			break;
		case "4":
			$payment_status_code = '-$W';
			break;
 	}

	if (false) {
		echo $exhibit->ID;
		echo ": ";
		echo $exhibit_name; //exhibit name
		echo "- ";
		echo json_encode($space_array);
		//echo $space_array[0];
		//$space_text = $space_array[0];
		echo " - ";
		echo $maker_id;
		echo " - ";
		echo $maker_name;
		echo " - ";
		echo $payment_status;
		echo $payment_status_code;
		echo "<br>";
	}

	foreach ($space_array as $space) {

		if (strtolower(substr($space, 0, 1)) === 's'){
 
		if (!empty($space) && !in_array($space, $view_array)) {

			//if (in_array($space, $view_array)) echo "dup!!!";
			$view_array[]=$space;
			$sei_array[$space]=$space."\\\\".$exhibit_name."\\\\".$exhibit->ID.$payment_status_code;
			$se_array[$space]=$space."\\\\".$exhibit_name;
			$sem_array[$space]=$space."\\\\".$exhibit_name."\\\\".$maker_name;
			$e_array[$space]=$exhibit_name;
		}
		}//end if curiosity building test
	}

}//end for each exhibit
	/*
	echo json_encode($view_array);  echo "<br>";
	echo json_encode($sei_array);  echo "<br>";
	echo json_encode($se_array);  echo "<br>";
	echo json_encode($e_array); echo "<br>";
	*/

	echo '"View"';

	foreach ($view_array as $view) {
		echo ',';
		echo '"';
		echo html_entity_decode($view);
		echo '"';
	}
	echo ',"updated"';
	echo "\r\n";

	echo '"SpaceExhibitID"';

	foreach ($sei_array as $sei) {
		echo ',';
		echo '"';
		echo html_entity_decode($sei);
		echo '"';
	}
	echo ',"'.date('Y-m-d-H:i:s').'"';
	echo "\r\n";

 	echo '"SpaceExhibit"';

        foreach ($se_array as $se) {
                echo ',';
                echo '"';
                echo html_entity_decode($se);
                echo '"';
        } 
	echo ",".date('Y-m-d-H:i:s');
        echo "\r\n";

	echo '"SpaceExhibitMaker"';

        foreach ($sem_array as $sem) {
                echo ',';
                echo '"';
                echo html_entity_decode($sem);
                echo '"';
        } 

	echo ",".date('Y-m-d-H:i:s');
        echo "\r\n";

	echo '"Exhibit"';

        foreach ($e_array as $e) {
                echo ',';
                echo '"';
                echo html_entity_decode($e);
                echo '"';
        } 
	echo ",".date('Y-m-d-H:i:s');
        echo "\r\n";


?>
