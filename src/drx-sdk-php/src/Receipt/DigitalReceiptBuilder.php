<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:22
 */

namespace Dreceiptx\Receipt;


use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\ConfigManager;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceChargeType;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\AllowanceCharge\SettlementType;
use Dreceiptx\Receipt\Common\ContactType;
use Dreceiptx\Receipt\Common\LocationInformation;
use Dreceiptx\Receipt\Common\TransactionalParty;
use Dreceiptx\Receipt\Document\ReceiptContact;
use Dreceiptx\Receipt\Document\ReceiptContactType;
use Dreceiptx\Receipt\Document\StandardBusinessDocumentHeader;
use Dreceiptx\Receipt\Invoice\Identification;
use Dreceiptx\Receipt\Invoice\Invoice;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\LineItem\TransactionalTradeItem;
use Dreceiptx\Receipt\Settlement\PaymentReceipt;
use Dreceiptx\Receipt\Tax\Tax;
use SebastianBergmann\Diff\Line;

class DigitalReceiptBuilder
{
    /**
     * @var DRxDigitalReceipt $receipt;
     */
    private $receipt;

    private $defaultCountry;
    private $defaultLanguage;
    private $defaultCurrency;
    private $defaultTaxCategory;
    private $defaultTaxCode;

    /**
     * DigitalReceiptBuilder constructor.
     * @param ConfigManager $configuration
     * @throws \Exception
     */
    public function __construct($configuration)
    {
        $this->defaultCountry = $this->validateConfigOption($configuration, ConfigKeys::DefaultCountry);
        $this->defaultLanguage = $this->validateConfigOption($configuration, ConfigKeys::DefaultLanguage);
        $this->defaultCurrency = $this->validateConfigOption($configuration, ConfigKeys::DefaultCurrency);
        $this->defaultTaxCategory = $this->validateConfigOption($configuration, ConfigKeys::DefaultTaxCategory);
        $this->defaultTaxCode = $this->validateConfigOption($configuration, ConfigKeys::DefaultTaxCode);

        $this->receipt = new DRxDigitalReceipt();
        $header = new StandardBusinessDocumentHeader();
        if($configuration->exists(ConfigKeys::dRxGLN)) {
            $header->setdRxGLN($configuration->getConfigValue(ConfigKeys::dRxGLN));
        }
        if($configuration->exists(ConfigKeys::MerchantGLN)) {
            $header->setMerchantGLN($configuration->getConfigValue(ConfigKeys::MerchantGLN));
        }
        if($configuration->exists(ConfigKeys::ReceiptVersion)) {
            $header->setTypeVersion($configuration->getConfigValue(ConfigKeys::ReceiptVersion));
        }
        $header->setCreationDateAndTime(date("Y-m-d\TH:i:sO"));

        $this->receipt->setStandardBusinessDocumentHeader($header);

        $invoice = new Invoice();
        $invoice->setInvoiceCurrencyCode($configuration->getConfigValue(ConfigKeys::DefaultCurrency));
        $invoice->setCountryOfSupplyOfGoods($configuration->getConfigValue(ConfigKeys::DefaultCountry));
        $this->receipt->setInvoice($invoice);

        $paymentReceipts = array();
        $this->receipt->setPaymentReceipts($paymentReceipts);
    }

    /**
     * @param mixed $defaultCountry
     */
    public function setDefaultCountry($defaultCountry)
    {
        $this->defaultCountry = $defaultCountry;
    }

    /**
     * @param mixed $defaultLanguage
     */
    public function setDefaultLanguage($defaultLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
    }

    /**
     * @param mixed $defaultCurrency
     */
    public function setDefaultCurrency($defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * @param mixed $defaultTaxCategory
     */
    public function setDefaultTaxCategory($defaultTaxCategory)
    {
        $this->defaultTaxCategory = $defaultTaxCategory;
    }

    /**
     * @param mixed $defaultTaxCode
     */
    public function setDefaultTaxCode($defaultTaxCode)
    {
        $this->defaultTaxCode = $defaultTaxCode;
    }

    public function setMerchantGLN($merchantGLN) {
        $this->receipt->getStandardBusinessDocumentHeader()->setMerchantGLN($merchantGLN);
        return $this;
    }

    public function setUserGUID($type, $value) {
        $this->receipt->getStandardBusinessDocumentHeader()->setUserIdentifier($type.":".$value);
        return $this;
    }

    public function setMerchatReference($reference) {
        $this->receipt->getStandardBusinessDocumentHeader()->getDocumentIdentification()->setInstanceIdentifier($reference);
        if($this->receipt->getInvoice()->getInvoiceIdentification() == null) {
            $this->receipt->getInvoice()->setInvoiceIdentification(Identification::create($reference));
        }
        return $this;
    }

    public function setReceiptDateTime($invoiceDate) {
        $this->receipt->getInvoice()->setCreationDateTime($invoiceDate);
        return $this;
    }

    public function setPurchaseOrderNumber($number) {
        $this->receipt->getInvoice()->setPurchaseOrder(Identification::create($number));
    }

    public function setCustomerReferenceNumber($number) {
        $this->receipt->getInvoice()->setCustomerReference(Identification::create($number));
        return $this;
    }

    public function setBillingInformation($name, $taxCode, $taxRegistrationID) {
        $this->receipt->getInvoice()->setBillTo(TransactionalParty::create($name, $taxCode, $taxRegistrationID));
        return $this;
    }


    public function setSalesOrderReference($reference) {
        $this->receipt->getInvoice()->setSalesOrder(Identification::create($reference));
        return $this;
    }


    public function addClientRecipientContact($name, $email, $phone) {
        $this->addRMSContact(ReceiptContactType::RECIPIENT_CONTACT, $name, $email, $phone);
        return $this;
    }

    public function addClientPurchasingContact($name, $email, $phone) {
        $this->addRMSContact(ReceiptContactType::PURCHASING_CONTACT, $name, $email, $phone);
        return $this;
    }

    private function addRMSContact($type, $name, $email, $phone) {
        $rmsContact = ReceiptContact::create($type, $name);
        if($email != null) {
            $rmsContact->addContact(ContactType::EMAIL, $email);
        }
        if ($phone != null) {
            $rmsContact->addContact(ContactType::TELEPHONE, $phone);
        }
        $this->receipt->getStandardBusinessDocumentHeader()->addRMSContact($rmsContact);
    }

    public function addMerchantCustomerRelationsContact($name, $email, $phone) {
        $this->addMerchantContact(ReceiptContactType::CUSTOMER_RELATIONS, $name, $email, $phone);
        return $this;
    }

    public function addMerchantDeliveryContact($name, $email, $phone) {
        $this->addMerchantContact(ReceiptContactType::DELIVERY_CONTACT, $name, $email, $phone);
        return $this;
    }

    public function addMerchantSalesAssistantContact($name, $email, $phone) {
        $this->addMerchantContact(ReceiptContactType::SALES_ADMINISTRATION, $name, $email, $phone);
        return $this;
    }

    private function addMerchantContact($type, $name, $email, $phone) {
        $merchantContact = ReceiptContact::create($type, $name);
        if($email != null) {
            $merchantContact->addContact(ContactType::EMAIL, $email);
        }
        if ($phone != null) {
            $merchantContact->addContact(ContactType::TELEPHONE, $phone);
        }
        $this->receipt->getStandardBusinessDocumentHeader()->addMerchantContact($merchantContact);
    }

    public function setReceiptNumber($number) {
        $this->receipt->getInvoice()->setInvoiceIdentification(Identification::create($number));
        if($this->receipt->getStandardBusinessDocumentHeader()->getDocumentIdentification()->getInstanceIdentifier() == null) {
            $this->receipt->getStandardBusinessDocumentHeader()->getDocumentIdentification()->setInstanceIdentifier($number);
        }
        return $this;
    }

    public function setDespatchInformation($despatchInformation) {
        $this->receipt->getInvoice()->setDespatchInformation($despatchInformation);
        return $this;
    }

    /**
     * @param LineItem $lineItem
     * @return int
     */
    public function addLineItem($lineItem) {
        foreach ($lineItem->getInvoiceLineTaxInformation() as $tax) {
            $this->configureTax($tax);
        }
        return $this->receipt->getInvoice()->addLineItem($lineItem);
    }

    /**
     * @param LineItem $lineItem
     * @param Tax $tax
     * @return int
     */
    public function addLineItemWithTax($lineItem, $tax) {
        $this->configureTax($tax);
        $lineItem->addTax($tax->getDutyFeeTaxCategoryCode(), $tax->getDutyFeeTaxPercentage(), $tax->getDutyFeeTaxTypeCode());
        return $this->receipt->getInvoice()->addLineItem($lineItem);
    }

    public function addLineItemFromData($brand, $name, $description, $quantity, $price) {
        return $this->receipt->getInvoice()->addLineItem(LineItem::create($brand, $name, $description,  $quantity, $price));
    }

    public function addLineItemFromDataWithTax($brand, $name, $description, $quantity, $price, $tax) {
        $lineItem = LineItem::create($brand, $name, $description,  $quantity, $price);
        $this->configureTax($tax);
        $lineItem->addTax($tax->getDutyFeeTaxCategoryCode(), $tax->getDutyFeeTaxPercentage(), $tax->getDutyFeeTaxTypeCode());
        return $this->receipt->getInvoice()->addLineItem($lineItem);
    }

    public function removeLineItem($number) {
        $this->receipt->getInvoice()->removeLineItem($number);
    }

    public function addPaymentReceipt($paymentMethodCode, $amount) {
        $paymentReceipt = PaymentReceipt::create($paymentMethodCode, $amount);
        return $this->receipt->addPaymentReceipt($paymentReceipt);
    }

    private function getTaxArray($tax){
        $taxArray = null;
        if($tax != null) {
            $this->configureTax($tax);
            $taxArray = [$tax];
        }
        return $taxArray;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addGeneralDiscount($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::ALLOWANCE,
            AllowanceChargeType::CREDIT_CUSTOMER_ACCOUNT,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::GeneralDiscount,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addTip($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::TIP,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addPackagingFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::PackagingFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addDeliveryFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::DeliveryFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addFreightFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::FreightFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addProcessingFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::ProcessingFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addBookingFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::BookingFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addAdminFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::AdminFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addAmendmentFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::AmendmentFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addServiceFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::ServiceFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function addReturnOrCancellationFee($amount, $description, $tax) {
        $this->receipt->getInvoice()->addAllowanceCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $this->getTaxArray($tax),
            SettlementType::ReturnOrCancellationFee,
            null));
        return $this;
    }

    /**
     * @param double $amount
     * @param string $description
     * @param Tax $tax
     * @return DigitalReceiptBuilder
     */
    public function setDeliveryInformation($locationInformation, $deliveryFees, $despatchInformation) {
        $this->receipt->getInvoice()->setShipTo($locationInformation);
        foreach ($deliveryFees as $charge) {
            $this->receipt->getInvoice()->addAllowanceCharge($charge);
        }
        $this->receipt->getInvoice()->setDespatchInformation($despatchInformation);
        return $this;
    }

    public function setDeliveryAddress($address, $contact) {
        $locationInformation = new LocationInformation();
        $locationInformation->setAddress($address);
        if($contact != null) {
            $locationInformation->addContact($contact);
        }
        $this->receipt->getInvoice()->setShipTo($locationInformation);
        return $this;
    }

    public function setDeliveryDate($date) {
        $this->receipt->getInvoice()->getDespatchInformation()->setDespatchDateTime($date);
        return $this;
    }

    public function setOriginAddress($address, $contact) {
        $locationInformation = new LocationInformation();
        $locationInformation->setAddress($address);
        if($contact != null) {
            $locationInformation->addContact($contact);
        }
        $this->receipt->getInvoice()->setShipFrom($locationInformation);
        return $this;
    }

    public function addAllowanceOrCharge($allowanceCharge) {
        return $this->receipt->getInvoice()->addAllowanceCharge($allowanceCharge);
    }

    public function removeAllowanceOrChange($number) {
        $this->receipt->getInvoice()->removeAllowanceCharge($number);
        return $this;
    }

    /**
     * @param ConfigManager $configManager
     * @param string $key
     * @return string
     */
    private function validateConfigOption($configManager, $key) {
        if ($configManager->exists($key)) {
            return $configManager->getConfigValue($key);
        } else {
            throw new \Exception("Required config parameter ".$key." not supplied");
        }
    }

    /**
     * @param Tax $tax
     */
    private function configureTax($tax) {
        if ($tax->getDutyFeeTaxCategoryCode() == null) {
            $tax->setDutyFeeTaxCategoryCode($this->defaultTaxCategory);
        }
        if($tax->getDutyFeeTaxTypeCode() == null) {
            $tax->setDutyFeeTaxTypeCode($this->defaultTaxCode);
        }
        return $tax;
    }

    public function build()
    {
        $container = new DigitalReceiptContainer();
        $container->setDRxDigitalReceipt($this->receipt);
        return $container;
    }
}