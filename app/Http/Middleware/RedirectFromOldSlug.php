<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class RedirectFromOldSlug
{
    public function handle(Request $request, Closure $next)
    {
        $url = parse_url($request->url());
        $url_tail = array_key_exists('path', $url) ? $url['path'] : '';
        $redirect = Redirect::query()
            ->where('old_slug', $url_tail)
            ->orderByRaw('created_at DESC, id DESC')
            ->first();
        $new_slug = null;

        while ($redirect !== null) {
            $url_tail = $redirect->new_slug;
            $new_slug = $redirect;
            $redirect = Redirect::query()
                ->where('old_slug', $url_tail)
                ->where('created_at', '>', $redirect->created_at)
                ->orderByRaw('created_at DESC, id DESC')
                ->first();
        }
        if ($new_slug !== null)
            return redirect($url_tail);

        return $next($request);
    }
}
