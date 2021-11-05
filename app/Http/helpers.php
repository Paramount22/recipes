<?php

function body_class()
{
    $body_classes = [];

    if ( $route_name = Route::currentRouteName() ) {
        $body_classes = explode('.', $route_name);
    }

    $class = "";

    foreach ( Request::segments() as $segment )
    {
        if ( is_numeric( $segment ) || empty( $segment ) )
            continue;

        $class .= ! empty( $class ) ? "-" . $segment : $segment;
        array_push( $body_classes, $class );
    }

    return ! empty( $body_classes ) ? implode( ' ', array_unique($body_classes) ) : 'home';
}
