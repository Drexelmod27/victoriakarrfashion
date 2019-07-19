<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
class FleurMikadoImport {
    /**
     * @var instance of current class
     */
    private static $instance;

    /**
     * Name of folder where revolution slider will stored
     * @var string
     */
    private $revSliderFolder;
    
    /**
     *
     * URL where are import files
     * @var string
     */
    private $importURI;
    
    /**
     * @return MikadoCoreImport
     */
    public static function getInstance() {
        if(self::$instance === null) {
            return new self();
        }

        return self::$instance;
    }

    public $message = "";
    public $attachments = false;
    function __construct() {
        $this->revSliderFolder = 'mkd-rev-sliders';
        $this->importURI       = 'http://export.mikado-themes.com/';

        add_action('admin_menu', array(&$this, 'mkd_admin_import'));
        add_action('admin_init', array(&$this, 'mkd_register_theme_settings'));

    }
    function mkd_register_theme_settings() {
        register_setting( 'mkd_options_import_page', 'mkd_options_import');
    }

    function init_mkd_import() {
        if(isset($_REQUEST['import_option'])) {
            $import_option = $_REQUEST['import_option'];
            if($import_option == 'content'){
                $this->import_content('proya_content.xml');
            }elseif($import_option == 'custom_sidebars') {
                $this->import_custom_sidebars('custom_sidebars.txt');
            } elseif($import_option == 'widgets') {
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
            } elseif($import_option == 'options'){
                $this->import_options('options.txt');
            }elseif($import_option == 'menus'){
                $this->import_menus('menus.txt');
            }elseif($import_option == 'settingpages'){
                $this->import_settings_pages('settingpages.txt');
            }elseif($import_option == 'complete_content'){
                $this->import_content('proya_content.xml');
                $this->import_options('options.txt');
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
                $this->import_menus('menus.txt');
                $this->import_settings_pages('settingpages.txt');
                $this->message = esc_html__("Content imported successfully", "fleur");
            }
        }
    }

	public function import_content($file){
		ob_start();
		require_once(MIKADO_CORE_ABS_PATH . '/import/class.wordpress-importer.php');
		$mkd_import = new WP_Import();
		set_time_limit(0);

		$mkd_import->fetch_attachments = $this->attachments;
		$returned_value = $mkd_import->import($file);
		if(is_wp_error($returned_value)){
			$this->message = esc_html__("An Error Occurred During Import", "mkd-core");
		}
		else {
			$this->message = esc_html__("Content imported successfully", "mkd-core");
		}
		ob_get_clean();
	}

    public function import_widgets($file, $file2){
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array) $options['widgets'] as $mkd_widget_id => $mkd_widget_data) {
            update_option( 'widget_' . $mkd_widget_id, $mkd_widget_data );
        }
        $this->import_sidebars_widgets($file);
        $this->message = esc_html__("Widgets imported successfully", "fleur");
    }

    public function import_sidebars_widgets($file){
        $mkd_sidebars = get_option("sidebars_widgets");
        unset($mkd_sidebars['array_version']);
        $data = $this->file_options($file);
        if ( is_array($data['sidebars']) ) {
            $mkd_sidebars = array_merge( (array) $mkd_sidebars, (array) $data['sidebars'] );
            unset($mkd_sidebars['wp_inactive_widgets']);
            $mkd_sidebars = array_merge(array('wp_inactive_widgets' => array()), $mkd_sidebars);
            $mkd_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($mkd_sidebars);
        }
    }

    public function import_custom_sidebars($file){
        $options = $this->file_options($file);
        update_option( 'mkd_sidebars', $options);
        $this->message = esc_html__("Custom sidebars imported successfully", "fleur");
    }

    public function import_options($file){
        $options = $this->file_options($file);
        update_option( 'mkd_options_fleur', $options);
        $this->message = esc_html__("Options imported successfully", "fleur");
    }

    public function import_menus($file){
        global $wpdb;
        $mkd_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $mkd_terms_table where slug=%s", $menu_slug), ARRAY_A);
            if(isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );

    }
    public function import_settings_pages($file){
        $pages = $this->file_options($file);
        foreach($pages as $mkd_page_option => $mkd_page_id){
            update_option( $mkd_page_option, $mkd_page_id);
        }
    }
    public function rev_sliders() {
        $rev_sldiers = array(
            'bridal-shop.zip',
            'home-1-slider.zip',
            'home-furniture.zip',
            'home-shop-sidebar.zip',
            'home-small-business.zip',
            'home-vertical-slider.zip',
            'invitation.zip',
            'main-home-inner.zip',
            'wedding-cakes.zip',
            'wedding-planner.zip'
        );
        
        return $rev_sldiers;
    }

    public function create_rev_slider_files( $folder ) {
        $rev_list = $this->rev_sliders();
        $dir_name = $this->revSliderFolder;
        
        $upload     = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/' . $dir_name;
        if ( ! is_dir( $upload_dir ) ) {
            mkdir( $upload_dir, 0700 );
            mkdir( $upload_dir . '/' . $folder, 0700 );
        }
        
        foreach ( $rev_list as $rev_slider ) {
            file_put_contents( WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider, file_get_contents( $this->importURI . '/' . $folder . '/revslider/' . $rev_slider ) );
        }
    }
    
    public function rev_slider_import( $folder ) {
        $this->create_rev_slider_files( $folder );
        
        $rev_sliders   = $this->rev_sliders();
        $dir_name      = $this->revSliderFolder;
        $absolute_path = __FILE__;
        $path_to_file  = explode( 'wp-content', $absolute_path );
        $path_to_wp    = $path_to_file[0];
        
        require_once( $path_to_wp . '/wp-load.php' );
        require_once( $path_to_wp . '/wp-includes/functions.php' );
        require_once( $path_to_wp . '/wp-admin/includes/file.php' );
        
        $rev_slider_instance = new RevSlider();
        
        foreach ( $rev_sliders as $rev_slider ) {
            $nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
            $rev_slider_instance->importSliderFromPost( true, true, $nf );
        }
    }

    public function file_options($file){
        $file_content = "";
        $file_for_import = get_template_directory() . '/includes/import/files/' . $file;
        /*if ( file_exists($file_for_import) ) {
            $file_content = $this->mkd_file_contents($file_for_import);
        } else {
            $this->message = esc_html__("File doesn't exist", "fleur");
        }*/
        $file_content = $this->mkd_file_contents($file);
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        return false;
    }

    function mkd_file_contents( $path ) {
		$url      = "http://export.mikado-themes.com/".$path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

    function mkd_admin_import() {
        if (mkd_core_theme_installed()) {
            global $fleur_Framework;

            $slug = "_tabimport";
            $this->pagehook = add_submenu_page(
                'fleur_mikado_theme_menu',
                'Mikado Options - Mikado Import',                   // The value used to populate the browser's title bar when the menu page is active
                'Import',                   // The text of the menu in the administrator's sidebar
                'administrator',                  // What roles are able to access the menu
                'fleur_mikado_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
                array($fleur_Framework->getSkin(), 'renderImport')
            );

            add_action('admin_print_scripts-'.$this->pagehook, 'fleur_mikado_enqueue_admin_scripts');
            add_action('admin_print_styles-'.$this->pagehook, 'fleur_mikado_enqueue_admin_styles');
            //$this->pagehook = add_menu_page('Mikado Import', 'Mikado Import', 'manage_options', 'mkd_options_import_page', array(&$this, 'mkd_generate_import_page'),'dashicons-download');
        }
    }

	function mkd_update_meta_fields_after_import( $folder ) {
		global $wpdb;

		$url         = home_url( '/' );
		$demo_urls   = $this->mkd_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$sql_query   = "SELECT meta_id, meta_value FROM " . $wpdb->postmeta . " WHERE meta_key LIKE 'mkd%' AND meta_value LIKE '" . esc_url( $demo_url ) . "%';";

			$meta_values = $wpdb->get_results( $sql_query );

			if ( ! empty( $meta_values ) ) {
				foreach ( $meta_values as $meta_value ) {
					$new_value = $this->mkd_recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );

					$wpdb->update( $wpdb->postmeta,	array( 'meta_value' => $new_value ), array( 'meta_id' => $meta_value->meta_id )	);
				}
			}
		}
	}

	function mkd_update_options_after_import( $folder ) {
		$url       = home_url( '/' );
		$demo_urls = $this->mkd_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$global_options    = get_option( 'mkd_options_fleur' );
			$new_global_values = str_replace( $demo_url, $url, $global_options );

			update_option( 'mkd_options_fleur', $new_global_values );
		}
	}

	function mkd_import_get_demo_urls( $folder ) {
		$demo_urls  = array();
		$domain_url = str_replace( '/', '', $folder ) . '.mikado-themes.com/';

		$demo_urls[] = ! empty( $domain_url ) ? 'http://' . $domain_url : '';
		$demo_urls[] = ! empty( $domain_url ) ? 'https://' . $domain_url : '';

		return $demo_urls;
	}

	function mkd_recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', 'mkd_recalc_serialized_lengths_callback', $sObject );

		return $ret;
	}

	function mkd_recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}
}

function mkd_init_import_object(){
    global $fleur_import_object;
    $fleur_import_object = new FleurMikadoImport();
}

add_action('init', 'mkd_init_import_object');

if(!function_exists('fleur_mikado_dataImport')){
    function fleur_mikado_dataImport(){
        global $fleur_import_object;

        if ($_POST['import_attachments'] == 1)
            $fleur_import_object->attachments = true;
        else
            $fleur_import_object->attachments = false;

        $folder = "fleur/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $fleur_import_object->import_content($folder.$_POST['xml']);

        die();
    }

    add_action('wp_ajax_mkd_dataImport', 'fleur_mikado_dataImport');
}

if(!function_exists('fleur_mikado_widgetsImport')){
    function fleur_mikado_widgetsImport(){
        global $fleur_import_object;

        $folder = "fleur/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $fleur_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

        die();
    }

    add_action('wp_ajax_mkd_widgetsImport', 'fleur_mikado_widgetsImport');
}

if(!function_exists('fleur_mikado_optionsImport')){
    function fleur_mikado_optionsImport(){
        global $fleur_import_object;

        $folder = "fleur/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $fleur_import_object->import_options($folder.'options.txt');

        die();
    }

    add_action('wp_ajax_mkd_optionsImport', 'fleur_mikado_optionsImport');
}

if(!function_exists('fleur_mikado_otherImport')){
    function fleur_mikado_otherImport(){
        global $fleur_import_object;

        $folder = "fleur/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $fleur_import_object->import_options($folder.'options.txt');
        $fleur_import_object->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
        $fleur_import_object->import_menus($folder.'menus.txt');
        $fleur_import_object->import_settings_pages($folder.'settingpages.txt');
        if ( mkd_core_is_revolution_slider_installed() ) {
            $fleur_import_object->rev_slider_import( $folder );
        }
		$fleur_import_object->mkd_update_meta_fields_after_import( $folder );
		$fleur_import_object->mkd_update_options_after_import( $folder );
        die();
    }

    add_action('wp_ajax_mkd_otherImport', 'fleur_mikado_otherImport');
}