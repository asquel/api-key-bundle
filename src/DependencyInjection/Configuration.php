<?php

namespace AsQuel\ApiKeyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class Configuration : add the tree configuration for config files
 *
 * @package   AsQuel\ApiKeyBundle\DependencyInjection

 * @author    Axel Barbier <axel.barbier@gmail.com>
 *
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('trivago_api_key');
        $rootNode
            ->children()
                ->booleanNode('is_header')->defaultTrue()->end()
                ->scalarNode('parameter_name')->defaultValue('X-API-KEY')->end()
                ->scalarNode('api_key_value')->isRequired()->end()
                ->scalarNode('authenticator_service')->defaultValue('asquel.api_key_bundle.authenticator')->end()
            ->end();
        $this->addUrlsSection($rootNode);
        return $treeBuilder;
    }

    /**
     * urls_whitelist is a list of "path" we don't check
     * @param ArrayNodeDefinition $rootNode
     */
    private function addUrlsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('urls_whitelist')
                    ->cannotBeOverwritten()
                    ->prototype('array')
                         ->children()
                            ->scalarNode('path')->defaultNull()->info('URL path info')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}