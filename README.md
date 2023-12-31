# PayWithEasebuzz Laravel Package
This package exposes Easebuzz core payment apis as a Laravel package.

# Installation
```
composer require easebuzz/pay-with-easebuzz-laravel
```

## Create the Easebuzz Controller
```
php artisan make:controller
```

## Easebuzz Controller
```
# EasebuzzController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Easebuzz\PayWithEasebuzzLaravel\PayWithEasebuzzLib;


class EasebuzzController extends Controller
{
    //
    public function initiate_payment_show(): View
    {
        return view('initiate_payment', ['result' => '']);
    }
    public function initiate_payment_ebz(Request $request): View
    {
        $post_data = $request->post();
        $key = "ERT8J8M6V0";
        $salt = "KTZRSU67RK";
        $env = "test";
        $payebz = new PayWithEasebuzzLib($key, $salt, $env);
        $result = $payebz->initiatePaymentAPI($post_data, false);
        
        // var_dump($result);
        // die();

        return view('initiate_payment', ['result' => $result]);
    }
    public function ebz_response(Request $request): View
    {
        $post_data = $request->post();
        var_dump($post_data);
        die();
        return view('initiate_payment', ['result' => '']);
    }
}

```
## Create the view file 

```
resources/views/initiate_payment.blade.php
```

## Initiate Payment View  

```
<?php
function uniqidReal($length = 8) {
    // uniqid gives 8 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($length / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $length);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Initiate Payment API</title>
    </head>
    <body>
        <div class="grid-container">
            <header class="wrapper">
                <div class="logo">
                    <a href="../index.html">
                        <img src="../assets/images/eb-logo.svg" alt="Easebuzz">
                    </a>
                </div>

                <div class="hedding">
                    <h2><a class="highlight" href="../index.html">Back</a></h2>
                </div>
            </header>

            <div>
                <pre> 
                {{$result}}
                </pre>

            </div>
            
            <div class="form-container">
                <h2>INITIATE PAYMENT API</h2>
                <hr>
                <form method="POST">
                    @csrf
                    <div class="main-form">
                        <h3>Mandatory Parameters</h3>
                        <hr>
                        <div class="mandatory-data">
                            <div class="form-field">
                                <label for="txnid">Transaction ID<sup>*</sup></label>
                                <input id="txnid" class="txnid" name="txnid" value="<?= uniqidReal() ?>" placeholder="T31Q6JT8HB">
                            </div>

                            <div class="form-field">
                                <label for="amount">Amount<sup>(should be float)*</sup></label>
                                <input id="amount" class="amount" name="amount" value="10" placeholder="125.25">
                            </div>  

                            <div class="form-field">
                                <label for="firstname">First Name<sup>*</sup></label>
                                <input id="firstname" class="firstname" name="firstname" value="Jaishankar" placeholder="Easebuzz Pvt. Ltd.">
                            </div>
                    
                            <div class="form-field">
                                <label for="email">Email ID<sup>*</sup></label>
                                <input id="email" class="email" name="email" value="jaishankarh@gmail.com"
                                placeholder="initiate.payment@easebuzz.in">
                            </div>
                    
                            <div class="form-field">
                                <label for="phone">Phone<sup>*</sup></label>
                                <input id="phone" class="phone" name="phone" value="9604558336"
                                placeholder="0123456789">
                            </div>
                            
                            <div class="form-field">
                                <label for="productinfo">Product Information<sup>*</sup></label>
                                <input id="productinfo" class="productinfo" name="productinfo" value="Apple Laptop" placeholder="Apple Laptop">
                            </div>
                    
                            <div class="form-field">
                                <label for="surl">Success URL<sup>*</sup></label>
                                <input id="surl" class="surl" name="surl" value="http://localhost:8002/easebuzz/response" placeholder="http://localhost:8002/easebuzz/response">
                            </div>
                            
                            <div class="form-field">
                                <label for="furl">Failure URL<sup>*</sup></label>
                                <input id="furl" class="furl" name="furl" value="http://localhost:8002/easebuzz/response"
                                placeholder="http://localhost:8002/easebuzz/response">
                            </div>

                        </div>

                        <h3>Optional Parameters</h3>
                        <hr>
                        <div class="optional-data">

                            <div class="form-field">
                                <label for="udf1">UDF1</label>
                                <input id="udf1" class="udf1" name="udf1" value="" placeholder="User description1">
                            </div>
                        
                            <div class="form-field">
                                <label for="udf2">UDF2</label>
                                <input id="udf2" class="udf2" name="udf2" value="" placeholder="User description2">
                            </div>
                    
                            <div class="form-field">
                                <label for="udf3">UDF3</label>
                                <input id="udf3" class="udf3" name="udf3" value="" placeholder="User description3">
                            </div>
                    
                            <div class="form-field">
                                <label for="udf4">UDF4</label>
                                <input id="udf4" class="udf4" name="udf4" value="" placeholder="User description4">
                            </div>
                    
                            <div class="form-field">
                                <label for="udf5">UDF5</label>
                                <input id="udf5" class="udf5" name="udf5" value="" placeholder="User description5">
                            </div>
                            
                            <div class="form-field">
                                <label for="address1">Address 1</label>
                                <input id="address1" class="address1" name="address1" value="" 
                                placeholder="#250, Main 5th cross,">
                            </div>
                    
                            <div class="form-field">
                                <label for="address2">Address 2</label>
                                <input id="address2" class="address2" name="address2" value="" 
                                placeholder="Saket nagar, Pune">
                            </div>
                            
                            <div class="form-field">
                                <label for="city">City</label>
                                <input id="city" class="city" name="city" value="" placeholder="Pune">
                            </div>
                    
                            <div class="form-field">
                                <label for="state">State</label>
                                <input id="state" class="state" name="state" value="" placeholder="Maharashtra">
                            </div>
                    
                            <div class="form-field">
                                <label for="country">Country</label>
                                <input id="country" class="country" name="country" value="" placeholder="India">
                            </div>
                            
                            <div class="form-field">
                                <label for="zipcode">Zip-Code</label>
                                <input id="zipcode" class="zipcode" name="zipcode" value="" placeholder="123456">
                            </div>

                               <!-- <div class="form-field">
                                <label for="sub_merchant_id">Sub-Merchant ID</label>
                                <input id="sub_merchant_id" class="sub_merchant_id" name="sub_merchant_id" value="" placeholder="123456">
                            </div>

                             <div class="form-field">
                                <label for="unique_id">Unique Id</label>
                                <input id="unique_id" class="unique_id" name="unique_id" value="" placeholder="Customer unique Id">
                            </div>

                             <div class="form-field">
                                <label for="split_payments">Split payment</label>
                                <input id="split_payments" class="split_payments" name="split_payments" value="" placeholder='{ "axisaccount" : 100, "hdfcaccount" : 100}'>
                            </div> 

                              <div class="form-field">
                                <label for="show_payment_mode">Show Payment Mode</label>
                                <input id="show_payment_mode" class="show_payment_mode" name="show_payment_mode" value="" placeholder='NB,DC,CC,Debit+ATM Pin,MW,UPI,OM,EMI'>
                            </div> -->


                        </div>
                
                        <div class="btn-submit">
                            <button type="submit">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </body>
    </html>
```

## Register the routes
```
# routes/web.php

Route::get('/easebuzz/initiate', [EasebuzzController::class, 'initiate_payment_show']);
Route::post('/easebuzz/initiate', [EasebuzzController::class, 'initiate_payment_ebz']);
Route::post('/easebuzz/response', [EasebuzzController::class, 'ebz_response']);
```