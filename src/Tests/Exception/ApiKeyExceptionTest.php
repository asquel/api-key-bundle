<?php
namespace AsQuel\ApiKeyBundle\Tests\Exception;

use AsQuel\ApiKeyBundle\Exception\ApiKeyException;

/**
 * Class ApiKeyExceptionTest
 *
 * @package   AsQuel\ApiKeyBundle\Tests\Exception

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class ApiKeyExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatMessage()
    {
        $this->assertEquals(
            'ApiKey error',
            ApiKeyException::formatMessage()
        );
    }
}