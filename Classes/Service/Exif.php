<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Allmer <at@delusionworld.com>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once( dirname(__FILE__) . '/../../Resources/Private/PHP/pel/PelJpeg.php');

/**
 * ExifReader
 */
class Tx_Assets_Service_Exif {

	protected $pel;

	function __construct($file) {
		$this->setFile($file);
	}

	public function init() {
		if ($this->file) {
			$this->pel = new PelJpeg($this->file);
		}
		if ($this->pel) {
			$this->exif = $this->pel->getExif();
		}
		if ($this->exif) {
			$this->tiff = $this->exif->getTiff();
		}
		if ($this->tiff) {
			$this->ifd0 = $this->tiff->getIfd();
			return true;
		}
		return false;
	}

	public function setFile($file) {
		if ($file && $file !== $this->file && is_file($file)) {
			$this->file = $file;
		}
	}

	public function hasValidData($file = null) {
		if ($file) {
			$this->setFile($file);
		}

		if (!$this->ifd0 && $this->file) {
			try {
				return $this->init();
			}	catch(Exception $e)	{
				return false;
			}
		}

		return ($this->ifd0 && $this->file) ? true : false;
	}

	public function getTitle($file = null) {
		if (!$this->hasValidData($file)) return '';
		$title = ($entry = $this->ifd0->getEntry(PelTag::IMAGE_DESCRIPTION)) ? $entry->getValue() : '';
		$title = ($title === '' && $entry = $this->ifd0->getEntry(PelTag::XP_TITLE)) ? utf8_encode($entry->getValue()) : $title;
		return $title;
	}

	public function getDescription($file = null) {
		return ($this->hasValidData($file) && $entry = $this->ifd0->getEntry(PelTag::IMAGE_DESCRIPTION)) ? $entry->getValue() : '';
	}

	public function getArtist($file = null) {
		return ($this->hasValidData($file) && $entry = $this->ifd0->getEntry(PelTag::ARTIST)) ? $entry->getValue() : '';
	}

	public function getAuthor($file = null) {
		if (!$this->hasValidData($file)) return '';
		$author = $this->getArtist($file);
		return ($author === '' && $entry = $this->ifd0->getEntry(PelTag::XP_AUTHOR)) ? utf8_encode($entry->getValue()) : $author;
	}

	public function getSubject($file = null) {
		return ($this->hasValidData($file) && $entry = $this->ifd0->getEntry(PelTag::XP_SUBJECT)) ? $entry->getValue() : '';
	}

	public function getValues($file = null) {
		if (!$this->hasValidData($file)) return array();
		$tags = array('APERTURE_VALUE' => PelTag::APERTURE_VALUE, 'ARTIST' => PelTag::ARTIST, 'BATTERY_LEVEL' => PelTag::BATTERY_LEVEL, 'BITS_PER_SAMPLE' => PelTag::BITS_PER_SAMPLE, 'BRIGHTNESS_VALUE' => PelTag::BRIGHTNESS_VALUE, 'CFA_PATTERN' => PelTag::CFA_PATTERN, 'CFA_REPEAT_PATTERN_DIM' => PelTag::CFA_REPEAT_PATTERN_DIM, 'COLOR_SPACE' => PelTag::COLOR_SPACE, 'COMPONENTS_CONFIGURATION' => PelTag::COMPONENTS_CONFIGURATION, 'COMPRESSED_BITS_PER_PIXEL' => PelTag::COMPRESSED_BITS_PER_PIXEL, 'COMPRESSION' => PelTag::COMPRESSION, 'CONTRAST' => PelTag::CONTRAST, 'COPYRIGHT' => PelTag::COPYRIGHT, 'CUSTOM_RENDERED' => PelTag::CUSTOM_RENDERED, 'DATE_TIME' => PelTag::DATE_TIME, 'DATE_TIME_DIGITIZED' => PelTag::DATE_TIME_DIGITIZED, 'DATE_TIME_ORIGINAL' => PelTag::DATE_TIME_ORIGINAL, 'DEVICE_SETTING_DESCRIPTION' => PelTag::DEVICE_SETTING_DESCRIPTION, 'DIGITAL_ZOOM_RATIO' => PelTag::DIGITAL_ZOOM_RATIO, 'DOCUMENT_NAME' => PelTag::DOCUMENT_NAME, 'EXIF_IFD_POINTER' => PelTag::EXIF_IFD_POINTER, 'EXIF_VERSION' => PelTag::EXIF_VERSION, 'EXPOSURE_BIAS_VALUE' => PelTag::EXPOSURE_BIAS_VALUE, 'EXPOSURE_INDEX' => PelTag::EXPOSURE_INDEX, 'EXPOSURE_MODE' => PelTag::EXPOSURE_MODE, 'EXPOSURE_PROGRAM' => PelTag::EXPOSURE_PROGRAM, 'EXPOSURE_TIME' => PelTag::EXPOSURE_TIME, 'FILE_SOURCE' => PelTag::FILE_SOURCE, 'FILL_ORDER' => PelTag::FILL_ORDER, 'FLASH' => PelTag::FLASH, 'FLASH_ENERGY' => PelTag::FLASH_ENERGY, 'FLASH_PIX_VERSION' => PelTag::FLASH_PIX_VERSION, 'FNUMBER' => PelTag::FNUMBER, 'FOCAL_LENGTH' => PelTag::FOCAL_LENGTH, 'FOCAL_LENGTH_IN_35MM_FILM' => PelTag::FOCAL_LENGTH_IN_35MM_FILM, 'FOCAL_PLANE_RESOLUTION_UNIT' => PelTag::FOCAL_PLANE_RESOLUTION_UNIT, 'FOCAL_PLANE_X_RESOLUTION' => PelTag::FOCAL_PLANE_X_RESOLUTION, 'FOCAL_PLANE_Y_RESOLUTION' => PelTag::FOCAL_PLANE_Y_RESOLUTION, 'GAIN_CONTROL' => PelTag::GAIN_CONTROL, 'GAMMA' => PelTag::GAMMA, 'GPS_ALTITUDE' => PelTag::GPS_ALTITUDE, 'GPS_ALTITUDE_REF' => PelTag::GPS_ALTITUDE_REF, 'GPS_AREA_INFORMATION' => PelTag::GPS_AREA_INFORMATION, 'GPS_DATE_STAMP' => PelTag::GPS_DATE_STAMP, 'GPS_DEST_BEARING' => PelTag::GPS_DEST_BEARING, 'GPS_DEST_BEARING_REF' => PelTag::GPS_DEST_BEARING_REF, 'GPS_DEST_DISTANCE' => PelTag::GPS_DEST_DISTANCE, 'GPS_DEST_DISTANCE_REF' => PelTag::GPS_DEST_DISTANCE_REF, 'GPS_DEST_LATITUDE' => PelTag::GPS_DEST_LATITUDE, 'GPS_DEST_LATITUDE_REF' => PelTag::GPS_DEST_LATITUDE_REF, 'GPS_DEST_LONGITUDE' => PelTag::GPS_DEST_LONGITUDE, 'GPS_DEST_LONGITUDE_REF' => PelTag::GPS_DEST_LONGITUDE_REF, 'GPS_DIFFERENTIAL' => PelTag::GPS_DIFFERENTIAL, 'GPS_DOP' => PelTag::GPS_DOP, 'GPS_IMG_DIRECTION' => PelTag::GPS_IMG_DIRECTION, 'GPS_IMG_DIRECTION_REF' => PelTag::GPS_IMG_DIRECTION_REF, 'GPS_INFO_IFD_POINTER' => PelTag::GPS_INFO_IFD_POINTER, 'GPS_LATITUDE' => PelTag::GPS_LATITUDE, 'GPS_LATITUDE_REF' => PelTag::GPS_LATITUDE_REF, 'GPS_LONGITUDE' => PelTag::GPS_LONGITUDE, 'GPS_LONGITUDE_REF' => PelTag::GPS_LONGITUDE_REF, 'GPS_MAP_DATUM' => PelTag::GPS_MAP_DATUM, 'GPS_MEASURE_MODE' => PelTag::GPS_MEASURE_MODE, 'GPS_PROCESSING_METHOD' => PelTag::GPS_PROCESSING_METHOD, 'GPS_SATELLITES' => PelTag::GPS_SATELLITES, 'GPS_SPEED' => PelTag::GPS_SPEED, 'GPS_SPEED_REF' => PelTag::GPS_SPEED_REF, 'GPS_STATUS' => PelTag::GPS_STATUS, 'GPS_TIME_STAMP' => PelTag::GPS_TIME_STAMP, 'GPS_TRACK' => PelTag::GPS_TRACK, 'GPS_TRACK_REF' => PelTag::GPS_TRACK_REF, 'GPS_VERSION_ID' => PelTag::GPS_VERSION_ID, 'IMAGE_DESCRIPTION' => PelTag::IMAGE_DESCRIPTION, 'IMAGE_LENGTH' => PelTag::IMAGE_LENGTH, 'IMAGE_UNIQUE_ID' => PelTag::IMAGE_UNIQUE_ID, 'IMAGE_WIDTH' => PelTag::IMAGE_WIDTH, 'INTEROPERABILITY_IFD_POINTER' => PelTag::INTEROPERABILITY_IFD_POINTER, 'INTEROPERABILITY_INDEX' => PelTag::INTEROPERABILITY_INDEX, 'INTEROPERABILITY_VERSION' => PelTag::INTEROPERABILITY_VERSION, 'INTER_COLOR_PROFILE' => PelTag::INTER_COLOR_PROFILE, 'IPTC_NAA' => PelTag::IPTC_NAA, 'ISO_SPEED_RATINGS' => PelTag::ISO_SPEED_RATINGS, 'JPEG_INTERCHANGE_FORMAT' => PelTag::JPEG_INTERCHANGE_FORMAT, 'JPEG_INTERCHANGE_FORMAT_LENGTH' => PelTag::JPEG_INTERCHANGE_FORMAT_LENGTH, 'JPEG_PROC' => PelTag::JPEG_PROC, 'LIGHT_SOURCE' => PelTag::LIGHT_SOURCE, 'MAKE' => PelTag::MAKE, 'MAKER_NOTE' => PelTag::MAKER_NOTE, 'MAX_APERTURE_VALUE' => PelTag::MAX_APERTURE_VALUE, 'METERING_MODE' => PelTag::METERING_MODE, 'MODEL' => PelTag::MODEL, 'OECF' => PelTag::OECF, 'ORIENTATION' => PelTag::ORIENTATION, 'PHOTOMETRIC_INTERPRETATION' => PelTag::PHOTOMETRIC_INTERPRETATION, 'PIXEL_X_DIMENSION' => PelTag::PIXEL_X_DIMENSION, 'PIXEL_Y_DIMENSION' => PelTag::PIXEL_Y_DIMENSION, 'PLANAR_CONFIGURATION' => PelTag::PLANAR_CONFIGURATION, 'PRIMARY_CHROMATICITIES' => PelTag::PRIMARY_CHROMATICITIES, 'PRINT_IM' => PelTag::PRINT_IM, 'REFERENCE_BLACK_WHITE' => PelTag::REFERENCE_BLACK_WHITE, 'RELATED_IMAGE_FILE_FORMAT' => PelTag::RELATED_IMAGE_FILE_FORMAT, 'RELATED_IMAGE_LENGTH' => PelTag::RELATED_IMAGE_LENGTH, 'RELATED_IMAGE_WIDTH' => PelTag::RELATED_IMAGE_WIDTH, 'RELATED_SOUND_FILE' => PelTag::RELATED_SOUND_FILE, 'RESOLUTION_UNIT' => PelTag::RESOLUTION_UNIT, 'ROWS_PER_STRIP' => PelTag::ROWS_PER_STRIP, 'SAMPLES_PER_PIXEL' => PelTag::SAMPLES_PER_PIXEL, 'SATURATION' => PelTag::SATURATION, 'SCENE_CAPTURE_TYPE' => PelTag::SCENE_CAPTURE_TYPE, 'SCENE_TYPE' => PelTag::SCENE_TYPE, 'SENSING_METHOD' => PelTag::SENSING_METHOD, 'SHARPNESS' => PelTag::SHARPNESS, 'SHUTTER_SPEED_VALUE' => PelTag::SHUTTER_SPEED_VALUE, 'SOFTWARE' => PelTag::SOFTWARE, 'SPATIAL_FREQUENCY_RESPONSE' => PelTag::SPATIAL_FREQUENCY_RESPONSE, 'SPECTRAL_SENSITIVITY' => PelTag::SPECTRAL_SENSITIVITY, 'STRIP_BYTE_COUNTS' => PelTag::STRIP_BYTE_COUNTS, 'STRIP_OFFSETS' => PelTag::STRIP_OFFSETS, 'SUBJECT_AREA' => PelTag::SUBJECT_AREA, 'SUBJECT_DISTANCE' => PelTag::SUBJECT_DISTANCE, 'SUBJECT_DISTANCE_RANGE' => PelTag::SUBJECT_DISTANCE_RANGE, 'SUBJECT_LOCATION' => PelTag::SUBJECT_LOCATION, 'SUB_SEC_TIME' => PelTag::SUB_SEC_TIME, 'SUB_SEC_TIME_DIGITIZED' => PelTag::SUB_SEC_TIME_DIGITIZED, 'SUB_SEC_TIME_ORIGINAL' => PelTag::SUB_SEC_TIME_ORIGINAL, 'TRANSFER_FUNCTION' => PelTag::TRANSFER_FUNCTION, 'TRANSFER_RANGE' => PelTag::TRANSFER_RANGE, 'USER_COMMENT' => PelTag::USER_COMMENT, 'WHITE_BALANCE' => PelTag::WHITE_BALANCE, 'WHITE_POINT' => PelTag::WHITE_POINT, 'XP_AUTHOR' => PelTag::XP_AUTHOR, 'XP_COMMENT' => PelTag::XP_COMMENT, 'XP_KEYWORDS' => PelTag::XP_KEYWORDS, 'XP_SUBJECT' => PelTag::XP_SUBJECT, 'XP_TITLE' => PelTag::XP_TITLE, 'X_RESOLUTION' => PelTag::X_RESOLUTION, 'YCBCR_COEFFICIENTS' => PelTag::YCBCR_COEFFICIENTS, 'YCBCR_POSITIONING' => PelTag::YCBCR_POSITIONING, 'YCBCR_SUB_SAMPLING' => PelTag::YCBCR_SUB_SAMPLING, 'Y_RESOLUTION' => PelTag::Y_RESOLUTION);
		$result = array();
		foreach($tags as $name => $tag) {
			if ($entry = $this->ifd0->getEntry($tag)) {
				$result[$name] = $entry->getValue();
			}
		}
		return $result;
	}

	/**
	 * @param null $file
	 * @return string
	 */
	public function getComments($file = null) {
		if ($this->hasValidData($file)) {
			$entry = $this->ifd0->getEntry(PelTag::XP_COMMENT);
			if (!$entry) {
				$entry = $this->ifd0->getEntry(PelTag::USER_COMMENT);
			}
			return $entry ? utf8_encode($entry->getValue()) : '';
		}
		return '';
	}

}