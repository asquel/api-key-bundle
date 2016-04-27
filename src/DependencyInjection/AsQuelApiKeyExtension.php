<?php

namespace AsQuel\ApiKeyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


/**
 * Class AsQuelApiKeyExtension
 *
 * @package   AsQuel\ApiKeyBundle\DependencyInjection

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class AsQuelApiKeyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $authenticatorService = $container->getDefinition($config[ 'authenticator_service' ]);
        $authenticatorService->addMethodCall('setConfig', array($config));
    }
}