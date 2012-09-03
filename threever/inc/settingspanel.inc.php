<?php
//
//  SETTINGS CONFIGURATION CLASS
//
//  By Olly Benson / v 1.3 / 20 November 2011 / http://code.olib.co.uk
//
//  HOW TO USE
//  * add a include() to this file in your plugin. 
//  * amend the config class below to add your own settings requirements. 
//  * to avoid potential conflicts change the namespace to something unique.
//  * Full details of how to use Settings see here: http://codex.wordpress.org/Settings_API  
 

 
namespace threever;  

class settings_config {
var $group = __NAMESPACE__; // defines setting groups (should be bespoke to your settings) 

var $menu = array( 
	'page_name' => __NAMESPACE__, // defines which pages settings will appear on. Either bespoke or media/discussion/reading etc
	'title' => "Threever - 3D Content Plugin using three.js",  // page title that is displayed 
	'intro_text' => "This is the plugins configuration page where you are able to modify all of threevers presets and standard values", // text below title
	'nav_title' => "Threever" // how page is listed on left-hand Settings panel
	);

var $sections = array(
    'slideshow' => array(
        'title' => "Display options",
        'description' => "Settings to do with how the plugin is displayed",
        'fields' => array (
          'width' => array (
              'label' => "Width",
              'description' => "Width of the slideshow",
              'length' => "3",
              'suffix' => "px",
              'default_value' => "640"
              ),
          'height' => array (
              'label' => "Height",
              'description' => "Height of the slideshow",
              'length' => "3",
              'suffix' => "px",
              'default_value' => "240"
              ),
    
	'effect' => array (        
              'label' => "Effect",
              'description' => "Which effect would you like on the slideshow?",
              'default_value' => "random",
              'dropdown' => "dd_effect"
              ),
          'slices' => array (
              'label' => "Number of Slides",
              'description' => "How many slides do you want to appear?",
              'default_value' => "5"
              )
          )
        )
    );


var $dropdown_options = array (
    'dd_effect' => array (
        'random' => "Random",
        'sliceDown' => "sliceDown",
        'sliceDownLeft' => "sliceDownLeft",
        'sliceUp' => "sliceUp",
        'sliceUpLeft' => "sliceUpLeft",
        'sliceUpDown' => "sliceUpDown",
        'sliceUpDownLeft' => "sliceUpDownLeft",
        'fold' => "fold",
        'fade' => "fade"
        )
    );

//  end class
};



class settings {
var $settingsConfig = NULL;
 
function __CONSTRUCT() {
	$this->settingsConfig = get_class_vars(sprintf('\%s\settings_config',__NAMESPACE__));
    if (function_exists('add_action')) :
      add_action('admin_init', array( &$this, 'admin_init'));
      add_action('admin_menu', array( &$this, 'admin_add_page'));
      endif;
}
 
function admin_add_page() {
	extract($this->settingsConfig['menu']);
	add_options_page($title,$nav_title, 'manage_options', $page_name, array( &$this,'options_page'));
	}
 
function options_page() {
	printf('</pre><div><h2>%s</h2>%s<form action="options.php" method="post">',$this->settingsConfig['menu']['title'],$this->settingsConfig['menu']['intro_text']);
	settings_fields($this->settingsConfig['group']);
	do_settings_sections($this->settingsConfig['menu']['page_name']);
	printf('<input type="submit" name="Submit" value="%s" /></form></div><pre>',__('Save Changes'));
	}
 
function admin_init(){
  foreach ($this->settingsConfig["sections"] AS $section_key=>$section_value) :
    add_settings_section($section_key, $section_value['title'], array( &$this, 'section_text'), $this->settingsConfig['menu']['page_name'], $section_value);
    foreach ($section_value['fields'] AS $field_key=>$field_value) :
      $function = (!empty($field_value['dropdown'])) ? array( &$this, 'setting_dropdown' ) : array( &$this, 'setting_string' );
      $function = (!empty($field_value['function'])) ? $field_value['function'] : $function;
      $callback = (!empty($field_value['callback'])) ? $field_value['callback'] : NULL;
      add_settings_field($this->settingsConfig['group'].'_'.$field_key, $field_value['label'], $function, $this->settingsConfig['menu']['page_name'], 
		$section_key,array_merge($field_value,array('name' => $this->settingsConfig['group'].'_'.$field_key)));
      register_setting($this->settingsConfig['group'], $this->settingsConfig['group'].'_'.$field_key,$callback);
      endforeach;
    endforeach;
  }
 
function section_text($value = NULL) {
	printf("%s",$this->settingsConfig['sections'][$value['id']]['description']);
	}
 
function setting_string($value = NULL) {
  $options = get_option($value['name']);
  $default_value = (!empty ($value['default_value'])) ? $value['default_value'] : NULL;
  printf('<input id="%s" type="text" name="%1$s[text_string]" value="%2$s" size="40" /> %3$s%4$s',
    $value['name'],
    (!empty ($options['text_string'])) ? $options['text_string'] : $default_value,
    (!empty ($value['suffix'])) ? $value['suffix'] : NULL,
    (!empty ($value['description'])) ? sprintf("<br /><em>%s</em>",$value['description']) : NULL);
  }
 
function setting_dropdown($value = NULL) {
  $options = get_option($value['name']);
  $default_value = (!empty ($value['default_value'])) ? $value['default_value'] : NULL;
  $current_value = ($options['text_string']) ? $options['text_string'] : $default_value;
    $chooseFrom = array();
    $choices = $this->settingsConfig['dropdown_options'][$value['dropdown']];
  foreach($choices AS $key=>$option) $chooseFrom[]= sprintf('<option value="%s" %s>%s</option>',$key,($current_value == $key ) ? ' selected="selected"' : NULL,$option);
  printf('<select id="%s" name="%1$s[text_string]">%2$s</select>%3$s',$value['name'],implode("",$chooseFrom),(!empty ($value['description'])) ? sprintf("<br /><em>%s</em>",$value['description']) : NULL);
  }
 
//end class
}
$a = (sprintf('\%s\settings',__NAMESPACE__));
$b = (sprintf("%s_init",__NAMESPACE__));
$$b = new $a;
?>