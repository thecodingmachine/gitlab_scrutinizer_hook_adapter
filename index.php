<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

$app = new \Slim\Slim();
$app->post('/hook/:name', function ($name) use ($app) {
    $body = json_decode($app->request->getBody(), true);

    if (isset($body["object_kind"]) && $body["object_kind"] == "merge_request") {
        error_log("Merge requests not supported yet");
        return;
    }

    $before = $body['before'];
    $after = $body['after'];
    $ref = $body['ref'];

    $scrutinizerHookMessage = [
        "head" => [ "sha" => $after ],
        "base" => [ "sha" => $before ],
        "ref" => $ref,
    ];

    $client = new GuzzleHttp\Client(['base_url' => 'https://scrutinizer-ci.com']);

    $client->post('/api/repositories/gp/'.$name.'/callbacks/post-receive?access_token='.SCRUTINIZER_API_TOKEN, [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode($scrutinizerHookMessage)
    ]);

});
$app->run();
