<?php
if (! function_exists('get_asset')) {
    /**
     * Generate an asset path for the application with the current enviroment
     *
     * @param  string  $path
     * @return string
     *
     */
    function get_asset($path)
    {
        if (env('APP_ENV') === 'production') {
            return secure_asset($path);
        }

        if (env('APP_ENV') === 'dev') {
            return asset($path);
        }
    }
}