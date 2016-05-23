<?php

namespace Netgen\Bundle\EzSocialConnectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteaccessAwareConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files.
 */
class Configuration extends SiteaccessAwareConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('netgen_social_connect');

        $rootNode
            ->children()
                ->arrayNode('resource_owners')
                    ->useAttributeAsKey('resource_owner_name')
                        ->normalizeKeys(false)
                        ->prototype('array')
                            ->children()
                                ->scalarNode('useConfigResolver')->end()
                            ->end()
                        ->end()
                ->end()
            ->end()
        ;

        $systemNode = $this->generateScopeBaseNode($rootNode);
        $systemNode
            ->scalarNode('user_content_type_identifier')
                ->defaultValue('user')
            ->end()
            ->scalarNode('merge_accounts')
                ->defaultValue(false)
            ->end()

            ->arrayNode('field_identifiers')
                ->children()
                    ->scalarNode('first_name')->end()
                    ->scalarNode('last_name')->end()
                    ->scalarNode('profile_image')->end()
                ->end()
            ->end()
            ->arrayNode('oauth_user_group')
                ->children()
                    ->scalarNode('facebook')->end()
                    ->scalarNode('google')->end()
                    ->scalarNode('linkedin')->end()
                    ->scalarNode('twitter')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
