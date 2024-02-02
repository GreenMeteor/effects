<?php

namespace gm\humhub\modules\effects;

use humhub\components\Module as BaseModule;

/**
 * Snowfall module for HumHub.
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'gm\humhub\modules\effects\controllers';

}