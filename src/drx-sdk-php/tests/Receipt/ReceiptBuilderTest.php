<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Dreceiptx\Receipt;

require_once __DIR__ . "/../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__ . "/../../src/Receipt/DigitalReceiptContainer.php";
require_once __DIR__ . "/../../src/Receipt/DigitalReceiptBuilder.php";
require_once __DIR__ . "/../../src/Receipt/DRxDigitalReceipt.php";
require_once __DIR__ . "/../../src/Config/MapBasedConfigManager.php";
require_once __DIR__ . "/../../src/Config/ConfigKeys.php";
require_once __DIR__ . "/../../src/Receipt/Common/Country.php";
require_once __DIR__ . "/../../src/Receipt/Common/Language.php";
require_once __DIR__ . "/../../src/Receipt/Common/Currency.php";
require_once __DIR__ . "/../../src/Receipt/Common/ContactType.php";
require_once __DIR__ . "/../../src/Receipt/Tax/TaxCategory.php";
require_once __DIR__ . "/../../src/Receipt/Tax/TaxCode.php";


require_once __DIR__."/TestUtils.php";

use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\MapBasedConfigManager;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\Common\Address;
use Dreceiptx\Receipt\Common\Contact;
use Dreceiptx\Receipt\Common\ContactType;
use Dreceiptx\Receipt\Common\Country;
use Dreceiptx\Receipt\Common\Currency;
use Dreceiptx\Receipt\Common\Language;
use Dreceiptx\Receipt\Document\ReceiptContactType;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\Tax\TaxCategory;
use Dreceiptx\Receipt\Tax\TaxCode;

class ReceiptBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyBuilder() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());
        $recepit = $receiptBuilder->build();
        $this->assertNotNull($recepit->getStandardBusinessDocumentHeader());

        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }

    public function testSingleLineItem() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());
        $lineItem = LineItem::create("Test brand","Test item","Test description",5,100);
        $receiptBuilder->addLineItem($lineItem);
        $recepit = $receiptBuilder->build();

        $this->assertEquals(1, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }

    public function testSingleAllowance() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());
        $allowance = TestUtils::createAllowance(100, null);
        $receiptBuilder->addAllowanceOrCharge($allowance);
        $recepit = $receiptBuilder->build();

        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(1, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }

    public function testShippingInfo() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());
        $receiptBuilder->setDeliveryDate(new \DateTime("2017-12-12"));

        $address = new Address();
        $address->setCity("Sydney");
        $contact = Contact::create(ContactType::TELEPHONE, "+61 2 7123 4567");
        $receiptBuilder->setDeliveryAddress($address, $contact);

        $addressOrigin = new Address();
        $addressOrigin->setCity("Melbourne");
        $contactOrigin = Contact::create(ContactType::TELEPHONE, "+61 3 7245 6789");
        $receiptBuilder->setOriginAddress($addressOrigin, $contactOrigin);

        $recepit = $receiptBuilder->build();

        $this->assertEquals(new \DateTime("2017-12-12"), $recepit->getInvoice()->getDespatchInformation()->getEstimatedDeliveryDateTime());

        $this->assertEquals("Sydney", $recepit->getInvoice()->getShipTo()->getAddress()->getCity());
        $this->assertEquals(ContactType::TELEPHONE, $recepit->getInvoice()->getShipTo()->getContacts()[0]->getCommunicationChannelCode());
        $this->assertEquals("+61 2 7123 4567", $recepit->getInvoice()->getShipTo()->getContacts()[0]->getCommunicationValue());

        $this->assertEquals("Melbourne", $recepit->getInvoice()->getShipFrom()->getAddress()->getCity());
        $this->assertEquals(ContactType::TELEPHONE, $recepit->getInvoice()->getShipFrom()->getContacts()[0]->getCommunicationChannelCode());
        $this->assertEquals("+61 3 7245 6789", $recepit->getInvoice()->getShipFrom()->getContacts()[0]->getCommunicationValue());
    }

    public function testClientContacts() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());

        $receiptBuilder->addClientPurchasingContact("Purchasing name", "purchase@company.com", null);
        $receiptBuilder->addClientRecipientContact("Recipient name", "recipient@company.com", "+61 2 1234 5678");

        $recepit = $receiptBuilder->build();

        $this->assertEquals(2, count($recepit->getStandardBusinessDocumentHeader()->getReceiver()));

        $this->assertEquals("Purchasing name", $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[0]->getPersonName());
        $this->assertEquals(ReceiptContactType::PURCHASING_CONTACT, $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[0]->getContactTypeCode());
        $this->assertEquals(1, count($recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[0]->getCommunicationChannelCode()));
        $this->assertEquals(ContactType::EMAIL, $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[0]->getCommunicationChannelCode()[0]->getCommunicationChannelCode());
        $this->assertEquals("purchase@company.com", $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[0]->getCommunicationChannelCode()[0]->getCommunicationValue());

        $this->assertEquals("Recipient name", $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getPersonName());
        $this->assertEquals(ReceiptContactType::RECIPIENT_CONTACT, $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getContactTypeCode());
        $this->assertEquals(2, count($recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getCommunicationChannelCode()));
        $this->assertEquals(ContactType::EMAIL, $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getCommunicationChannelCode()[0]->getCommunicationChannelCode());
        $this->assertEquals("recipient@company.com", $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getCommunicationChannelCode()[0]->getCommunicationValue());
        $this->assertEquals(ContactType::TELEPHONE, $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getCommunicationChannelCode()[1]->getCommunicationChannelCode());
        $this->assertEquals("+61 2 1234 5678", $recepit->getStandardBusinessDocumentHeader()->getReceiver()[1]->getContactInformation()[1]->getCommunicationChannelCode()[1]->getCommunicationValue());
    }

    public function testRMSContacts() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());

        $receiptBuilder->addMerchantCustomerRelationsContact("Customer relations name", "custrel@company.com", null);
        $receiptBuilder->addMerchantDeliveryContact("Delivery name", "delivery@company.com", "+61 2 1234 5678");

        $recepit = $receiptBuilder->build();

        $this->assertEquals(1, count($recepit->getStandardBusinessDocumentHeader()->getSender()));

        $this->assertEquals("Customer relations name", $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[0]->getPersonName());
        $this->assertEquals(ReceiptContactType::CUSTOMER_RELATIONS, $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[0]->getContactTypeCode());
        $this->assertEquals(1, count($recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[0]->getCommunicationChannelCode()));
        $this->assertEquals(ContactType::EMAIL, $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[0]->getCommunicationChannelCode()[0]->getCommunicationChannelCode());
        $this->assertEquals("custrel@company.com", $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[0]->getCommunicationChannelCode()[0]->getCommunicationValue());

        $this->assertEquals("Delivery name", $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getPersonName());
        $this->assertEquals(ReceiptContactType::DELIVERY_CONTACT, $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getContactTypeCode());
        $this->assertEquals(2, count($recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getCommunicationChannelCode()));
        $this->assertEquals(ContactType::EMAIL, $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getCommunicationChannelCode()[0]->getCommunicationChannelCode());
        $this->assertEquals("delivery@company.com", $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getCommunicationChannelCode()[0]->getCommunicationValue());
        $this->assertEquals(ContactType::TELEPHONE, $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getCommunicationChannelCode()[1]->getCommunicationChannelCode());
        $this->assertEquals("+61 2 1234 5678", $recepit->getStandardBusinessDocumentHeader()->getSender()[0]->getContactInformation()[1]->getCommunicationChannelCode()[1]->getCommunicationValue());
    }

    public function testOtherSetters() {
        $receiptBuilder = new DigitalReceiptBuilder($this->createTestConfig());
        $receiptBuilder->setMerchantGLN("Some merchant gln");
        $receiptBuilder->setUserGUID("Some user guid type","Some user guid");
        $receiptBuilder->setMerchatReference("Some merchant reference");
        $receiptBuilder->setReceiptDateTime(new \DateTime("2017-12-01"));
        $receiptBuilder->setPurchaseOrderNumber("Some purchase order number");
        $receiptBuilder->setCustomerReferenceNumber("Some customer reference number");
        $receiptBuilder->setBillingInformation("Some billing name", TaxCode::CoffeeTax, "Some tax registration id");
        $receiptBuilder->setSalesOrderReference("Some sales order reference");
        $receiptBuilder->setReceiptNumber("Some receipt number");

        $recepit = $receiptBuilder->build();

        $this->assertEquals("Some merchant gln", $recepit->getStandardBusinessDocumentHeader()->getMerchantGLN());
        $this->assertEquals("Some user guid type:Some user guid", $recepit->getStandardBusinessDocumentHeader()->getUserIdentifier());
        $this->assertEquals("Some merchant reference", $recepit->getStandardBusinessDocumentHeader()->getDocumentIdentification()->getInstanceIdentifier());
        $this->assertEquals(new \DateTime("2017-12-01"), $recepit->getInvoice()->getCreationDateTime());
        $this->assertEquals("Some purchase order number", $recepit->getInvoice()->getPurchaseOrder()->getEntityIdentification());
        $this->assertEquals("Some customer reference number", $recepit->getInvoice()->getCustomerReference()->getEntityIdentification());
        $this->assertEquals("Some billing name", $recepit->getInvoice()->getBillTo()->getOrganisationDetails()->getOrganisationName());
        $this->assertEquals(TaxCode::CoffeeTax, $recepit->getInvoice()->getBillTo()->getDutyFeeTaxRegistration()->getDutyFeeTaxTypeCode());
        $this->assertEquals("Some tax registration id", $recepit->getInvoice()->getBillTo()->getDutyFeeTaxRegistration()->getDutyFeeTaxRegistationID());
        $this->assertEquals("Some sales order reference", $recepit->getInvoice()->getSalesOrder()->getEntityIdentification());
        $this->assertEquals("Some receipt number", $recepit->getInvoice()->getInvoiceIdentification()->getEntityIdentification());
    }


    /**
     * @return MapBasedConfigManager
     */
    private function createTestConfig() {
        $config = new MapBasedConfigManager();
        $config->setConfigValue(ConfigKeys::DefaultCountry, Country::Australia);
        $config->setConfigValue(ConfigKeys::DefaultLanguage, Language::English);
        $config->setConfigValue(ConfigKeys::DefaultCurrency, Currency::AustralianDollar);
        $config->setConfigValue(ConfigKeys::DefaultTaxCategory, TaxCategory::APPLICABLE);
        $config->setConfigValue(ConfigKeys::DefaultTaxCode, TaxCode::GoodsAndServicesTax);
        return $config;
    }
}