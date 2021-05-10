# RAK - Simplify 
## Simplify payment gateway - Laravel Package

And of course Dillinger itself is open source with a [public repository][dill]
 on GitHub.

## Installation

```sh
composer require rak/simplify
```

## Usage
#### Payment Auth/Capture
An authorization is very similar to a payment, except that instead of immediately exchanging money between you and your customer, you place a temporary hold on the customer's account and can then later capture an amount of less than or equal to the amount authorized, releasing the difference back to the customer. It may be important to create an authorization if a customer makes a purchase but there is a delay between acceptance of the customer's payment information and shipping of the item(s) purchased.

##### Authorizing a Payment
Here we will show how to authorize a card payment using a card token similar to the one you generated if you have been following the tutorial so far. Otherwise, [click here ](https://rakbank.simplify.com/commerce/docs/tutorial/index#payments-form)  to learn about generating card tokens. To authorize a payment, you need to use a card token with the RAKBANK Simplify Authorization SDK to create the authorization.

Use the namespace of your installed package on your class:
```sh
use Rak\Simplify\Simplify;
```

After getting the card token create auth using below code:
```sh
Simplify::$publicKey = 'Your Public Key';
Simplify::$privateKey = 'Your Private Key';

try {  
    $rakAuthCheck = Simplify::authorization(array(
        'reference' => 'IO-4521458', // Order reference
        'amount' => 1000, // 10 AED multiplied by 100
        'description' => 'payment description',
        'currency' => 'AED',
        'token' => 'cXsdf', // Card token you received
        'order' => [
            'source' => 'WEB',
            'customerEmail' => 'ebrahim@email.com',
            'customerName' => 'Ebrahim Nayakkan',
        ]
    ));
    
    if($rakAuthCheck){
        //Success call
        Log::info(print_r($rakAuthCheck, true)); // Printing reponse to your log file.
        return $rakAuthCheck;
    }
} catch(Exception $e) {
    // Failed call
    return [
        'auth_message' => $e->getMessage()
    ];
}
```

If you print the success reponse, it will be look like this:
```sh
(
    [card] => stdClass Object
        (
            [id] => XxR8XEz6z
            [name] => Ebrahim
            [type] => MASTERCARD
            [last4] => 8877
            [addressLine1] => 
            [addressCity] => 
            [addressState] => 
            [addressZip] => 
            [addressCountry] => AE
            [expMonth] => 5
            [expYear] => 21
            [dateCreated] => 1620273359426
            [cardEntryMode] => E_COMMERCE
            [indicator] => UNKNOWN
            [indicatorSource] => UNKNOWN
        )

    [amount] => 1000
    [amountRemaining] => 1000
    [currency] => AED
    [description] => payment description
    [captured] => 
    [reversed] => 
    [avsZipMatch] => 1
    [avsCvcMatch] => 1
    [avsAddressMatch] => 1
    [transactionData] => stdClass Object
        (
            [amount] => 1000
            [currency] => AED
            [description] => payment description
            [date] => 2021-05-06T03:56:04Z
            [order] => stdClass Object
                (
                    [reference] => 
                    [commodityCode] => 
                    [customer] => stdClass Object
                        (
                            [reference] => 
                        )
                )
        )
    [reference] => IO-4521458
    [authCode] => psBbAT
    [paymentStatus] => APPROVED
    [dateCreated] => 1620273364428
    [paymentDate] => 1620273364382
    [id] => a7R8aboL8
    [source] => HOSTED_PAYMENTS
    [expirationDate] => 1620878164237
    [expired] => 
    [capturedAmount] => 0
    [reversedAmount] => 0
)
```

##### Capturing an Authorization
Most of the time, creating an authorization will eventually be followed by capturing a payment. To capture a payment, use the same command as you normally would to create a payment, but instead of specifying a card token or card information, you will reference an authorization ID. Make sure that the capture currency is the same as the authorization currency and that the amount captured is equal to or less than the authorization amount.

```sh
Simplify::$publicKey = 'Your Public Key';
Simplify::$privateKey = 'Your Private Key';

try {
    $payment = Simplify::createPayment(array(
        'authorization' => 'a7R8aboL8', //Authorization ID you received in Authorizing
        'reference' => 'IO-4521458',
        'amount' => 1000, // 10 AED multiplied by 100
        'description' => 'payment description',
        'currency' => 'AED',
        'order' => [
            'source' => 'WEB',
            'status' => 'INCOMPLETE',
            'customerEmail' => 'ebrahim@email.com',
            'customerName' => 'Ebrahim Nayakkan',
        ]
    ));
    if ($payment->paymentStatus == 'APPROVED') {
        Log::info(print_r($payment, true)); // Printing reponse to your log file.
        return $payment;
    }
} catch (Exception $e) {
    return [
        'auth_message' => $e->getMessage(), // Capture Failed
    ];
}
```

