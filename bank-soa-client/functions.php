<?php 
    ini_set('soap.wsdl_cache_enabled', '0');
    ini_set('soap.wsdl_cache_ttl', '0');
    $clientSoap = new SoapClient("http://localhost:8590/BankService?wsdl");
    $param = new stdClass();
    $accounts = $clientSoap->__soapCall("getAccounts", array($param));

    function deposit($code, $amount){
        global $clientSoap;
        global $accounts;
        $param = new stdClass();
        $param->code = $code;
        $param->amount = $amount;
        $clientSoap->__soapCall("deposit", array($param));
        $accounts = $clientSoap->__soapCall("getAccounts", array($param));

        header("location:index.php");

    }

    function withdraw($code, $amount){
        global $clientSoap;
        global $accounts;
        $param = new stdClass();
        $param->code = $code;
        $param->amount = $amount;
        $clientSoap->__soapCall("withdraw", array($param));
        $accounts = $clientSoap->__soapCall("getAccounts", array($param));

        header("location:index.php");

    }

    function transfer($src_code, $dest_code, $amount){
        global $clientSoap;
        global $accounts;
        $param = new stdClass();
        $param->src_code = $src_code;
        $param->dest_code = $dest_code;
        $param->amount = $amount;
        $clientSoap->__soapCall("transfer", array($param));
        $accounts = $clientSoap->__soapCall("getAccounts", array($param));

        header("location:index.php");

    }
    function delete($code){
        global $clientSoap;
        global $accounts;
        $param = new stdClass();
        $param->code = $code;
        $clientSoap->__soapCall("delete", array($param));
        $accounts = $clientSoap->__soapCall("getAccounts", array($param));

        header("location:index.php");

    }

    function create($code, $balance, $creation_date){
        global $clientSoap;
        global $accounts;
        $param = new stdClass();
        $param->code = $code;
        $param->balance = $balance;
        $param->creation_date = $creation_date;
        $clientSoap->__soapCall("addAccount", array($param));
        $accounts = $clientSoap->__soapCall("getAccounts", array($param));

    }


?>