<?php
/**
 * Class QRDataTest
 *
 * @created      08.08.2022
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2022 smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeTest\Data;

use chillerlan\QRCode\Common\BitBuffer;
use chillerlan\QRCode\Common\MaskPattern;
use chillerlan\QRCode\Data\QRData;
use chillerlan\QRCode\Output\QRGdImage;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class QRDataTest extends TestCase{

	/**
	 * tests setting the BitBuffer object directly
	 */
	public function testSetBitBuffer():void{
		$rawBytes = [
			67, 22, 135, 71, 71, 7, 51, 162, 242, 247, 119, 119, 114, 231, 150, 247,
			87, 71, 86, 38, 82, 230, 54, 246, 210, 247, 118, 23, 70, 54, 131, 247,
			99, 212, 68, 199, 167, 135, 39, 164, 100, 55, 148, 247, 50, 103, 67, 211,
			67, 55, 48, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236,
			17, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17, 236
		];

		$options     = new QROptions(['version' => 3]);
		$bitBuffer   = new BitBuffer($rawBytes);
		$QRData      = (new QRData($options))->setBitBuffer($bitBuffer);
		$maskPattern = MaskPattern::getBestPattern($QRData);
		$matrix      = $QRData->writeMatrix($maskPattern);

		$this::assertSame(3, $matrix->version()->getVersionNumber());

		// attempt to read
		$options->imageBase64                 = false;
		$options->readerUseImagickIfAvailable = false;

		$output       = new QRGdImage($options, $matrix);
		$decodeResult = (new QRCode($options))->readFromBlob($output->dump());

		$this::assertSame($decodeResult->data, 'https://www.youtube.com/watch?v=DLzxrzFCyOs&t=43s');

		QRMatrixTest::debugMatrix($matrix);
	}

}
