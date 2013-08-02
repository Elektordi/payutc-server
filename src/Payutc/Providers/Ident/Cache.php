<?php 
/**
*    payutc
*    Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*    This file is part of payutc
*    
*    payutc is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    payutc is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Payutc\Providers\Ident;

use \Payutc\Providers\BaseIdent;
use \Payutc\Log;
use \Payutc\Config;
use \Payutc\Db\Dbal;

/**
* BaseIdent
* 
* Parent of all Ident Providers
*/
class Cache extends BaseIdent {

    /**
    * Constructeur
    * 
    * @param none
    */
    public function __construct() {
        Log::debug("blablabla");
    }

}
