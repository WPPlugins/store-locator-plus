<?php

function move_upload_directories() {
	global $sl_upload_path, $sl_path;
	
	if (!is_dir(ABSPATH . "wp-content/uploads")) {
		mkdir(ABSPATH . "wp-content/uploads", 0755);
	}
	if (!is_dir($sl_upload_path)) {
		mkdir($sl_upload_path, 0755);
	}
	if (!is_dir($sl_upload_path . "/custom-icons")) {
		mkdir($sl_upload_path . "/custom-icons", 0755);
	}
	if (!is_dir($sl_upload_path . "/custom-css")) {
		mkdir($sl_upload_path . "/custom-css", 0755);
	}
	
	if (is_dir($sl_path . "/themes") && !is_dir($sl_upload_path . "/themes")) {
		copyr($sl_path . "/themes", $sl_upload_path . "/themes");
	}
	if (is_dir($sl_path . "/languages") && !is_dir($sl_upload_path . "/languages")) {
		copyr($sl_path . "/languages", $sl_upload_path . "/languages");
	}
	if (is_dir($sl_path . "/images") && !is_dir($sl_upload_path . "/images")) {
		copyr($sl_path . "/images", $sl_upload_path . "/images");
	}
}
/* -----------------*/
function parseToXML($htmlStr) { 
    $xmlStr=str_replace('<','&lt;',$htmlStr); 
    $xmlStr=str_replace('>','&gt;',$xmlStr); 
    $xmlStr=str_replace('"','&quot;',$xmlStr); 
    $xmlStr=str_replace("'",'&#39;',$xmlStr); 
    $xmlStr=str_replace("&",'&amp;',$xmlStr); 
    $xmlStr=str_replace("," ,"&#44;" ,$xmlStr);
    return $xmlStr; 
} 

/*-----------------*/

function initialize_variables() {
    global $height, $width, $width_units, $height_units, $radii;
    global $icon, $icon2, $google_map_domain, $google_map_country, $theme, $sl_base, $sl_upload_base, $location_table_view;
    global $search_label, $zoom_level, $sl_use_city_search, $sl_use_name_search, $sl_default_map;
    global $sl_radius_label, $sl_website_label, $sl_num_initial_displayed, $sl_load_locations_default;
    global $sl_distance_unit, $sl_map_overview_control, $sl_admin_locations_per_page, $sl_instruction_message;
    global $sl_map_character_encoding, $sl_use_country_search;
    
    $sl_map_character_encoding=get_option('sl_map_character_encoding');
    if (empty($sl_map_character_encoding)) {
        $sl_map_character_encoding="";
        add_option('sl_map_character_encoding', $sl_map_character_encoding);
        }
    $sl_instruction_message=get_option('sl_instruction_message');
    if (empty($sl_instruction_message)) {
        $sl_instruction_message="Enter Your Address or Zip Code Above.";
        add_option('sl_instruction_message', $sl_instruction_message);
        }
    $sl_admin_locations_per_page=get_option('sl_admin_locations_per_page');
    if (empty($sl_admin_locations_per_page)) {
        $sl_admin_locations_per_page="100";
        add_option('sl_admin_locations_per_page', $sl_admin_locations_per_page);
        }
    $sl_map_overview_control=get_option('sl_map_overview_control');
    if (empty($sl_map_overview_control)) {
        $sl_map_overview_control="0";
        add_option('sl_map_overview_control', $sl_map_overview_control);
        }
    $sl_distance_unit=get_option('sl_distance_unit');
    if (empty($sl_distance_unit)) {
        $sl_distance_unit="miles";
        add_option('sl_distance_unit', $sl_distance_unit);
        }
    $sl_load_locations_default=get_option('sl_load_locations_default');
    if (empty($sl_load_locations_default)) {
        $sl_load_locations_default="1";
        add_option('sl_load_locations_default', $sl_load_locations_default);
        }
    $sl_num_initial_displayed=get_option('sl_num_initial_displayed');
    if (empty($sl_num_initial_displayed)) {
        $sl_num_initial_displayed="25";
        add_option('sl_num_initial_displayed', $sl_num_initial_displayed);
        }
    $sl_website_label=get_option('sl_website_label');
    if (empty($sl_website_label)) {
        $sl_website_label="Website";
        add_option('sl_website_label', $sl_website_label);
        }
    $sl_radius_label=get_option('sl_radius_label');
    if (empty($sl_radius_label)) {
        $sl_radius_label="Radius";
        add_option('sl_radius_label', $sl_radius_label);
        }
    $sl_map_type=get_option('sl_map_type');
    if (empty($sl_map_type)) {
        $sl_map_type=G_NORMAL_MAP;
        add_option('sl_map_type', $sl_map_type);
        }
    $sl_remove_credits=get_option('sl_remove_credits');
    if (empty($sl_remove_credits)) {
        $sl_remove_credits="0";
        add_option('sl_remove_credits', $sl_remove_credits);
        }
    $sl_use_name_search=get_option('sl_use_name_search');
    if (empty($sl_use_name_search)) {
        $sl_use_name_search="0";
        add_option('sl_use_name_search', $sl_use_name_search);
        }
    $sl_use_city_search=get_option('sl_use_city_search');
    if (empty($sl_use_city_search)) {
        $sl_use_city_search="1";
        add_option('sl_use_city_search', $sl_use_city_search);
        }
    $sl_use_country_search=get_option('sl_use_country_search');
    if (empty($sl_use_country_search)) {
        $sl_use_country_search="1";
        add_option('sl_use_country_search', $sl_use_country_search);
        }
    $zoom_level=get_option('sl_zoom_level');
    if (empty($zoom_level)) {
        $zoom_level="4";
        add_option('sl_zoom_level', $zoom_level);
        }
    $search_label=get_option('sl_search_label');
    if (empty($search_label)) {
        $search_label="Address";
        add_option('sl_search_label', $search_label);
        }
    $location_table_view=get_option('sl_location_table_view');
    if (empty($location_table_view)) {
        $location_table_view="Normal";
        add_option('sl_location_table_view', $location_table_view);
        }
    $theme=get_option('sl_map_theme');
    if (empty($theme)) {
        $theme="";
        add_option('sl_map_theme', $theme);
        }
    $google_map_country=get_option('sl_google_map_country');
    if (empty($google_map_country)) {
        $google_map_country="United States";
        add_option('sl_google_map_country', $google_map_country);
    }
    $google_map_domain=get_option('sl_google_map_domain');
    if (empty($google_map_domain)) {
        $google_map_domain="maps.google.com";
        add_option('sl_google_map_domain', $google_map_domain);
    }
    $icon2=get_option('sl_map_end_icon');
    if (empty($icon2)) {
        add_option('sl_map_end_icon', $sl_base.'/icons/marker.png');
        $icon2=get_option('sl_map_end_icon');
    }
    $icon=get_option('sl_map_home_icon');
    if (empty($icon)) {
        add_option('sl_map_home_icon', $sl_base.'/icons/arrow.png');
        $icon=get_option('sl_map_home_icon');
    }
    $height=get_option('sl_map_height');
    if (empty($height)) {
        add_option('sl_map_height', '350');
        $height=get_option('sl_map_height');
        }
    
    $height_units=get_option('sl_map_height_units');
    if (empty($height_units)) {
        add_option('sl_map_height_units', "px");
        $height_units=get_option('sl_map_height_units');
        }	
    
    $width=get_option('sl_map_width');
    if (empty($width)) {
        add_option('sl_map_width', "100");
        $width=get_option('sl_map_width');
        }
    
    $width_units=get_option('sl_map_width_units');
    if (empty($width_units)) {
        add_option('sl_map_width_units', "%");
        $width_units=get_option('sl_map_width_units');
        }	
    
    $radii=get_option('sl_map_radii');
    if (empty($radii)) {
        add_option('sl_map_radii', "1,5,10,25,(50),100,200,500");
        $radii=get_option('sl_map_radii');
        }
}


/*--------------------------*/
function choose_units($unit, $input_name) {
    $select_field = (isset($select_field)?$select_field:'');
	$unit_arr[]="%";$unit_arr[]="px";$unit_arr[]="em";$unit_arr[]="pt";
	$select_field.="<select name='$input_name'>";
	
	//global $height_units, $width_units;
	
	foreach ($unit_arr as $value) {
		$selected=($value=="$unit")? " selected='selected' " : "" ;
		if (!($input_name=="height_units" && $unit=="%")) {
			$select_field.="\n<option value='$value' $selected>$value</option>";
		}
	}
	$select_field.="</select>";
	return $select_field;
}

/*----------------------------*/
function do_geocoding($address,$sl_id="") {    
    global $wpdb, $text_domain,$slplus_plugin;    
    if (!defined('MAPS_HOST')) { define("MAPS_HOST", get_option('sl_google_map_domain')); }
    if (!defined('KEY')) { define('KEY', $slplus_plugin->driver_args['api_key']); }
    
    // Initialize delay in geocode speed
    $delay = 0;
    $base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv&key=" . KEY;
    
    //Adding ccTLD (Top Level Domain) to help perform more accurate geocoding according to selected Google Maps Domain - 12/16/09
    $ccTLD_arr=explode(".", MAPS_HOST);
    $ccTLD=$ccTLD_arr[count($ccTLD_arr)-1];
    if ($ccTLD!="com") {
        $base_url .= "&gl=".$ccTLD;
    }
    
    //Map Character Encoding
    if (get_option("sl_map_character_encoding")!="") {
        $base_url .= "&oe=".get_option("sl_map_character_encoding");
    }
    
    // Iterate through the rows, geocoding each address
    $request_url = $base_url . "&q=" . urlencode($address);
    if (extension_loaded("curl") && function_exists("curl_init")) {
            $cURL = curl_init();
            curl_setopt($cURL, CURLOPT_URL, $request_url);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
            $csv = curl_exec($cURL);
            curl_close($cURL);  
    }else{
         $csv = file_get_contents($request_url) or die("url not loading");
    }

    $csvSplit = split(",", $csv);
    $status = $csvSplit[0];
    $lat = $csvSplit[2];
    $lng = $csvSplit[3];
    if (strcmp($status, "200") == 0) {
      // successful geocode
      $geocode_pending = false;
      $lat = $csvSplit[2];
      $lng = $csvSplit[3];

	if ($sl_id=="") {
		$query = sprintf("UPDATE " . $wpdb->prefix ."store_locator SET sl_latitude = '%s', sl_longitude = '%s' WHERE sl_id = ".mysql_insert_id()." LIMIT 1;", mysql_real_escape_string($lat), mysql_real_escape_string($lng));
	}
	else {
		$query = sprintf("UPDATE " . $wpdb->prefix ."store_locator SET sl_latitude = '%s', sl_longitude = '%s' WHERE sl_id = $sl_id LIMIT 1;", mysql_real_escape_string($lat), mysql_real_escape_string($lng));
	}
      $update_result = mysql_query($query);
	if (!$update_result) {
        die("Invalid query: " . mysql_error());
      }
    } else if (strcmp($status, "620") == 0) {
      // sent geocodes too fast
      $delay += 100000;
    } else {
      // failure to geocode
      $geocode_pending = false;
      echo __("Address " . $address . " <font color=red>failed to geocode</font>. ", $text_domain);
      echo __("Received status " . $status , $text_domain)."\n<br>";
    }
    usleep($delay);
}


/***********************************
 ** Run install/update activation routines
 **/

function activate_slplus() {
    install_table();
    add_slplus_roles_and_caps();
}

/***********************************
 ** Add the capability manage_slp to administrators
 ** People using roles & caps plugins can use this to allow
 ** people with the manage_slp functionality to manage locations.
 **
 **/
function add_slplus_roles_and_caps() {
    // Make sure admin has that role
    //
    $role = get_role('administrator');
    if(!$role->has_cap('manage_slp')) {
        $role->add_cap('manage_slp');
    }    
}

/***********************************
 ** Create the Store Locator Plus table during an installation or upgrade.
 **
 ** You must change the sl_db_verion whenever you change the stucture.
 ** This will allow the built-in WordPress db_delta function to perform
 ** an automatic table structure upgrade from the prior installed version.
 **/ 
function install_table() {
	global $wpdb, $sl_path, $sl_upload_path;


	/******************************************************
	 * CHANGE THIS WHENVER YOU CHANGE THE DB STRUCTURE!!! *
	 ******************************************************/
	$sl_db_version='1.8';

	$table_name = $wpdb->prefix . "store_locator";
	$sql = "CREATE TABLE " . $table_name . " (
			sl_id mediumint(8) unsigned NOT NULL auto_increment,
			sl_store varchar(255) NULL,
			sl_address varchar(255) NULL,
			sl_address2 varchar(255) NULL,
			sl_city varchar(255) NULL,
			sl_state varchar(255) NULL,
			sl_zip varchar(255) NULL,
			sl_country varchar(255) NULL,
			sl_latitude varchar(255) NULL,
			sl_longitude varchar(255) NULL,
			sl_tags mediumtext NULL,
			sl_description varchar(255) NULL,
			sl_email varchar(255) NULL,
			sl_url varchar(255) NULL,
			sl_hours varchar(255) NULL,
			sl_phone varchar(255) NULL,
			sl_image varchar(255) NULL,
			sl_private varchar(1) NULL,
			sl_neat_title varchar(255) NULL,
			PRIMARY KEY  (sl_id)
			) ENGINE=innoDB  DEFAULT CHARACTER SET=utf8  DEFAULT COLLATE=utf8_unicode_ci;";
	
    // New installation
    //
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		add_option("sl_db_version", $sl_db_version);
		
    // Installation upgrade
    //
	} else {        
        $installed_ver = get_option( "sl_db_version" );
        if( $installed_ver != $sl_db_version ) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            update_option("sl_db_version", $sl_db_version);
        }
    }        
	
	move_upload_directories();
}


/***********************************
 ** function: head_scripts
 **
 ** Create the javascript elements needed for the google map for pages that use
 ** the plugin only.   This was inherited and needs to be cleaned up a bit.
 ** 
 ** We'll still want to ensure we only load up scripts (and CSS, etc.) on pages
 ** where the map will be displayed.
 **/
function head_scripts() {
	global $sl_dir, $sl_base, $sl_upload_base, $sl_path, $sl_upload_path, $wpdb, $pagename, $map_character_encoding;
	global $slplus_plugin;
	
	//Check if currently on page with shortcode
	$pageID = isset($_GET['p'])         ? $_GET['p']       : 
	          isset($_GET['page_id'])   ? $_GET['page_id'] : 
	          '';
	$on_sl_page=$wpdb->get_results("SELECT post_name FROM ".$wpdb->prefix."posts ".
	        "WHERE (post_content LIKE '%[STORE-LOCATOR%' OR post_content LIKE '%[SLPLUS%') AND " .
	        "post_status IN ('publish', 'draft') AND ".
	        "(post_name='$pagename' OR ID='$pageID')", 
	        ARRAY_A);
	
	//Checking if code used in posts	
	$sl_code_is_used_in_posts=$wpdb->get_results(
	    "SELECT post_name FROM ".$wpdb->prefix."posts ".
	    "WHERE (post_content LIKE '%[STORE-LOCATOR%' OR post_content LIKE '%[SLPLUS%') AND post_type='post'"
	    );
	
	//If shortcode used in posts, get post IDs, and put into array of numbers
	if ($sl_code_is_used_in_posts) {
		$sl_post_ids=$wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content LIKE '%[STORE-LOCATOR%' AND post_type='post'", ARRAY_A);
		foreach ($sl_post_ids as $val) { $post_ids_array[]=$val[ID];}
	} else {			    
	     //post number that'll never be reached
		$post_ids_array=array(9999999999999999999999999999999999999);
	}
	
	// If on page with store locator shortcode, on an archive, search, or 404 page 
    // while shortcode has been used in a post, on the front page, or a specific 
    // post with shortcode, display code, otherwise, don't
	if ($on_sl_page || is_search() || 
        ((is_archive() || is_404()) && $sl_code_is_used_in_posts) || 
        is_front_page() || is_single($post_ids_array)
        ) {
        if (isset($slplus_plugin) && $slplus_plugin->ok_to_show()) {
            $api_key=$slplus_plugin->driver_args['api_key'];
            $google_map_domain=(get_option('sl_google_map_domain')!="")? 
                    get_option('sl_google_map_domain') : 
                    "maps.google.com";
            
            print  "<script src='http://$google_map_domain/maps?file=api&amp;v=2&amp;key=$api_key&amp;sensor=false{$map_character_encoding}' type='text/javascript'></script>
                    <script src='".SLPLUS_PLUGINURL."/js/store-locator-js.php' type='text/javascript'></script>
                    <script src='".SLPLUS_PLUGINURL."/js/store-locator.js' type='text/javascript'></script>
                    <script src='".SLPLUS_PLUGINURL."/js/functions.js' type='text/javascript'></script>\n";
            $has_custom_css=(file_exists($sl_upload_path."/custom-css/csl-slplus.css"))? 
                $sl_upload_base."/custom-css" : 
                $sl_base; 
            print "<link  href='".$has_custom_css."/csl-slplus.css' type='text/css' rel='stylesheet'/>";
            $theme=get_option('sl_map_theme');
            if ($theme!="") {print "\n<link  href='".$sl_upload_base."/themes/$theme/style.css' rel='stylesheet' type='text/css'/>";}
            $zl=(trim(get_option('sl_zoom_level'))!="")? get_option('sl_zoom_level') : 4;		            
            }
        } else {
            if ($slplus_plugin->debugging) {
                $sl_page_ids=$wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content LIKE '%[STORE-LOCATOR%' AND post_status='publish'", ARRAY_A);
                print "<!-- No store locator on this page, so no unnecessary scripts for better site performance. (";
                if ($sl_page_ids) {
                    foreach ($sl_page_ids as $value) { print "$value[ID],";}
                }
                print ")-->";
            }
        }
}


/**************************************
 ** function: store_locator_shortcode
 **
 ** Process the store locator shortcode.
 **
 **/
 function store_locator_shortcode($attributes, $content = null) {
    // Variables this function uses and passes to the template
    // we need a better way to pass vars to the template parser so we don't
    // carry around the weight of these global definitions.
    // the other option is to unset($GLOBAL['<varname>']) at then end of this    
    // function call.
    //
    // Let's start using a SINGLE named array called "fnvars" to pass along anything
    // we want.
    //
    global  $sl_dir, $sl_base, $sl_upload_base, $sl_path, $sl_upload_path, $text_domain, $wpdb,
	    $slplus_plugin, $prefix,	        
	    $search_label, $width, $height, $width_units, $height_units, $hide,
	    $sl_radius, $sl_radius_label, $text_domain, $r_options, $button_style,
	    $sl_instruction_message, $cs_options, $country_options,$fnvars;	 
	    
	    $fnvars = array();

	// Set the entire list of accepted attributes.
	//
	// The shortcode_atts function ensures that all possible
	// attributes that *could* be passed are given a value which
	// makes later processing in the code a bit easier.
	//
	// This is basically the equivalent of the php array_merge()
	// function.
	//
    shortcode_atts(
        array(
            'tags_for_pulldown'=> null, 
            'only_with_tag'    => null,
            ),
        $attributes
        );
    
    // Plugin is not licensed or user is not admin
    //
    if (!$slplus_plugin->ok_to_show()) {
        if(get_option($prefix.'-debugging') == 'on') {
            print 'Store Locator Plus is not licensed.';
        }
        return;
    }
                
    $height=(get_option('sl_map_height'))? 
    get_option('sl_map_height') : "500" ;
    
    $width=(get_option('sl_map_width'))? 
    get_option('sl_map_width') : "100" ;
        
    $radii=(get_option('sl_map_radii'))? 
    get_option('sl_map_radii') : "1,5,10,(25),50,100,200,500" ;
    
    $height_units=(get_option('sl_map_height_units'))? 
    get_option('sl_map_height_units') : "px";
    
    $width_units=(get_option('sl_map_width_units'))? 
    get_option('sl_map_width_units') : "%";
    
    $sl_instruction_message=(get_option('sl_instruction_message'))? 
    get_option('sl_instruction_message') : 
    "Enter Your Address or Zip Code Above.";

    $r_array=explode(",", $radii);
    $search_label=(get_option('sl_search_label'))? 
    get_option('sl_search_label') : "Address" ;
    
    $unit_display=(get_option('sl_distance_unit')=="km")? 
    "km" : "mi";

    $r_options      =(isset($r_options)         ?$r_options      :'');
    $cs_options     =(isset($cs_options)        ?$cs_options     :'');
    $country_options=(isset($country_options)   ?$country_options:'');
        
    foreach ($r_array as $value) {
        $s=(ereg("\(.*\)", $value))? " selected='selected' " : "" ;
        $value=ereg_replace("[^0-9]", "", $value);
        $r_options.="<option value='$value' $s>$value $unit_display</option>";
    }
        
    //-------------------
    // Show City Search option is checked
    // setup the pulldown list
    //
    if (get_option('sl_use_city_search')==1) {
        $cs_array=$wpdb->get_results(
            "SELECT CONCAT(TRIM(sl_city), ', ', TRIM(sl_state)) as city_state " .
                "FROM ".$wpdb->prefix."store_locator " .
                "WHERE sl_city<>'' AND sl_state<>'' AND sl_latitude<>'' " .
                    "AND sl_longitude<>'' " .
                "GROUP BY city_state " .
                "ORDER BY city_state ASC", 
            ARRAY_A);
    
        if ($cs_array) {
            foreach($cs_array as $value) {
        $cs_options.="<option value='$value[city_state]'>$value[city_state]</option>";
            }
        }
    }

    
    //-------------------
    // Show Country Search option is checked
    // setup the pulldown list
    //
    if (get_option('sl_use_country_search')==1) {
        $cs_array=$wpdb->get_results(
            "SELECT TRIM(sl_country) as country " .
                "FROM ".$wpdb->prefix."store_locator " .
                "WHERE sl_country<>'' " .
                    "AND sl_latitude<>'' AND sl_longitude<>'' " .
                "GROUP BY country " .
                "ORDER BY country ASC", 
            ARRAY_A);
    
        if ($cs_array) {
            foreach($cs_array as $value) {
              $country_options.=
                "<option value='$value[country]'>" .
                "$value[country]</option>";
            }
        }
    }		
    
    $theme_base=$sl_upload_base."/images";
    $theme_path=$sl_upload_path."/images";
    if (!file_exists($theme_path."/search_button.png")) {
        $theme_base=$sl_base."/images";
        $theme_path=$sl_path."/images";
    }
    $sub_img=$theme_base."/search_button.png";
    $mousedown=(file_exists($theme_path."/search_button_down.png"))? 
        "onmousedown=\"this.src='$theme_base/search_button_down.png'\" onmouseup=\"this.src='$theme_base/search_button.png'\"" : 
        "";
    $mouseover=(file_exists($theme_path."/search_button_over.png"))? 
        "onmouseover=\"this.src='$theme_base/search_button_over.png'\" onmouseout=\"this.src='$theme_base/search_button.png'\"" : 
        "";
    $button_style=(file_exists($theme_path."/search_button.png"))? 
        "type='image' src='$sub_img' $mousedown $mouseover" : 
        "type='submit'";
    $hide=(get_option('sl_remove_credits')==1)? 
        "style='display:none;'" : 
        "";

    $columns = 1;
    $columns += (get_option('sl_use_city_search')!=1) ? 1 : 0;
    $columns += (get_option('sl_use_country_search')!=1) ? 1 : 0; 	    
    $sl_radius_label=get_option('sl_radius_label');
    $file = SLPLUS_PLUGINDIR . '/templates/search_form.php';

    // Prep fnvars for passing to our template
    //
    $fnvars = array_merge($fnvars,(array) $attributes);       // merge in passed attributes

    return get_string_from_phpexec($file); 
}

/**************************************
 ** function: csl_slplus_add_options_page()
 **
 ** Add the Store Locator panel to the admin sidebar.
 **
 **/
function csl_slplus_add_options_page() {
	global $text_domain, $slplus_plugin;

	
	
	if ( 
	    (trim($slplus_plugin->driver_args['api_key'])!="") &&
	    current_user_can('manage_slp')
	    )
	{
        add_menu_page(
            __("SLP Locations", $text_domain),  
            __("SLP Locations", $text_domain), 
            'administrator', 
            SLPLUS_PLUGINDIR.'/add-locations.php'
            );	
		add_submenu_page(
    	    SLPLUS_PLUGINDIR.'/add-locations.php',
		    __("Add Locations", $text_domain), 
		    __("Add Locations", $text_domain), 
		    'administrator', 
		    SLPLUS_PLUGINDIR.'/add-locations.php'
		    );
		add_submenu_page(
    	    SLPLUS_PLUGINDIR.'/add-locations.php',
		    __("Manage Locations", $text_domain), 
		    __("Manage Locations", $text_domain), 
		    'administrator', 
		    SLPLUS_PLUGINDIR.'/view-locations.php'
		    );
		add_submenu_page(
    	    SLPLUS_PLUGINDIR.'/add-locations.php',
		    __("Map Settings", $text_domain), 
		    __("Map Settings", $text_domain), 
		    'administrator', 
		    SLPLUS_PLUGINDIR.'/map-designer.php'
		    );
	}

}


/*---------------------------------*/
function add_admin_javascript() {
        global $sl_base, $sl_upload_base, $sl_dir, $google_map_domain, $sl_path, 
            $sl_upload_path, $map_character_encoding, $slplus_plugin;
		$api=$slplus_plugin->driver_args['api_key'];
        print "<script src='".$sl_base."/js/functions.js'></script>\n
        <script type='text/javascript'>
        var sl_dir='".$sl_dir."';
        var sl_google_map_country='".get_option('sl_google_map_country')."';
        </script>\n";
        if (ereg("add-locations", (isset($_GET['page'])?$_GET['page']:''))) {
            $google_map_domain=(get_option('sl_google_map_domain')!="")? get_option('sl_google_map_domain') : "maps.google.com";			
            print "<script src='http://$google_map_domain/maps?file=api&amp;v=2&amp;key=$api&amp;sensor=false{$map_character_encoding}' type='text/javascript'></script>\n";
        }
}

/*---------------------------------*/
function add_admin_stylesheet() {
  global $sl_base;
  print "<link rel='stylesheet' type='text/css' href='".$sl_base."/admin.css'>\n";
}

/*---------------------------------*/
function set_query_defaults() {
	global $where, $o, $d;
	
	$qry = isset($_GET['q']) ? $_GET['q'] : '';
	$where=($qry!='')? 
	        " WHERE ".
	        "sl_store    LIKE '%$qry%' OR ".
	        "sl_address  LIKE '%$qry%' OR ".
	        "sl_address2 LIKE '%$qry%' OR ".
	        "sl_city     LIKE '%$qry%' OR ".
	        "sl_state    LIKE '%$qry%' OR ".
	        "sl_zip      LIKE '%$qry%' OR ".
	        "sl_tags     LIKE '%$qry%' " 
	        : 
	        '' ;
	$o= (isset($_GET['o']) && (trim($_GET['o']) != ''))
	    ? $_GET['o'] : "sl_store";
	$d= (isset($_GET['d']) && (trim($_GET['d'])=='DESC')) 
	    ? "DESC" : "ASC";
}

/*----------------------------------*/
function match_imported_data($the_array) {
    global $text_domain;
    print "<h3>".__("Choose Heading That Matches Columns You Want to Import", $text_domain).":</h3>(".__("Leave headings for undesired columns unchanged", $text_domain).")<br><br>
    <form method='post'>
    <input type='button' value='".__("Cancel", $text_domain)."' class='button' onclick='history.go(-1)'>&nbsp;<input type='submit' value='".__("Import Locations", $text_domain)."' class='button'>
    <table class='widefat'><thead><tr style='/*background-color:black*/'>";
    
    $array_to_be_counted=(is_array($the_array[0]))? $the_array[0] : $the_array[1] ; //needed for the csv import (where first line is usually skipped)  vs the point-click-add import (where there's only the first line)
    for ($ctr=1; $ctr<=count($array_to_be_counted); $ctr++) {
    print "<td><select name='field_map[]'>";
    print "<option value=''>".__("Choose")."</option>
            <option value='sl_store'>".__("Name", $text_domain)."</option>
                <option value='sl_address'>".__("Street(Line1)", $text_domain)."</option>
                <option value='sl_address2'>".__("Street(Line2)", $text_domain)."</option>
                <option value='sl_city'>".__("City", $text_domain)."</option>
                <option value='sl_state'>".__("State", $text_domain)."</option>
                <option value='sl_zip'>".__("Zip", $text_domain)."</option>
                <option value='sl_tags'>".__("Tags", $text_domain)."</option>
                <option value='sl_description'>".__("Description", $text_domain)."</option>
                <option value='sl_hours'>".__("Hours", $text_domain)."</option>
                <option value='sl_url'>".__("URL", $text_domain)."</option>
                <option value='sl_phone'>".__("Phone", $text_domain)."</option>
                <option value='sl_image'>".__("Image", $text_domain)."</option>
                <option value='sl_private'>".__("Is Private?", $text_domain)."</option>";
    print "</select></td>";
    }
    print "</tr></thead>";
    
    foreach ($the_array as $key=>$value) {
    print "<tr style='border-bottom:solid silver 1px'>";
    $bgcolor="#ddd";
    $ctr2=0;
    foreach ($value as $key2=>$value2) {
        $bgcolor=($bgcolor=="#fff" || empty($bgcolor))? "#ddd" : "#fff";
        print "<td style='background-color:$bgcolor'>$value2<input type='hidden' value='$value2' name='column{$ctr2}[]'></td>\n";
        $ctr2++;
    }
    print "</tr>\n";
    }
    print "</table><input type='hidden' name='finish_import' value='1'>
    <input type='hidden' name='total_entries' value='".(count($the_array))."'>
    <input type='button' value='".__("Cancel", $text_domain)."' class='button' onclick='history.go(-1)'>&nbsp;<input type='submit' value='".__("Import Locations", $text_domain)."' class='button'></form>";
}
/*--------------------------------------------------------------*/

function do_hyperlink(&$text, $target="'_blank'")
{
   // match protocol://address/path/
   $text = ereg_replace("[a-zA-Z]+://([.]?[a-zA-Z0-9_/?&amp;%20,=-\+-])*", "<a href=\"\\0\" target=$target>\\0</a>", $text);
   $text = ereg_replace("(^| )(www([.]?[a-zA-Z0-9_/=-\+-])*)", "\\1<a href=\"http://\\2\" target=$target>\\2</a>", $text);
   return $text;
}

/*--------------------------------------------------------------*/
function insert_matched_data() {
	global $wpdb;

	$ctr=0;
	foreach ($_POST[field_map] as $value) {
		if($value!="") {
			$selected_fields.="$value,";
			$column_number[]=$ctr;
		}
		$ctr++;
	}
	$selected_fields=substr($selected_fields,0, strlen($selected_fields)-1);

	
	for ($entry_number=0; $entry_number<$_POST[total_entries]; $entry_number++) { 
		for ($ctr2=0; $ctr2<count($column_number); $ctr2++) {
			$value_string.="'".trim($_POST["column{$column_number[$ctr2]}"][$entry_number])."',";
		}
		$value_string=substr($value_string,0, strlen($value_string)-1);
		$wpdb->query("INSERT INTO ".$wpdb->prefix."store_locator ($selected_fields) VALUES ($value_string)");
		$for_geo=$wpdb->get_results("SELECT CONCAT(sl_address, ', ',sl_address2,', ', sl_city, ', ', sl_state, ' ', sl_zip) as the_address FROM ".$wpdb->prefix."store_locator WHERE sl_id='".mysql_insert_id()."'", ARRAY_A);
		do_geocoding($for_geo[0][the_address]);
		$value_string="";

		}
}
/*-------------------------------------------------------------*/
function comma($a) {
	$a=ereg_replace('"', "&quot;", $a);
	$a=ereg_replace("'", "&#39;", $a);
	$a=ereg_replace(">", "&gt;", $a);
	$a=ereg_replace("<", "&lt;", $a);
	$a=ereg_replace(" & ", " &amp; ", $a);
	return ereg_replace("," ,"&#44;" ,$a);
	
}


/*-----------------------------------------------------------*/
function url_test($url) {
	return (strtolower(substr($url,0,7))=="http://");
}

/************************************************************
 * Copy a file, or recursively copy a folder and its contents
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.1
 * @link        http://aidanlister.com/repos/v/function.copyr.php
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @return      bool     Returns TRUE on success, FALSE on failure
 */
function copyr($source, $dest)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, 0755);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        copyr("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}

