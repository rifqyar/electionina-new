if (!function_exists('isActive')) {
    function isActive($routeName)
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}