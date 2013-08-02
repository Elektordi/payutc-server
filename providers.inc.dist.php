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

// PROVIDERS CONFIGURATION

/** 
    PAYBOX
    Parametres de test paybox par défaut pour le mode dévellopeur
    A modifier par ses propres paramétres de test ou de prod.
*/
$pbx_config = array(
	'SITE' => "1999888",
	'RANG' => "82",
	'IDENTIFIANT' => "110532808",
	// Ou se trouve l'executable paybox ?
	'EXE' => "/usr/local/paybox/modulev3.cgi",
	// CLEF PUBLIQUE PAYBOX
	'PUBPEM' => "/usr/local/paybox/pubkey.pem",
	'URL' => "https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi",
	'MOBILE_URL' => "https://preprod-tpeweb.paybox.com/cgi/ChoixPaiementMobile.cgi"
);


// PROVIDERS DEFINITIONS

// Enabled authentification providers
$_CONFIG['AuthProviders'] = array(
	'cas' => new \Payutc\Providers\Auth\CAS("http://localhost/faux-cas/", "Identification Etudiant"), // Request login to a CAS (url to cas, display name)
	'local' => new \Payutc\Providers\Auth\Local(), // Use local user database
	'card' => new \Payutc\Providers\Auth\CardReader() // Use a local reader to identify user by its card
);

// Authentification chains (AP order in chain used for display)
$_CONFIG['AuthChains'] = array(
	'default' => array( 'cas', 'local' ),
	'pos' => array( 'card', 'cas', 'local' ), // So sellers can open their POS using their card
	'vm' => array( 'card' ), // For login on Vending Machines (VM)
);

// Enabled identity providers
$_CONFIG['IdentityProviders'] = array(
	'anon' => new \Payutc\Providers\Ident\Anonymous(), // Generate values for all mandatory fields
	'ginger'  => new \Payutc\Providers\Ident\Ginger("http://localhost/faux-ginger/index.php/v1/", "fauxginger"), // Request informations to a Ginger service (url to service, api key)
	'cache' => new \Payutc\Providers\Ident\Cache() // Will use values stored in local database
);

// Identity chains (IP order in chain matters)
// Take note that Anonymous provider, if used, has to be first in chain to prevent values to be overwritten
// If you remove Anonymous provider, login will fail if all mandatory values are not filled by others providers
$_CONFIG['IdentityChains'] = array(
        'default' => array( 'ginger' ),
        'default-local' => array( 'anon', 'cache' ), // Will be used instead of 'default' if 'local' AP is used
	'pos' => array( 'cache' ),
        'vm' => 'default' // Redirect to another chain, and will check for AP specific chains after redirection
);
// Before you even think about it, yes, infinite loops are possible with redirections, and yes, it will crash your server ;)

// Payment providers (public providers displayed to user in this order)
$_CONFIG['PaymentProviders'] = array(
	new \Payutc\Providers\Pay\OnSite(), // Allow sellers to add money to an account
	new \Payutc\Providers\Pay\Paybox($pbx_config) // Allow users to pay using Paybox (config array, see upper in this config file)
);


