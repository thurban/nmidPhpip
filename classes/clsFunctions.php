<?php
/*
+-------------------------------------------------------------------------+
| Copyright (C) 2006 Michael Earls                                        |
|                                                                         |
| This program is free software; you can redistribute it and/or           |
| modify it under the terms of the GNU General Public License             |
| as published by the Free Software Foundation; either version 2          |
| of the License, or (at your option) any later version.                  |
|                                                                         |
| This program is distributed in the hope that it will be useful,         |
| but WITHOUT ANY WARRANTY; without even the implied warranty of          |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
| GNU General Public License for more details.                            |
+-------------------------------------------------------------------------+
| - phpIP - http://www.phpip.net/                                         |
+-------------------------------------------------------------------------+
*/

// @function
// check form as values
//

function filled_out($form_vars)
{
  // test that each variable has a value
  foreach ($form_vars as $key => $value)
  {
     if (!isset($key) || ($value == ""))
        return false;
  }
  return true;
}


// @function       
// cache dns host address
// based on ip address

function gethostbyaddr_with_cache($a) {
  global $dns_cache;
  if ($dns_cache[$a]) {
   return $dns_cache[$a];
   } else {
   $temp = gethostbyaddr($a);
   $dns_cache[$a] = $temp;
   return $temp;
  }
   }



?>