<?php
namespace AsQuel\ApiKeyBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use AsQuel\ApiKeyBundle\Exception\ApiKeyException;

/**
 * Class Authenticator :
 *  This class is an event listener on each request. If you have configured the bundle it will check if
 * some designated header / query string are found in the Request
 *
 * @package   AsQuel\ApiKeyBundle\Security

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class Authenticator implements AuthenticatorInterface
{
    /**
     * @type array
     */
    private $config;

    /**
     * @type RequestMatcher
     */
    private $requestMatcher;

    /**
     * @param $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param RequestMatcher $requestMatcher
     */
    public function __construct(RequestMatcher $requestMatcher)
    {
        $this->requestMatcher = $requestMatcher;
    }

    /**
     * Event triggered on each request, throw an ApiKeyException if the key is not correct or not found.
     *
     * @param GetResponseEvent $event
     *
     * @throws ApiKeyException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // If using FOSRest with event listener on exception, need to check that
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            $dontCheckThisUrl = $this->isRequestUrlWhiteListed($request);

            // Current request url was in the whitelist => dont check
            if ($dontCheckThisUrl) {
                return;
            }

            $apiKey = $this->getApiKey($request);

            if ($apiKey !== $this->config[ 'api_key_value' ]) {
                throw new ApiKeyException(
                    ApiKeyException::formatMessage()
                );
            }
        }

    }

    /**
     * Check if the current request is in the whitelist.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function isRequestUrlWhiteListed(Request $request)
    {
        foreach ($this->config[ 'urls_whitelist' ] as $path) {
            $this->requestMatcher->matchPath($path[ 'path' ]);

            if ($this->requestMatcher->matches($request)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Request $request
     *
     * @return string $apiKey
     */
    public function getApiKey(Request $request)
    {
        if ($this->config[ 'is_header' ]) {
            $apiKey = $request->headers->get($this->config[ 'parameter_name' ]);
        } else {
            $apiKey = $request->get($this->config[ 'parameter_name' ]);
        }
        if (!$apiKey) {
            return null;
        }

        return $apiKey;
    }
}