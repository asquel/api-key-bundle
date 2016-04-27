<?php
/**
 * hestia
 *
 * Copyright (c) 2012-2013, Trivago GmbH
 * All rights reserved.
 *
 * @since     02.11.15

 * @author    Roman Lasinski <roman.lasinski@trivago.com>
 *
 */
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