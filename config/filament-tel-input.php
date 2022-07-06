<?php
/*
 * 
 * configurations for Jojostx/FilamentTelInput [Filament International Telephone Input]
 *  
 * For more details about the configurations, see:
 * https://github.com/jojostx/filament-tel-input
 */
return [
  'options' => [
    
    /**
     * geoIpLookup
     *    1. null - core plugin default
     *    2. 'ipinfo' - Predefined lookups for IP addresses implementation using free service from https://ipinfo.io.
     *                - The lookup result for each tel input is stored in a cookie to avoid repeat lookups.
     *    3. 'CustomFunctionName' - Create your javascript function with the specified custom name and bind to window as window.ACustomFunctionName.
     * 
     * see: https://github.com/jackocnr/intl-tel-input#initialisation-options
     */
    'geoIpLookup' => 'ipinfo',

    /**
     * utilsScript
     * - path to the utils.js file in public/ directory.
     */
    'utilsScript' => 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/utils.min.js',
  ]
];
