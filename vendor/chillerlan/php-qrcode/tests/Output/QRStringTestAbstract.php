<?php
/**
 * Class QRStringTestAbstract
 *
 * @created      24.12.2017
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeTest\Output;

use chillerlan\QRCode\Output\QRString;

/**
 * Tests the QRString output module
 */
abstract class QRStringTestAbstract extends QROutputTestAbstract{

	protected string $FQN  = QRString::class;

}
