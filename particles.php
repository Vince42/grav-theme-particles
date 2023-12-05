<?php
namespace Grav\Theme;

use Grav\Common\Grav;
use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;

class Particles extends Quark
{
    public static function getSubscribedEvents() {
        return [
            'onTwigLoader' => ['onTwigLoader', 10],
            'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
        ];
    }

    public function onTwigLoader() {
        $this->parentHandler('onTwigLoader');

        // add quark theme as namespace to twig
        $parent_path = Grav::instance()['locator']->findResource('themes://quark');
        $this->grav['twig']->addPath($parent_path . DIRECTORY_SEPARATOR . 'templates', 'quark');
        $this->grav['twig']->addPath($parent_path . DIRECTORY_SEPARATOR . 'images', 'images'); // special for Quark's nonsense
    }

    private function parentHandler($event) {
        if(method_exists(parent::class, 'getSubscribedEvents')) {
            $parent_subscribed_events = parent::getSubscribedEvents();

            if(array_key_exists($event, $parent_subscribed_events)) {
                $parent_event_handler = array_shift($parent_subscribed_events[$event]);
                call_user_func([parent::class, $parent_event_handler]);
            }
        }
    }

    // sourced from https://discourse.getgrav.org/t/customize-override-admin-theme/6371/9
    /**
     * Register templates and page
     *
     * @param RocketTheme\Toolbox\Event\Event $event Event handler
     *
     * @return array
     */
    public function onAdminTwigTemplatePaths($event)
    {
        $event['paths'] = array_merge(
            $event['paths'],
            [__DIR__ . '/admin/themes/grav/templates']
        );
        return $event;
    }

}
