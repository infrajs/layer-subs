<?php
namespace infrajs\layer\subs;

use infrajs\ans\Ans;

if (!is_file('vendor/autoload.php')) {
    chdir('../../../../');
    require_once('vendor/autoload.php');
}

return Ans::ret();