<?php

/* Color functions */

function crf_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ).substr($hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1).substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1).substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) ) ;
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	return array( $r, $g, $b );
}

function crf_color_add ( $hex1, $hex2 ) {
	$rgb1 = crf_hex2rgb( $hex1 );
	$rgb2 = crf_hex2rgb( $hex2 );
	$rgb = array();

	for ( $i=0; $i<3; $i++ )
	{
		$rgb[$i] = $rgb1[$i] + $rgb2[$i];
		if ( $rgb[$i] > 255 ) $rgb[$i] = 255;
	}

	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
}

function crf_color_minus ( $hex1, $hex2 ) {
	$rgb1 = crf_hex2rgb( $hex1 );
	$rgb2 = crf_hex2rgb( $hex2 );
	$rgb = array();

	for ( $i=0; $i<3; $i++ )
	{
		$rgb[$i] = $rgb1[$i] - $rgb2[$i];
		if ( $rgb[$i] < 0 ) $rgb[$i] = 0;
	}

	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
}

function crf_fadeout( $hex, $decrease ) {
	$percent = 100 - $decrease;
	$percent = ( ( $percent < 0 )? 0 : $percent ) / 100;
	$rgb = crf_hex2rgb( $hex );
	return sprintf( 'rgba(%d,%d,%d,%f)', $rgb[0], $rgb[1], $rgb[2], $percent );
}

function crf_hex2hsl( $HexColor )
{
	$HexColor    = str_replace( '#', '', $HexColor );
	if( strlen( $HexColor ) < 3 ) str_pad( $HexColor, 3 - strlen( $HexColor ), '0' );
	$Add         = strlen( $HexColor ) == 6 ? 2 : 1;
	$AA          = 0;
	$AddOn       = $Add == 1 ? ( $AA = 16 - 1 ) + 1 : 1;
	$Red         = round( ( hexdec( substr( $HexColor, 0, $Add ) ) * $AddOn + $AA ) / 255, 6 );
	$Green       = round( ( hexdec( substr( $HexColor, $Add, $Add ) ) * $AddOn + $AA ) / 255, 6 );
	$Blue        = round( ( hexdec( substr( $HexColor, ( $Add + $Add ) , $Add ) ) * $AddOn + $AA ) / 255, 6 );

	$HSLColor    = array( 'Hue' => 0, 'Saturation' => 0, 'Luminance' => 0 );
	$Minimum     = min( $Red, $Green, $Blue );
	$Maximum     = max( $Red, $Green, $Blue );
	$Chroma      = $Maximum - $Minimum;

	$HSLColor['Luminance'] = ( $Minimum + $Maximum ) / 2;
	if( $Chroma == 0 )
	{
		$HSLColor['Luminance'] = round( $HSLColor['Luminance'] * 100, 0 );
		return $HSLColor;
	}

	$Range = $Chroma * 6;

	$HSLColor['Saturation'] = $HSLColor['Luminance'] <= 0.5 ? $Chroma / ( $HSLColor['Luminance'] * 2 ) : $Chroma / ( 2 - ( $HSLColor['Luminance'] * 2 ) );
	if( $Red <= 0.004 || $Green <= 0.004 || $Blue <= 0.004 )
		$HSLColor['Saturation'] = 1;

	if( $Maximum == $Red )
	{
		$HSLColor['Hue'] = round( ( $Blue > $Green ? 1 - ( abs( $Green - $Blue ) / $Range ) : ( $Green - $Blue ) / $Range ) * 360, 0 );
	}
	else if( $Maximum == $Green )
	{
		$HSLColor['Hue'] = round( ( $Red > $Blue ? abs( 1 - ( 4 / 3 ) + ( abs ( $Blue - $Red ) / $Range ) ) : ( 1 / 3 ) + ( $Blue - $Red ) / $Range ) * 360, 0 );
	}
	else
	{
		$HSLColor['Hue'] = round( ( 2 / 3 + ( $Red - $Green ) / $Range ) * 360, 0 );
	}
	$HSLColor['Saturation'] = round( $HSLColor['Saturation'] * 100, 0 );
	$HSLColor['Luminance']  = round( $HSLColor['Luminance'] * 100, 0 );
	return $HSLColor;
}


function crf_hsl2hex( $HSLColor )
{
	$RGBColor    = array( 'Red' => 0, 'Green' => 0, 'Blue' => 0 );
	foreach( $HSLColor as $Name => $Value )
	{
		if( $Name == 'Hue' ) {
			$Value = round( round( (int)str_replace( '%', '', $Value ) / 360, 2 ) * 255, 0 );
		} else {
			$Value = round( round( (int)str_replace( '%', '', $Value ) / 100, 2 ) * 255, 0 );
		}

		$Value    = (int)$Value * 1;
		$Value    = $Value > 255 ? 255 : ( $Value < 0 ? 0 : $Value );
		$ValuePct = round( $Value / 255, 6 );

		$$Name = $ValuePct;
	}
	$RGBColor['Red']   = $Luminance;
	$RGBColor['Green'] = $Luminance;
	$RGBColor['Blue']  = $Luminance;

	$Radial  = $Luminance <= 0.5 ? $Luminance * ( 1.0 + $Saturation ) : $Luminance + $Saturation - ( $Luminance * $Saturation );

	if( $Radial > 0 )
	{
		$Ma   = $Luminance + ( $Luminance - $Radial );
		$Sv   = round( ( $Radial - $Ma ) / $Radial, 6 );
		$Th   = $Hue * 6;
		$Wg   = floor( $Th );
		$Fr   = $Th - $Wg;
		$Vs   = $Radial * $Sv * $Fr;
		$Mb   = $Ma + $Vs;
		$Mc   = $Radial - $Vs;

		// Color is between yellow and green
		if ($Wg == 1)
		{
			$RGBColor['Red']   = $Mc;
			$RGBColor['Green'] = $Radial;
			$RGBColor['Blue']  = $Ma;
		}
		// Color is between green and cyan
		else if( $Wg == 2 )
		{
			$RGBColor['Red']   = $Ma;
			$RGBColor['Green'] = $Radial;
			$RGBColor['Blue']  = $Mb;
		}

		// Color is between cyan and blue
		else if( $Wg == 3 )
		{
			$RGBColor['Red']   = $Ma;
			$RGBColor['Green'] = $Mc;
			$RGBColor['Blue']  = $Radial;
		}

		// Color is between blue and magenta
		else if( $Wg == 4 )
		{
			$RGBColor['Red']   = $Mb;
			$RGBColor['Green'] = $Ma;
			$RGBColor['Blue']  = $Radial;
		}

		// Color is between magenta and red
		else if( $Wg == 5 )
		{
			$RGBColor['Red']   = $Radial;
			$RGBColor['Green'] = $Ma;
			$RGBColor['Blue']  = $Mc;
		}

		// Color is between red and yellow or is black
		else
		{
			$RGBColor['Red']   = $Radial;
			$RGBColor['Green'] = $Mb;
			$RGBColor['Blue']  = $Ma;
		}
	}

	$RGBColor['Red']   = ($C = round( $RGBColor['Red'] * 255, 0 )) <= 15 ? '0'.dechex( $C ) : dechex( $C );
	$RGBColor['Green'] = ($C = round( $RGBColor['Green'] * 255, 0 )) <= 15 ? '0'.dechex( $C ) : dechex( $C );
	$RGBColor['Blue']  = ($C = round( $RGBColor['Blue'] * 255, 0 )) <= 15 ? '0'.dechex( $C ) : dechex( $C );

	return '#' . $RGBColor['Red'].$RGBColor['Green'].$RGBColor['Blue'];
}

function crf_change_hsl( $hex, $h, $s, $l ) {
	$hsl = crf_hex2hsl( $hex );
	$hsl['Hue'] += $h;
	$hsl['Hue'] = ( $hsl['Hue'] < 0 )? 0 : $hsl['Hue'];
	$hsl['Hue'] = ( $hsl['Hue'] > 360 )? 360 : $hsl['Hue'];
	$hsl['Saturation'] += $s;
	$hsl['Saturation'] = ( $hsl['Saturation'] < 0 )? 0 : $hsl['Saturation'];
	$hsl['Saturation'] = ( $hsl['Saturation'] > 100 )? 100 : $hsl['Saturation'];
	$hsl['Luminance'] += $l;
	$hsl['Luminance'] = ( $hsl['Luminance'] < 0 )? 0 : $hsl['Luminance'];
	$hsl['Luminance'] = ( $hsl['Luminance'] > 100 )? 100 : $hsl['Luminance'];
	return crf_hsl2hex( $hsl );
}