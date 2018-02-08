<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-08
 * Time: 07:08
 */

namespace \Dreceiptx\Receipt\LineItem\Accomodation;

class GroundTransportType
{
    const standard = "GTP0000";
    const taxi = "GTP0001";
    const waterTaxi = "GTP0002";
    const rideSharing = "GTP0010";
    const carPooling = "GTP0011";
    const carRental = "GTP0012";
    const privateCarRental = "GTP0013";
    const train = "GTP0020";
    const metroTrain = "GTP0021";
    const nationalTrain = "GTP0022";
    const internationalTrain = "GTP0023";
    const tramOrLightRail = "GTP0024";
    const bus = "GTP0030";
    const shuttleBus = "GTP0031";
    const metroBus = "GTP0032";
    const nationalBus = "GTP0033";
    const internationalBus = "GTP0034";
    const ferry = "GTP0040";
}