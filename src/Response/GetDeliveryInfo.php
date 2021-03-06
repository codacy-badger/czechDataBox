<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Tomas Kulhanek
 * Email: info@tirus.cz
 */

namespace HelpPC\CzechDataBox\Response;


use HelpPC\CzechDataBox\Entity\Delivery;
use HelpPC\CzechDataBox\IResponse;
use HelpPC\CzechDataBox\Traits\DataMessageStatus;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class GetDeliveryInfo
 * @package HelpPC\CzechDataBox\Response
 * @Serializer\XmlNamespace(uri="http://isds.czechpoint.cz/v20",prefix="p")
 * @Serializer\XmlRoot(name="p:GetDeliveryInfoResponse", namespace="http://isds.czechpoint.cz/v20")
 */
class GetDeliveryInfo implements IResponse
{

    use DataMessageStatus;
    /**
     * @var Delivery
     * @Serializer\Type("HelpPC\CzechDataBox\Entity\Delivery")
     * @Serializer\SerializedName("p:dmDelivery")
     * @Serializer\SkipWhenEmpty()
     * @Serializer\XmlElement(cdata=false)
     */
    protected $delivery;

    /**
     * @return Delivery
     */
    public function getDelivery(): Delivery
    {
        return $this->delivery;
    }

}