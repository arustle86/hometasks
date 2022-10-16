<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

trait Script_Trait {
	
	private function add_prefix_to_css( $css, $prefix ) {
	    $parts = explode('}', $css);
	    foreach ($parts as &$part) {
	        if (empty($part)) {
	            continue;
	        }

	        $firstPart = substr($part, 0, strpos($part, '{') + 1);
	        $lastPart = substr($part, strpos($part, '{') + 2);
	        $subParts = explode(',', $firstPart);
	        foreach ($subParts as &$subPart) {
	            $subPart = str_replace("\n", '', $subPart);
	            $subPart = $prefix . ' ' . trim($subPart);
	        }

	        $part = implode(', ', $subParts) . $lastPart;
	    }

	    $prefixedCSS = implode("}\n", $parts);

	    return $prefixedCSS;
	}

	private function output_css( $css ) {
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css );
		return $css;
	}
}