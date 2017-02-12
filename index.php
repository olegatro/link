<?php

$routes = [
    'about'                              => 'https://phalconphp.com/en/about',
    'blog'                               => 'https://blog.phalconphp.com',
    'compose'                            => 'https://phalcon-compose.readme.io',
    'docs'                               => 'https://docs.phalconphp.com',
    'donate'                             => 'https://patreon.com/phalcon',
    'download'                           => 'https://phalconphp.com/en/download',
    'download/linux'                     => 'https://packagecloud.io/phalcon/stable',
    'download/windows/latest/x86-70'     => 'https://my.pcloud.com/publink/show?code=XZXsYlZ42Oy3R3pmehiNhieUe0yluyOeNey',
    'download/windows/latest/x86-70-nts' => 'https://my.pcloud.com/publink/show?code=XZKWYlZaMowNH6UL87hcRCvEtNOWzKS7h6y',
    'download/windows/latest/x86-56'     => 'https://my.pcloud.com/publink/show?code=XZVsYlZcxOdwPA2MI7XkhPee3vOCbFkLKDX',
    'download/windows/latest/x86-56-nts' => 'https://my.pcloud.com/publink/show?code=XZHsYlZC61oJWjjrmQxTffxxitMmFn2NqvV',
    'download/windows/latest/x86-55'     => 'https://my.pcloud.com/publink/show?code=XZGsYlZjrQBkqBkHPJS5CmAGYsVxXT6fhOy',
    'download/windows/latest/x86-55-nts' => 'https://my.pcloud.com/publink/show?code=XZOsYlZ2PH8ksDI2j0L4XdwAcjJ6HqKerNy',
    'download/windows/latest/x64-70'     => 'https://my.pcloud.com/publink/show?code=XZjsYlZHSwYSOe8A0X2QmdUUXSaUYHFnHH7',
    'download/windows/latest/x64-70-nts' => 'https://my.pcloud.com/publink/show?code=XZbsYlZpc7qnvVgdNH853J7I1kMDSaRN5Uk',
    'download/windows/latest/x64-56'     => 'https://my.pcloud.com/publink/show?code=XZnsYlZhoJabkGmVc8EPiz8CYkV4HfoWDpX',
    'download/windows/latest/x64-56-nts' => 'https://my.pcloud.com/publink/show?code=XZDsYlZemhOBtrlY50cw7fcdW5hayCl7Owy',
    'download/windows/latest/x64-55'     => 'https://my.pcloud.com/publink/show?code=XZYDYlZ5Q50SUlOEezGkBObgsLnVm6kg9sV',
    'download/windows/latest/x64-55-nts' => 'https://my.pcloud.com/publink/show?code=XZQDYlZtBbbYstYpahQP3528hx0A8YFHpSy',
    'facebook'                           => 'https://www.facebook.com/Phalcon-Framework-134230726685897/',
    'fb'                                 => 'https://www.facebook.com/Phalcon-Framework-134230726685897/',
    'forum'                              => 'https://forum.phalconphp.com',
    'fund'                               => 'https://patreon.com/phalcon',
    'funding'                            => 'https://patreon.com/phalcon',
    'g+'                                 => 'https://plus.google.com/u/0/b/102376109340560896457/+PhalconPHP',
    'gab'                                => 'https://gab.ai/phalcon',
    'github'                             => 'https://github.com/phalcon/cphalcon',
    'github-docs'                        => 'https://github.com/phalcon/docs',
    'resources'                          => 'http://phalconist.com',
    'slack'                              => 'https://phalconchats.slack.com/messages/general/',
    'store'                              => 'https://teespring.com/phalcon',
    'support_us'                         => 'https://patreon.com/phalcon',
    't'                                  => 'https://twitter.com/phalconphp',
    'team'                               => 'https://phalconphp.com/en/team',
    'team/andres'                        => 'https://github.com/andresgutierrez',
    'team/eduar'                         => 'https://github.com/carvajaldiazeduar',
    'team/nikolay'                       => 'https://github.com/xboston',
    'team/nikos'                         => 'https://github.com/niden',
    'team/serghei'                       => 'https://github.com/sergeyklay',
    'twitter'                            => 'https://twitter.com/phalconphp',
    'default'                            => 'https://phalconphp.com',
];

$app = new \Phalcon\Mvc\Micro();

$getBase      = function () use ($app, $routes) {
    $output   = <<<EOF
<!DOCTYPE html>
<html lang="en">
<title>Phalcon Link</title>
<head>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Stub</th>
                    <th>URL</th>
                </tr>
                </thead>
                <tbody>
                    %s
                </tbody>
            </thead>
            </table>
        </div>
    </div>
</body>
</html>
EOF;
    $template = '<tr><td><a href="https://phalcon.link/%s">%s</a></td><td><a href="%s">%s</a></td></tr>' . PHP_EOL;
    $links    = sprintf(
        $template,
        'www',
        'Website',
        $routes['default'],
        $routes['default']
    );
    ksort($routes);
    foreach ($routes as $key => $url) {
        if ('default' !== $key) {
            $links .= sprintf($template, $key, $key, $url, $url);
        }
    }

    $output = sprintf($output, $links);
    $app->response->setContent($output);

    return $app->response->send();
};
$getRedirect  = function ($url, $platform, $category, $version) use ($app, $routes) {
    $url = strtolower($url);
    switch ($url) {
        case 'download':
            switch ($platform) {
                case 'linux':
                    $url = 'download/linux';
                    break;
                case 'windows':
                    $url = sprintf(
                        'download/%s/%s/%s',
                        $platform,
                        $category,
                        $version
                    );
                    break;
            }
            break;
        case 'team':
            $url = sprintf('team/%s', $platform);
            break;
    }

    if (true === array_key_exists($url, $routes)) {
        $redirect = $routes[$url];
    } else {
        $redirect = $routes['default'];
    }

    return $app->response->redirect($redirect, true);
};
$routeProcess = function ($url, $platform, $category, $version) use ($app, $routes, $getBase, $getRedirect) {
    if (true === empty($url)) {
        return $getBase();
    } else {
        return $getRedirect($url, $platform, $category, $version);
    }
};

$app->notFound(
    function () use ($app) {
        $app->response->setStatusCode(404, "Not Found");
        $app->response->sendHeaders();

        echo "This link does not exist";
    }
);
$app->get('/{url}', $routeProcess);
$app->get('/{url}/{platform}', $routeProcess);
$app->get('/{url}/{platform}/{category}', $routeProcess);
$app->get('/{url}/{platform}/{category}/{version}', $routeProcess);

$app->handle();
