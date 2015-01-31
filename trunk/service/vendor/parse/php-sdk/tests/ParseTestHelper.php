<?php

use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;

class ParseTestHelper
{

  public static function setUp()
  {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('UTC');
    ParseClient::initialize(
      'INBAPRtPwChlHTNfwcjssuIg5gC2UPzLPmkkI0tk',
      'q8gecthcztdVa8tD2aQ4XOydgC9qGRoKqQMrAffK',
      'skSWdZKMc1hkoBoIw7cmuq4INKYSHJJblPtQYDEp'
    );
  }

  public static function tearDown()
  {

  }

  public static function clearClass($class)
  {
    $query = new ParseQuery($class);
    $query->each(function(ParseObject $obj) {
      $obj->destroy(true);
    }, true);
  }

} 