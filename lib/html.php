<?php
/**
 * Html class file
 * 
 * @author Francisco Barrento <me@francisco.barrento.com>
 * @copyright 2014 Francisco Barrento
 * @license http://opensource.org/licenses/GPL-3.0
 */

/**
 * Html is a static class that provides a collection os helper methods for creating HTML views.
 *
 * Almost all of the methods in this class allow setting additional attributes for the html
 * tags they generate.
 *
 * @since 1.0
 */

class Html
{
	
	public static function tag($tag, $content, $htmlOptions = [], $closeTag=true)
	{
		if(!$tag)
			return '';
		$html = '';

		$html .=  self::openTag($tag, $htmlOptions).' '. $content .' '.self::closeTag($tag);
		return $html; 
	}

	/**
	 * Generates an open HTML tag
	 * @param  string $tag the tag name
	 * @param  array $htmlOptions the elemnts attributes.
	 * @return string the generated HTML element tag
	 */
	public static function openTag($tag, $htmlOptions = [])
	{
		return '<' . $tag . self::renderAttributes($htmlOptions) .'>';
	}

	/**
	 * [closeTag description]
	 * @param  string $tag the tag name
	 * @return string the HTML element close tag
	 */
	public static function closeTag($tag)
	{
		return '</' . $tag . '>';
	}

	public static function link($text, $url='#', $htmlOptions = [] )
	{
		
		$htmlOptions['href'] = $url;
		return self::tag('a',$text, $htmlOptions);
	}


	public static function removeBrackets($tag)
	{
		$brackets = ['[',']','(',')','{','}','<','>'];
		return  str_replace($brackets, '', $tag);


	}


	/**
	 * Renders the HTML tag attributes.
	 * @param  array $htmlOptions attributes to be rendered
	 * @return string the rendering result
	 */
	public static function renderAttributes($htmlOptions = [])
	{
		
		if($htmlOptions === [])
			return '';
		$html = '';

		foreach ($htmlOptions as $name => $value) {
			$html .= ' ' . $name .'='.'"'.$value.'"';
		}

		return $html;

	}
}














