<?php
namespace AsQuel\ApiKeyBundle\Tests\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use AsQuel\ApiKeyBundle\Security\Authenticator;

/**
 * Class AuthenticatorTest
 *
 * @package   AsQuel\ApiKeyBundle\Tests\Security

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class AuthenticatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @type Authenticator
     */
    private static $authenticator;

    public function testImplementInterface() {
        $authenticator = new Authenticator(new RequestMatcher());

        $this->assertInstanceOf('AsQuel\ApiKeyBundle\Security\AuthenticatorInterface', $authenticator);

        self::$authenticator = $authenticator;
    }

    public static function getRequestUriProvider() {
        return array(
            array('/api/hotels/', true),
            array('api/hotels', false),
            array('/test', true),
            array('/testXXX', true),
            array('/test/test2', true)
        );
    }

    /**
     * @depends testImplementInterface
     * @dataProvider getRequestUriProvider
     */
    public function testIsRequestWhiteListed($uri, $result) {

        self::$authenticator->setConfig(
            array(
                'urls_whitelist' => array(
                    array(
                        'path' => '^/api/hotels/'
                    ),
                    array(
                        'path' => '/test*'
                    )
                )
            )
        );
        $request = new Request();
        $request->server->set('REQUEST_URI', $uri);

        $this->assertEquals(self::$authenticator->isRequestUrlWhiteListed($request), $result);
    }


    public function testIsRequestWhiteListedArrayEmpty() {
        $authenticator = new Authenticator(new RequestMatcher());
        $authenticator->setConfig(
            array(
                'urls_whitelist' => array(
                )
            )
        );
        $request = new Request();
        $request->server->set('REQUEST_URI', '/api');

        $this->assertFalse($authenticator->isRequestUrlWhiteListed($request));
    }

    /**
     * @depends testImplementInterface
     */
    public function testGetApiKeyWithHeader() {
        self::$authenticator->setConfig(
            array(
                'is_header' => true,
                'parameter_name' => 'X-API-KEY'
            )
        );
        $request = new Request();
        $request->headers->add(array('X-API-KEY' => 'test123'));
        $this->assertEquals(self::$authenticator->getApiKey($request), 'test123');
    }

    /**
     * @depends testImplementInterface
     */
    public function testGetApiKeyWithHeaderNull() {
        self::$authenticator->setConfig(
            array(
                'is_header' => true,
                'parameter_name' => 'X-API_HEADER_WRONG'
            )
        );
        $request = new Request();
        $request->headers->add(array('X-API-KEY' => 'test123'));
        $this->assertNull(self::$authenticator->getApiKey($request));
    }

}