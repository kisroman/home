<?php

namespace LovelySpace\Model\Earning;

use ClassCreator;
use Framework\Db\Connection;
use LovelySpace\Model\Arrival\ArrivalItem;
use LovelySpace\Model\Arrival\ArrivalItemRepository;
use LovelySpace\Model\Arrival\ArrivalRepository;
use LovelySpace\Model\Order\OrderItem;
use LovelySpace\Model\Order\OrderItemRepository;

class EarningRepository
{
    public function getList()
    {
        /** @var ArrivalRepository $arrivalRepository */
        $arrivalRepository = ClassCreator::get(ArrivalRepository::class);
        $arrivals = $arrivalRepository->getList();

        /** @var ArrivalItemRepository $arrivalItemRepository */
        $arrivalItemRepository = ClassCreator::get(ArrivalItemRepository::class);
        $arrivalItems = $arrivalItemRepository->getList();

        /** @var OrderItemRepository $orderItemRepository */
        $orderItemRepository = ClassCreator::get(OrderItemRepository::class);
        $orderItems = $orderItemRepository->getList();

        $reportArrivals = [];

        /** @var ArrivalItem $arrivalItem */
        foreach ($arrivalItems as $arrivalItem) {
            $arrival = isset($arrivals[$arrivalItem->getArrivalId()])
                ? $arrivals[$arrivalItem->getArrivalId()]
                : $arrivalItem->getArrival();

            $cost = $arrivalItem->getCost();
            if (isset($reportArrivals[$arrivalItem->getProductId()][$arrival->getDate()][$cost])
            ) {
                $qty = $reportArrivals[$arrivalItem->getProductId()][$arrival->getDate()][$cost];
                $reportArrivals[$arrivalItem->getProductId()][$arrival->getDate()][$cost] = $arrivalItem->getQty() + $qty;
            } else {
                $reportArrivals[$arrivalItem->getProductId()][$arrival->getDate()][$cost]
                    = $arrivalItem->getQty();
            }
        }

        //sorting by date
        foreach ($reportArrivals as $productId => $reportArrival) {
            ksort($reportArrival);
            $reportArrivals[$productId] = $reportArrival;
        }

        $reportOrders = [];
        /** @var OrderItem $orderItem */
        foreach ($orderItems as $orderItem) {
            if (isset($reportArrivals[$orderItem->getProductId()])) {
                $arrivalItemsByDate = $reportArrivals[$orderItem->getProductId()];

                foreach ($arrivalItemsByDate as $date => $arrivalItemByDate) {
                    foreach ($arrivalItemByDate as $cost => $qty) {
                        $reportOrders[$orderItem->getId()] = $orderItem->getPrice() - $cost;
                        $qty--;
                        if ($qty == 0) {
                            unset($reportArrivals[$orderItem->getProductId()][$date][$cost]);
                            if (!$reportArrivals[$orderItem->getProductId()][$date]) {
                                unset($reportArrivals[$orderItem->getProductId()][$date]);
                            }
                        } else {
                            $reportArrivals[$orderItem->getProductId()][$date][$cost] = $qty;
                        }
                        break;
                    }
                    break;
                }
            }
        }

        return $reportOrders;
    }
}