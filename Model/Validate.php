<?php

namespace AbraaoMarques\TaxvatValidator\Model;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

class Validate
{
    private $customerCollection;

    public function __construct(CollectionFactory $customerCollection)
    {
        $this->customerCollection = $customerCollection;
    }

    public function taxvat($taxvat)
    {
        $message = null;
        // Extrai somente os números
        $newTaxvat = preg_replace( '/[^0-9]/is', '', $taxvat);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($newTaxvat) != 11) {
            $message = 'Taxvat is Invalid';
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $newTaxvat[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($newTaxvat[$c] != $d) {
                $message = 'Taxvat is Invalid';
            }
        }

        if (!empty($this->getTaxvat($taxvat))) {
            $message = 'There is already an account with this taxvat';
        }

        return $message;
    }

    private function getTaxvat($taxvat)
    {
        $factory = $this->customerCollection->create();
        $data = $factory->addFieldToSelect('entity_id')
            ->addFieldToFilter('taxvat', $taxvat)
            ->getFirstItem()
            ->getData();

        return $data;
    }
}
