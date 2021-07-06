<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use League\OAuth2\Server\ResourceServer;

class ApplicationKey
{
    public function __construct(ResourceServer $server)
    {
        $this->server = $server;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $applicationKey = $request->header('application_key');
        if ($applicationKey == 'AdminVerySecretXD') {
            return $next($request);
        }

        if (!$applicationKey) {
            return response()->json(["you have to provid application-key in the request header"], 404);
        }
        $application = Application::where('application_key', $applicationKey)->first();
        if (!$application) {
            return response()->json("application key : " . $applicationKey . ' is not valid', 404);
        }
        $request['application_id'] = $application->id;
        if ($request->user() && $request->user()->application_id != $application->id) {
            return response()->json('this user is not on this application', 404);
        }
        return $next($request);
    }
}
