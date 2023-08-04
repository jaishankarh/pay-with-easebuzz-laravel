<?php

namespace Easebuzz\PayWithEasebuzzLaravel;
use Easebuzz\PayWithEasebuzzLaravel\Lib\EasebuzzLib\Easebuzz;

// $easebuzz_path = realpath(dirname(__FILE__));

// require_once($easebuzz_path.'/lib/paywitheasebuzz_lib/easebuzz-lib/easebuzz_payment_gateway.php');

class PayWithEasebuzzLib
{
    private $MERCHANT_KEY = "";
    private $SALT = "";
    private $ENV = "";
    private $easebuzzLib = null;

    /*
    * initialised private variable for setup easebuzz payment gateway.
    *
    * @param  string $key - holds the merchant key.
    * @param  string $salt - holds the merchant salt key.
    * @param  string $env - holds the env(enviroment). 
    *
    */
    function __construct($key, $salt, $env){
        $this->MERCHANT_KEY = $key;
        $this->SALT = $salt;
        $this->ENV = $env;
        global $EASEBUZZ_PATH;
        $this->easebuzzLib = new Easebuzz($key, $salt, $env);
    }

    public function initiatePaymentAPI($params, $redirect=True){
        // include file

        // generate transaction ID and push into $params array
        // $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        // $params['txnid'] = $txnid;
        return $this->easebuzzLib->initiatePaymentAPI($params, $redirect);
    }
    
    public function transactionAPI($params){
        $result = $this->easebuzzLib->transactionAPI($params);
        return $result;
    }

    public function transactionDateAPI($params){
        $result = $this->easebuzzLib->transactionDateAPI($params);
        return $result;
    }

    public function refundAPI($params){
        $result = $this->easebuzzLib->refundAPI($params);
        return $result;
    }
    public function refundAPIV2($params){
        $result = $this->easebuzzLib->refundAPIV2($params);
        return $result;
    }

    public function payoutAPI($params){
        $result = $this->easebuzzLib->payoutAPI($params);
        return $result;
    }

    public function easebuzzResponse($params){
        $result = $this->easebuzzLib->easebuzzResponse($params);
        return $result;
    }

}
