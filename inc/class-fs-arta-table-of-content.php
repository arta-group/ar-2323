<?php

class FS_Arta_Table_Of_Content
{
	public function init ()
	{
		if ( is_singular( 'post' ) )
		{
			add_filter( 'the_content', array(
				$this,
				'add_table_of_contents'
			) );
		}
	}

	public function add_table_of_contents ( $content = '' )
	{
		$h2s   = $this->get_heading_tags( 'h2', $content );
		$items = $h2s;

		$content = $this->add_ids_and_jump_to_links( 'h2', $content );

		ob_start();

		if ( $items )
		{
			$iteration = 0;
			echo '<div class="mag-single content-table">';
			echo '<p class="content-header" id="content-header"> فهرست مطالب </p>';
			echo '<div class="content-container">';
			echo '<ul class="flex flex-col home mt-1/5 mb-2 justify-start content-list">';
			foreach ( $items as $item )
			{
				$active = $iteration == 0 ? ' active' : '';
				echo '<li class="content-item ml-2 mb-2' . $active . '">';
				echo '<a href="#' . strtolower( urlencode( $item[ 2 ] ) ) . '" class="md m-0 pr-2 pl-2">' . $item[ 2 ] . '</a>';
				echo '</li>';

				$iteration ++;
			}
			echo '</ul>';
			echo '</div>';
			echo '</div>';
		}

		$toc = ob_get_contents();

		ob_end_clean();

		$content = str_replace( '<p>', '<p class="text-base text-black-700 leading-12 text-justify lg:text-right">', $content );

		return $toc . $content;
	}

	private function add_ids_and_jump_to_links ( $tag, $content )
	{
		$items = $this->get_heading_tags( $tag, $content );
		foreach ( $items as $item )
		{
			$replacement = '';
			$matches[]   = $item[ 0 ];
			$id          = strtolower( urlencode( $item[ 2 ] ) );

			$replacement .= sprintf( '<%1$s id="%2$s">%3$s</%1$s>', $tag, $id, $item[ 2 ] );

			$replacements[] = $replacement;
		}

		$content = str_replace( $matches, $replacements, $content );

		return $content;
	}

	private function get_heading_tags ( $tag, $content = '' )
	{
		if ( empty( $content ) )
			$content = get_the_content();

		preg_match_all( "/(<{$tag}.*?>)(.*)(<\/{$tag}>)/", $content, $matches, PREG_SET_ORDER );

		return $matches;
	}
}

$toc = new FS_Arta_Table_Of_Content();
add_action( 'template_redirect', array(
	$toc,
	'init'
) );