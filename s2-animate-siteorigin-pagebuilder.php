<?php 
/*
Plugin Name: s2 Animate SiteOrigin PageBuilder
Plugin URI:
Description: With a few simple statements enable anmation for SiteOrigin PageBuilder
Version: 1.0.4
Author: Sebas2
Author URI: http://s2.sebas2.nl
License: GNU GPL
*/

// Start the plugin
add_action(
     'plugins_loaded',
     [ s2_reveal_siteorigin::get_instance(), 'plugin_setup' ]
 );
   
class s2_reveal_siteorigin {

     # Singleton
     protected static $instance = NULL;

     private $options;

     # Leave empty
     public function __construct() {}

     # Singleton
     public static function get_instance()
     {
          NULL === self::$instance and self::$instance = new self;
          return self::$instance;
     }

     # Start our action hooks
     public function plugin_setup() {
          add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script') );

          add_filter( 'siteorigin_panels_row_style_fields', array( $this, 'custom_row_style_fields' )  );
          add_filter( 'siteorigin_panels_row_style_fields', array( $this, 'custom_row_style_id_fields' )  );
          add_filter( 'siteorigin_panels_widget_style_fields', array( $this, 'custom_widget_style_fields' )  );
          add_filter( 'siteorigin_panels_row_style_attributes', array( $this, 'custom_row_style_attributes' ), 10, 2 );
          add_filter( 'siteorigin_panels_row_style_attributes', array( $this, 'custom_row_style_id_attributes' ), 11, 2  );
          add_filter( 'siteorigin_panels_widget_style_attributes', array( $this, 'custom_widget_style_attributes' ), 10, 2  );
     }

     public function enqueue_script()
     {
          wp_enqueue_script( 'sr_js', plugins_url( 'js/sr.js', __FILE__ ), array( 'jquery' ), '1.1', true );
          wp_enqueue_script( 'app_js', plugins_url( 'js/app.js', __FILE__ ), false );
     }

     // Row level
     function custom_row_style_fields($fields) {
          $fields['datasr'] = array(
               'name'        => __('Data Sr', 'siteorigin-panels'),
               'type'        => 'text',
               'group'       => 'attributes',
               'description' => __('Add option to add Scroll Reveal entities', 'siteorigin-panels'),
               'priority'    => 8,
          );
          return $fields;
     }
     
     public function custom_row_style_attributes( $attributes, $args ) {
          if( !empty( $args['datasr'] ) ) {
              @array_push(   $attributes['data-sr'] = $args['datasr'], 'datasr');
          }
          return $attributes;
     }

     public function custom_widget_style_fields($fields) {
          $fields['datasr'] = array(
              'name'        => __('Data Sr', 'siteorigin-panels'),
              'type'        => 'text',
              'group'       => 'attributes',
              'description' => __('Add option to add Scroll Reveal entities', 'siteorigin-panels'),
              'priority'    => 8,
          );
         
          return $fields;
     }

     // Row level make it possibel to add ids
     public function custom_row_style_id_fields($fields) {
          $fields['ID'] = array(
          'name'        => __('ID', 'siteorigin-panels-id'),
          'type'        => 'text',
          'group'       => 'attributes',
          'description' => __('Add ID for scroll to Plugin', 'siteorigin-panels-id'),
          'priority'    => 9,
          );
     
          return $fields;
     }

     public function custom_row_style_id_attributes( $attributes, $args ) {
          if( !empty( $args['ID'] ) ) {
          @array_push(   $attributes['ID'] = $args['ID'], 'ID');
          }
          return $attributes;
     }

     public function custom_widget_style_attributes( $attributes, $args ) {
          if( !empty( $args['datasr'] ) ) {
               @array_push(   $attributes['data-sr'] = $args['datasr'], 'datasr');
          }
          return $attributes;
     }
}