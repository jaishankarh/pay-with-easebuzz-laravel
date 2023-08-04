# PayWithEasebuzz Laravel Package
This package exposes Easebuzz core payment apis as a Laravel package.

# Installation
```
composer require easebuzz/pay-with-easebuzz-laravel
```

## Sample Controller
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
}

```
## Sample 