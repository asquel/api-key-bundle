<?php
namespace AsQuel\ApiKeyBundle\Exception;

/**
 * Class ApiKeyException
 *
 * @package   AsQuel\ApiKeyBundle\Exception

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class ApiKeyException extends \Exception
{
    /**
     * @return string
     */
    public static function formatMessage()
    {
        return sprintf('ApiKey error');
    }
}