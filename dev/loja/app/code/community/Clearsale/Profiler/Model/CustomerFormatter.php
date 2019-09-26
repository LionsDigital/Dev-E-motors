<?php

class Clearsale_Profiler_Model_CustomerFormatter
{

    public function formatCustomerData($customer, $sessionId, $payment = false)
    {
        $data = array(
            "code" => $customer->getId(),
            "date" => $customer->getCreatedAt(),
            "sessionID" => $sessionId,
            "email" => $customer->getEmail(),
            "passwordHash" => $customer->getPasswordHash()
        );

        if (count($customer->getAddresses()) > 0) {
            $addressData = $this->formatAddress($customer->getAddresses());
            $data['addresses'] = $addressData;
        }

        if ($customer->getDefaultBillingAddress() && ($customer->getDefaultBillingAddress()->getTelephone() || $customer->getDefaultBillingAddress()->getFax())) {
            $data['telephones'] = $this->formatTelephonesData($customer);
        }

        if ($payment && $payment->getId() && (stripos($payment->getCheckmo(), "card") !== false || stripos($payment->getCheckmo(), "cc") !== false)) {
            $data["payments"] = $this->formatPaymentData();
        }

        $taxVatFieldName = Mage::getStoreConfig('clearsale_setting_profiler/clearsale_settings/clearsale_app_taxvat_name');
        $taxVatGetter = "get" . $taxVatFieldName;
        $taxVat = $customer->$taxVatGetter();

        $customerName = $customer->getFirstname() . " " . $customer->getLastname();

        if (!$taxVat || $this->isTaxVatACpf($taxVat)) {
            $data['personDocument'] = $taxVat;
            $data['name'] = $customerName;
            $data["gender"] = $customer->getGender();
            $data["birthDate"] = $customer->getDob();
        } else {
            $data['companyDocument'] = $taxVat;
            $data['companyName'] = $customerName;
        }

        return $data;
    }

    private function formatAddress($addresses)
    {
        $addressData = array();

        foreach ($addresses as $address) {
            $addressData[] = array(
                "street" => $address->getStreet(1),
                "number" => $address->getStreet(2),
                "city" => $address->getCity(),
                "state" => $address->getRegion(),
                "country" => $address->getCountryId(),
                "county" => $address->getStreet(4),
                "zipcode" => str_replace("-", "", $address->getPostcode())
            );
        }

        return $addressData;
    }

    private function formatTelephonesData($customer)
    {

        $phones = array();

        $telephone = $customer->getDefaultBillingAddress()->getTelephone();
        $phones[] = $this->formatPhoneNumber($telephone);

        $celular = $customer->getDefaultBillingAddress()->getFax();
        $phones[] = $this->formatPhoneNumber($celular);

        return $phones;

    }

    private function formatPhoneNumber($phoneNumber)
    {
        $numberWithoutDDD = substr($phoneNumber, 2);

        if (strlen($numberWithoutDDD) == 8) {
            $numberWithoutDDD = wordwrap($numberWithoutDDD, 4, '-', true);
        } else {
            $numberWithoutDDD = wordwrap($numberWithoutDDD, 5, '-', true);
        }

        return array(
            "ddi" => "55",
            "ddd" => substr($phoneNumber, 0, 2),
            "number" => $numberWithoutDDD
        );
    }

    private function formatPaymentData($payment)
    {

        return array(
            array(
                "ownerName" => $payment->getCcOwner(),
                "bin" => substr($payment->getCcNumber(), 0, 6),
                "endNumber" => substr($payment->getCcNumber(), strlen($payment->getCcNumber() - 4)),
                "type" => $payment->getCcType()
            )
        );
    }

    private function isTaxVatACpf($taxVat)
    {
        return strlen($taxVat) === 11;
    }
}