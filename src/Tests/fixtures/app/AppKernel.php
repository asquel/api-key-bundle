<?php


class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new AsQuel\ApiKeyBundle\AsQuelApiKeyBundle(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return __DIR__.'/../../../_build/cache';
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return __DIR__.'/../../../_build/logs';
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerBaseClass()
    {
        return '\PSS\SymfonyMockerContainer\DependencyInjection\MockerContainer';
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareContainer(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        parent::prepareContainer($container);
    }

}