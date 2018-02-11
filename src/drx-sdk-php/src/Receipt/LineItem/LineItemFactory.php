<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-11
 * Time: 10:02
 */

use Dreceiptx\Receipt\LineItem\Construction\MaterialGeneric;

require_once __DIR__."/Construction/MaterialGeneric.php";
require_once __DIR__."/Accomodation/Accomodation.php";
require_once __DIR__."/Accomodation/Flight.php";
require_once __DIR__."/Accomodation/GroundTransport.php";
class LineItemFactory
{
    /**
     * @param LineItem $lineItem
     */
    public static function getTypedLineItem($lineItem) {
        switch ($lineItem->getTradeItemType()) {
            case MaterialGeneric::LINE_ITEM_TYPE_IDENTIFIER:
                return MaterialGeneric::createFromLineItem($lineItem);
            case Dreceiptx\Receipt\LineItem\Accomodation\Accomodation::LINE_ITEM_TYPE_IDENTIFIER:
                return \Dreceiptx\Receipt\LineItem\Accomodation\Accomodation::createFromLineItem($lineItem);
            case \Dreceiptx\Receipt\LineItem\Accomodation\Flight::LINE_ITEM_TYPE_IDENTIFIER:
                return \Dreceiptx\Receipt\LineItem\Accomodation\Flight::createFromLineItem($lineItem);
            case \Dreceiptx\Receipt\LineItem\Accomodation\GroundTransport::LINE_ITEM_TYPE_IDENTIFIER:
                return \Dreceiptx\Receipt\LineItem\Accomodation\GroundTransport::createFromLineItem($lineItem);
        }
        return $lineItem;
    }


}