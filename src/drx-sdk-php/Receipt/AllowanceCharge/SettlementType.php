<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-15
 * Time: 07:40
 */

namespace Dreceiptx\Receipt\AllowanceCharge;


class SettlementType
{
    const DeliveryFee = "ADZ";
    const FreightFee = "FC";
    const TIP = "TIP";
    const PackagingFee = "PC";
    const GeneralDiscount = "DI";
    const MultiBuyDiscount = "MB";
    const ProcessingFee = "FI";
    const BookingFee = "BOK";
    const ServiceFee = "SER";
    const AdminFee = "AEM";
    const AmendmentFee = "AJ";
    const HandlingFee = "HD";
    const ReturnOrCancellationFee = "AAB";
}