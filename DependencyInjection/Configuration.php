<?php

namespace TakeOffset\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('takeoffset_api');

        $rootNode
          ->children()
            ->scalarNode('key')->isRequired()->cannotBeEmpty()->end()
          //end rootnode children
          ->end();

        //let use the api defaults
        $this->addServicesSection($rootNode);

        return $treeBuilder;
    }
}
