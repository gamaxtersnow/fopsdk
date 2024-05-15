<?php

namespace fop\Think;

use fop\App;
use think\Service;

class FopService extends Service
{
    public function register()
    {
        $config = config('fop');
        if(empty($config)) {
            $config = require __DIR__.'/config.php';
        }
        $this->app->bind('fop',new App($config));
    }

    public function boot()
    {
        // 服务启动
    }

}



