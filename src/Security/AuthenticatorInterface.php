<?php
namespace AsQuel\ApiKeyBundle\Security;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Interface AuthenticatorInterface
 *
 * @package AsQuel\ApiKeyBundle\Security
 */
interface AuthenticatorInterface
{

    public function setConfig($config);


    public function onKernelRequest(GetResponseEvent $event);
}