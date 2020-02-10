<?php

namespace Jumpers\Payment\Plugin;

use Magento\Payment\Model\InfoInterface;

class Payment
{
    public function aroundOrder(
        \RicardoMartins\PagSeguro\Model\Method\Boleto $subject,
        callable $proceed,
        InfoInterface $payment,
        $amount
    ){
        $pay = $proceed($payment, $amount);
        $payment->setSkipOrderProcessing(false);
        return $pay;
    }
}