<?php
/**
 * Tests the main CORs system.
 *
 * Part of the Bairwell\MiddlewareCors package.
 *
 * (c) Richard Bairwell <richard@bairwell.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types = 1);

namespace GlassLab;

use Trurl\GlassLab\Exceptions\BadOrigin;

new BadOrigin();

class MiddlewareCorsTest extends \PHPUnit_Framework_TestCase
{
    public function testLogger() {
        $this->assertEquals("A","A");
    }
}//end class
