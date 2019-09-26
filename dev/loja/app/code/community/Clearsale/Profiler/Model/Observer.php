<?php

class Clearsale_Profiler_Model_Observer
{

    public function customerRegisterSuccess($observer)
    {
        $customer = $observer->getEvent()->getCustomer();

        if ($customer->getClearsaleAccountCode()) {
            return;
        }

       $this->validateCode($observer);
    }

    public function customerLogin($observer)
    {
        Mage::getModel('clearsale_profiler/api')->login(
            array(
                "code" => $this->validateCode($observer),
                "sessionID" => Mage::getSingleton('core/session')->getEncryptedSessionId()
            )
        );
    }

    public function customerLogout($observer)
    {
        Mage::getModel('clearsale_profiler/api')->logout(
            array(
                "code" => $this->validateCode($observer)
            )
        );
    }

    public function checkoutSuccess($observer)
    {
        if ($observer->getQuote()->getData('checkout_method') != Mage_Checkout_Model_Type_Onepage::METHOD_REGISTER) {
            return;
        }

        $customer = $observer->getOrder()->getCustomer();
        $payment = $observer->getOrder()->getPayment();
        $sessionId = Mage::getSingleton('core/session')->getEncryptedSessionId();
        $data = Mage::getModel('clearsale_profiler/customerFormatter')->formatCustomerData($customer, $sessionId, $payment);
        $code = Mage::getModel('clearsale_profiler/api')->accountCreate($data);

        if ($code) {
            $customer->setData("clearsale_account_code", $code);
            $customer->save();
        }
    }

    public function customerUpdate($observer)
    {
        $customer = $observer->getCustomer();

        if (!$customer->getClearsaleAccountCode()) {
            return;
        }

        $sessionId = Mage::getSingleton('core/session')->getEncryptedSessionId();
        $data = Mage::getModel('clearsale_profiler/customerFormatter')->formatCustomerData($customer, $sessionId);
        Mage::getModel('clearsale_profiler/api')->accountUpdate($data);
    }

    public function passwordReset($observer)
    {
        $email = (string)Mage::app()->getRequest()->getPost('email');
        if ($email) {

            $customer = Mage::getModel("customer/customer");
            $customer->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
            $customer->loadByEmail($email);

            if (!$customer->getId()) {
                return;
            }

            Mage::getModel('clearsale_profiler/api')->passwordReset(array(
                "code" => $this->validateCode($observer, $customer),
                "sessionID" => Mage::getSingleton('core/session')->getEncryptedSessionId()
            ));
        }
    }

    public function validateCode($observer, $customer = false)
    {
        if ($customer) {
            $code = $customer->getClearsaleAccountCode();
            return $code;
        }

        $code = $observer->getEvent()->getCustomer()->getClearsaleAccountCode();
        if ($code) {
            return $code;
        }

        $this->generateCode($observer);
    }

    public function generateCode($observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $sessionId = Mage::getSingleton('core/session')->getEncryptedSessionId();
        $data = Mage::getModel('clearsale_profiler/customerFormatter')->formatCustomerData($customer, $sessionId);
        $code = Mage::getModel('clearsale_profiler/api')->accountCreate($data);

        if ($code) {
            $customer->setData("clearsale_account_code", $code);
            $customer->save();
        }
        return $code;
    }
}