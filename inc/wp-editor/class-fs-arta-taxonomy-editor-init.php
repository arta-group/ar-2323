<?php

class FS_Arta_Taxonomy_Editor_Init
{
	/**
	 * @var Editor
	 */
	public $editor;

	/**
	 * Instantiates the class to work on all of the registered taxonomies.
	 *
	 * @since 1.0
	 */
	function run ()
	{
		add_action( 'admin_head-edit-tags.php', array(
			$this,
			'fix_editor_style'
		) );
		add_action( 'admin_head-edit-tags.php', array(
			$this,
			'load_wordcount_js'
		) );
		add_action( 'admin_head-term.php', array(
			$this,
			'load_wordcount_js'
		) );

		/* Retrieve an array of registered taxonomies */
		$taxonomies = get_taxonomies( '', 'names' );
		$taxonomies = apply_filters( 'visual_term_description_taxonomies', $taxonomies );

		/* Initialize the class */
		$this->editor = new FS_Arta_Taxonomy_Editor( $taxonomies );
		$this->editor->run();
	}

	/**
	 * Fix the formatting buttons on the HTML section of the visual editor from being full-width.
	 *
	 * @since 1.1
	 */
	function fix_editor_style ()
	{
		echo '<style>', ' .quicktags-toolbar input { width: auto; }', ' .column-description img { max-width: 100%; }', ' .term-description-wrap #post-status-info { width: auto; }', ' </style>';
	}

	/**
	 * Load the script for the word count functionality.
	 */
	function load_wordcount_js ()
	{
		wp_enqueue_script( 'fs-arta-word-count', get_template_directory_uri() . '/inc/wp-editor/wordcount.js', array(
			'jquery',
			'underscore',
			'word-count'
		) );
	}
}

$editor_init = new FS_Arta_Taxonomy_Editor_Init();
add_action( 'wp_loaded', array(
	$editor_init,
	'run'
), 999 );