<?php
require_once('code/Framework/DataObject.php');
require_once('code/LovelySpace/Model/Resource/AbstractModel.php');
require_once('code/LovelySpace/Model/AbstractModel.php');

//delete shipping field
/** @var \Framework\Db\Connection $connection */

use LovelySpace\Model\Arrival\ArrivalItemRepository;
use LovelySpace\Model\Arrival\ArrivalRepository;

$connection = \ClassCreator::get(\Framework\Db\Connection::class);

/** @var  $arrivalRepository ArrivalRepository*/
$arrivalRepository = \ClassCreator::get(ArrivalRepository::class);

/** @var ArrivalItemRepository $arrivalItemRepository */
$arrivalItemRepository = \ClassCreator::get(ArrivalItemRepository::class);

$arrivals = $arrivalRepository->getList();

$shippingPerArrival = [];
/** @var \LovelySpace\Model\Arrival\Arrival $arrival */
foreach ($arrivals as $arrival) {
    $qties = 0;
    $shipping =  $arrival->getShipment();
    $itemsByArrivalId = $arrivalItemRepository->getListByArrivalId($arrival->getId());

    /** @var \LovelySpace\Model\Arrival\ArrivalItem $item */
    foreach ($itemsByArrivalId as $item) {
        $qties += $item->getQty();
    }

    $shipmentPiece = ceil($shipping/$qties);

    $costs = 0;
    if ($shipmentPiece > 0) {
        foreach ($itemsByArrivalId as $item) {
            $item->setCost($item->getCost() + $shipmentPiece);
            $item->save();

            $costs += $item->getCost() * $item->getQty();
        }
        $arrival->setTotal($costs);
        $arrival->save();
    }
}
