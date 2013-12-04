<?php

namespace Vx\IpFieldTypeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class VxIpFieldTypeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $templatingEngines = $container->getParameter('templating.engines');

        if (in_array('twig', $templatingEngines)) {
            $twigFormResources = $container->hasParameter('twig.form.resources')
                ? $container->getParameter('twig.form.resources')
                : array();

            $container->setParameter(
                'twig.form.resources',
                array_merge($twigFormResources, array('VxIpFieldTypeBundle:Form:ipfield_widget.html.twig'))
            );
        }
        $this->registerResources($container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

     /**
     * Registers the form resources for the PHP & Twig templating engines.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container.
     */
    protected function registerResources(ContainerBuilder $container)
    {
        $templatingEngines = $container->getParameter('templating.engines');

        // TODO: Php template
        // if (in_array('php', $templatingEngines)) {
        //     $phpFormResources = $container->hasParameter('templating.helper.form.resources')
        //         ? $container->getParameter('templating.helper.form.resources')
        //         : array();

        //     $container->setParameter(
        //         'templating.helper.form.resources',
        //         array_merge($phpFormResources, array('VxIpFieldTypeBundle:Form'))
        //     );
        // }

        if (in_array('twig', $templatingEngines)) {
            $twigFormResources = $container->hasParameter('twig.form.resources')
                ? $container->getParameter('twig.form.resources')
                : array();

            $container->setParameter(
                'twig.form.resources',
                array_merge($twigFormResources, array('VxIpFieldTypeBundle:Form:ipfield_widget.html.twig'))
            );
        }
    }
}
