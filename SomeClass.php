<?php

/**
 * SomeClass
 *
 * @package     Event Espresso
 * @subpackage  ${NAMESPACE}
 * @author      Brent Christensen
 * @since       1.0.1
 */
class SomeClass
{
    /**
     * @return void
     * @since 1.0.1
     */
    public static function testingVersionUpdates()
    {
        echo 'Testing version updates...';
    }


    /**
     * @return void
     * @since 1.0.2
     */
    public static function crazyNewFeature()
    {
        echo 'oh wow... this is a crazy new feature :face_with_rolling_eyes:';
    }


    /**
     * @return void
     * @since 1.0.4
     */
    public static function betterFeature()
    {
        echo 'better feature!!!';
    }


    /**
     * @return void
     * @since 1.0.3
     * @deprecated 1.0.4
     */
    public static function yetAnotherFeature()
    {
        echo 'another feature?!?!?!';
    }
}
