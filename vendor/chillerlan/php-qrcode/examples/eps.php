<?php
/**
 * @created      10.05.2022
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2022 Smiley
 * @license      MIT
 */

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QROutputInterface;

require_once __DIR__.'/../vendor/autoload.php';

$options = new QROptions([
	'version'      => 7,
	'outputType'   => QROutputInterface::EPS,
	'eccLevel'     => EccLevel::L,
	'scale'        => 5,
	'addQuietzone' => true,
#	'cachefile'    => __DIR__.'/test.eps', // save to file
	'moduleValues' => [
		// finder
		QRMatrix::M_FINDER | QRMatrix::IS_DARK     => 0xA71111, // dark (true)
		QRMatrix::M_FINDER                         => 0xFFBFBF, // light (false)
		QRMatrix::M_FINDER_DOT | QRMatrix::IS_DARK => 0xA71111, // finder dot, dark (true)
		// alignment
		QRMatrix::M_ALIGNMENT | QRMatrix::IS_DARK  => 0xA70364,
		QRMatrix::M_ALIGNMENT                      => 0xFFC9C9,
		// timing
		QRMatrix::M_TIMING | QRMatrix::IS_DARK     => 0x98005D,
		QRMatrix::M_TIMING                         => 0xFFB8E9,
		// format
		QRMatrix::M_FORMAT | QRMatrix::IS_DARK     => 0x003804,
		QRMatrix::M_FORMAT                         => 0x00FB12,
		// version
		QRMatrix::M_VERSION | QRMatrix::IS_DARK    => 0x650098,
		QRMatrix::M_VERSION                        => 0xE0B8FF,
		// data
		QRMatrix::M_DATA | QRMatrix::IS_DARK       => 0x4A6000,
		QRMatrix::M_DATA                           => 0xECF9BE,
		// darkmodule
		QRMatrix::M_DARKMODULE | QRMatrix::IS_DARK => 0x080063,
		// separator
		QRMatrix::M_SEPARATOR                      => 0xAFBFBF,
		// quietzone
		QRMatrix::M_QUIETZONE                      => 0xDDDDDD,
	],
]);


if(php_sapi_name() !== 'cli'){
	// if viewed in the browser, we should push it as file download as EPS isn't usually supported
	header('Content-type: application/postscript');
	header('Content-Disposition: filename="qrcode.eps"');
}

echo (new QRCode($options))->render('https://www.youtube.com/watch?v=dQw4w9WgXcQ');

exit;



