<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;

class Modules extends Quark
{
    public static function getSubscribedEvents() {
        return [
            'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
        ];
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
