<?php
/*
 * Copyright (c) 2013 - 2020 MasterCard International Incorporated
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are 
 * permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of 
 * conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * Neither the name of the MasterCard International Incorporated nor the names of its 
 * contributors may be used to endorse or promote products derived from this software 
 * without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES 
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT 
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING 
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF 
 * SUCH DAMAGE.
 */

namespace Rak\Simplify;

use Rak\Simplify\SimplifyFiles\SimplifyConstants;
use Rak\Simplify\SimplifyFiles\SimplifyAuthorization;
use Rak\Simplify\SimplifyFiles\SimplifyCoupon;
use Rak\Simplify\SimplifyFiles\SimplifyCustomer;
use Rak\Simplify\SimplifyFiles\SimplifyPayment;
use Rak\Simplify\SimplifyFiles\SimplifyPlan;
use Rak\Simplify\SimplifyFiles\SimplifyRefund;
use Rak\Simplify\SimplifyFiles\SimplifySubscription;

// require_once(dirname(__FILE__) . '/SimplifyFiles/Constants.php');

class Simplify
{
    /**
     * @var string $publicKey public API key used to authenticate requests.
     */
    public static $publicKey;

    /**
     * @var string $privateKey private API key used to authenticate requests.
     */
    public static $privateKey;


    /**
     * @var string $apiBaseLiveUrl URL of the live API endpoint
     */
    public static $apiBaseLiveUrl = SimplifyConstants::API_BASE_LIVE_URL;

    /**
     * @var string $apiBaseSandboxUrl URL of the sandbox API endpoint
     */
    public static $apiBaseSandboxUrl = SimplifyConstants::API_BASE_SANDBOX_URL;

    /**
     * @var string $userAgent User-agent string send with requests.
     */
    public static $userAgent = null;

    // Charging a card
    public static function chargingCard($data){
        return SimplifyPayment::createPayment($data);
    }

    // Recurring Payments
    public static function recurringPayment($data){
        return SimplifyPlan::createPlan($data);
    }

    // Create a customer and subscribe to a plan
    public static function createCustomer($data){
        return SimplifyCustomer::createCustomer($data);
    }

    // Create a coupon
    public static function createCoupon($data){
        return SimplifyCoupon::createCoupon($data);
    }

    // Applying coupon to a subscription
    public static function createSubscription($data){
        return SimplifySubscription::createSubscription($data);
    }

    // Refunding a Payment
    public static function refundPayment($data){
        return SimplifyRefund::createRefund($data);
    }

    // Creating authorization
    public static function authorization($data){
        return SimplifyAuthorization::createAuthorization($data);
    }

    // Capturing authorized payment
    public static function createPayment($data){
        return SimplifyPayment::createPayment($data);
    }

}

require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyObject.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/AccessToken.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyAuthentication.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyPaymentsApi.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Exceptions.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyHttp.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/ResourceList.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/Simplify_Authorization.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/CardToken.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Chargeback.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyCoupon.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyCustomer.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Deposit.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Event.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/FraudCheck.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Invoice.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/InvoiceItem.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Tax.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyPayment.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyPlan.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifyRefund.php');
// require_once(dirname(__FILE__) . '/SimplifyFiles/SimplifySubscription.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/TransactionReview.php');
require_once(dirname(__FILE__) . '/SimplifyFiles/Webhook.php');
