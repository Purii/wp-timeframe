<?php
/**
 * Plugin Name: Timeframe
 * Plugin URI: https://github.com/Purii/wp-timeframe
 * Description: Show or hide certain parts of any page at a defined range of time.
 * Version: 0.1.0
 * Author: Patrick Puritscher
 * Author URI: patrickpuritscher.com
 * License: GPL-2.0+
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Timeframe {

	/**
	 * Set default format of DateTime
	 * @var String set DateFormat
	 */
	private $dateFormat = "d-m-Y H:i:s";


	public function __construct() {
		add_shortcode( 'timeframe', array( $this, 'shortcode_timeframe' ) );
	}

	/**
	 * Do Shortcode TIMEFRAME
	 * @param $atts Attributes
	 * @param String $content
	 *
	 * @return string
	 */
	public function shortcode_timeframe( $atts, $content = null ) {
		$attributes = shortcode_atts( array(
			'hidefrom'           => null,
			'hideuntil'          => null,
			'showfrom'           => null,
			'showuntil'          => null,
			'alternativecontent' => ''
		), $atts );

		/* Select type */
		$type = null;
		if ( null === $attributes['hidefrom'] && null === $attributes['hideuntil'] && null !== $attributes['showfrom'] && null !== $attributes['showuntil'] ) {
			$from  = $attributes['showfrom'];
			$until = $attributes['showuntil'];
			$type  = "show";
		} else if ( null === $attributes['showfrom'] && null === $attributes['showuntil'] && null !== $attributes['hidefrom'] && null !== $attributes['hideuntil'] ) {
			$from  = $attributes['hidefrom'];
			$until = $attributes['hideuntil'];
			$type  = "hide";
		} else {
			return $this->getStringNotProper();
		}

		/* Parse Datetime */
		if ( ! $this->validateDate( $from ) || ! $this->validateDate( $until ) ) {
			return $this->getStringNotValid();
		}
		$parsedfrom  = new DateTime( $from );
		$parseduntil = new DateTime( $until );

		/* Check if DateTime is in Frame */
		$isInFrame = $this->isInFrame( $parsedfrom, $parseduntil );
		if ( ( ! $isInFrame && $type == "hide" ) || ( $isInFrame && $type == "show" ) ) {
			return do_shortcode( $content );
		}

		return $attributes['alternativecontent'];
	}

	/**
	 * Check if $current is betweend $hidefrom and $hideuntil
	 * @param DateTime $hidefrom
	 * @param DateTime $hideuntil
	 * @param DateTime $current Current DateTime is optional.
	 *
	 * @return bool
	 */
	private function isInFrame( $hidefrom, $hideuntil, $current = null ) {
		if ( null === $current ) {
			/* Current DateTime from WordPress */
			$current = new DateTime( current_time( $this->dateFormat ) );
		}
		if ( $hidefrom < $current && $current < $hideuntil ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if String is a valid Date
	 * @param String $date
	 * @param String $format
	 *
	 * @return bool
	 */
	private function validateDate( $date, $dateFormat = null ) {
		if ( null === $dateFormat ) {
			$dateFormat = $this->dateFormat;
		}
		$d = DateTime::createFromFormat( $dateFormat, $date );

		return $d && $d->format( $dateFormat ) == $date;
	}

	private function getStringNotValid() {
		return "<span style=\"color:red;font-weight:bold\">[PLUGIN TIMEFRAME] Please use a valid format to define the dates: <em title=\"04-05-2015 09:00:00\">$this->dateFormat</em></strong>.";
	}

	private function getStringNotProper() {
		return "<span style=\"color:red;font-weight:bold\">[PLUGIN TIMEFRAME] Please choose either <em>hidefrom & hideuntil</em> or <em>showfrom & showuntil</em>.";
	}
}

add_action( 'plugins_loaded', function () {
	new Timeframe();
} );
