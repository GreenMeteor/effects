<?php

namespace gm\humhub\modules\effects;

use humhub\widgets\LayoutAddons;

return [
    'id' => 'effects',
    'class' => Module::class,
    'namespace' => 'gm\humhub\modules\effects',
    'events' => [
        ['class' => LayoutAddons::class, 'event' => LayoutAddons::EVENT_INIT, 'callback' => [Events::class, 'onLayoutAddonsInit']],
    ]
];