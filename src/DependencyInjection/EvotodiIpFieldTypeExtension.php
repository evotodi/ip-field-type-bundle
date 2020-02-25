<?php

namespace Evotodi\IpFieldTypeBundle\DependencyInjection;

use Exception;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class EvotodiIpFieldTypeExtension extends Extension
{
	/**
	 * {@inheritDoc}
	 * @throws Exception
	 */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $twigFormResources = $container->hasParameter('twig.form.resources')
            ? $container->getParameter('twig.form.resources')
            : array();

        $container->setParameter(
            'twig.form.resources',
            array_merge($twigFormResources, array('EvotodiIpFieldTypeBundle:Form:ipfield_widget.html.twig'))
        );

        $this->registerResources($container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

     /**
     * Registers the form resources for the Twig templating engines.
     *
     * @param ContainerBuilder $container The container.
     */
    protected function registerResources(ContainerBuilder $container)
    {
        $twigFormResources = $container->hasParameter('twig.form.resources')
            ? $container->getParameter('twig.form.resources')
            : array();

        $container->setParameter(
            'twig.form.resources',
            array_merge($twigFormResources, array('EvotodiIpFieldTypeBundle:Form:ipfield_widget.html.twig'))
        );

    }
}
