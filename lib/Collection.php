<?php

namespace AdButler;

use AdButler\Error\InvalidPropertyException;

/**
 * @property-read string  object
 * @property-read boolean has_more
 * @property-read int     limit
 * @property-read int     offset
 * @property-read string  url
 */
class Collection
{
    protected $data = array();

    public static $objectTypeToClassNameMap = array(
        'advertiser'          		=> 'AdButler\Advertiser',
        'geo_target'          		=> 'AdButler\GeoTarget',
        'image_creative'      		=> 'AdButler\ImageCreative',
        'flash_creative'      		=> 'AdButler\FlashCreative',
        'video_creative'      		=> 'AdButler\VideoCreative',
        'rich_media_creative' 		=> 'AdButler\RichMediaCreative',
        'banner_campaign'     		=> 'AdButler\BannerCampaign',
        'text_campaign'       		=> 'AdButler\TextAdCampaign',
        'image_banner'        		=> 'AdButler\ImageBanner',
        'flash_banner'        		=> 'AdButler\FlashBanner',
        'custom_html_banner'  		=> 'AdButler\CustomHTMLBanner',
        'rich_media_banner'   		=> 'AdButler\RichMediaBanner',
        'channel'             		=> 'AdButler\Channel',
        'isp_target'          		=> 'AdButler\ISPTarget',
        'manager'             		=> 'AdButler\Manager',
        'media_group'         		=> 'AdButler\MediaGroup',
        'placement'           		=> 'AdButler\Placement',
        'platform_target'     		=> 'AdButler\PlatformTarget',
        'image_popup'         		=> 'AdButler\ImagePopup',
        'flash_popup'         		=> 'AdButler\FlashPopup',
        'custom_html_popup'   		=> 'AdButler\CustomHTMLPopup',
        //'popups/text-ads'     	=> 'AdButler\TextAdPopup',
        'publisher'           		=> 'AdButler\Publisher',
        'schedule'            		=> 'AdButler\Schedule',
        'text_ad'             		=> 'AdButler\TextAd',
        'banner_zone'         		=> 'AdButler\BannerZone',
        'email_zone'          		=> 'AdButler\EmailZone',
        'text_zone'           		=> 'AdButler\TextZone',
        'campaign_assignment' 		=> 'AdButler\CampaignAssignment',
        'bidder'              		=> 'AdButler\Bidder',
		'channel_zone_assignment' 	=> 'AdButler\ChannelZoneAssignment',
		'vast_campaign'				=> 'AdButler\VASTCampaign',
		'vast_zone'					=> 'AdButler\VASTZone',
		'vast_channel'				=> 'AdButler\VASTChannel',
		'vast_channel_zone_assignments'	=> 'AdButler\VASTChannelZoneAssignment',
		'vast_banner'				=> 'AdButler\VASTBanner',
		'vast_companion'			=> 'AdButler\VASTCompanion',
		'vast_media'				=> 'AdButler\VASTMedia',
		'vast_schedule'				=> 'AdButler\VASTSchedule',
		'vast_placement'			=> 'AdButler\VASTPlacement',
		'vast_tracking'				=> 'AdButler\VASTTracking',
    );

    /**
     * Use this method when instantiating from a data array.
     * @param null $data
     * @param bool $asArray
     *
     * @return Collection|array
     */
    public static function instantiate($data = null, $asArray = false) {
        $self = $asArray ? array() : new self();
        if (!empty($data)) {
            // instantiate each item in the data array as advertiser object
            $collection = array();
            foreach ($data['data'] as $itemData) {
                // TODO: instantiate the appropriate class
                $type = $itemData['object'];
                $class = self::$objectTypeToClassNameMap[$type];
                $collection[] = new $class($itemData);
            }
            $data['data'] = $collection;
            if ($asArray) {
                $self = $data['data'];
            } else {
                $self->data = $data;
            }
        }
        return $self;
    }

    public function getData() {
        return $this->data['data'];
    }

    public function setData( $data ) {
        $this->data['data'] = $data;
        return $this;
    }

    public function toJSON() {
        return Utils\toJSON( $this->data, 4, \API::getIndentation() );
    }

    public function __toString() {
        $serializedData = "";

        foreach( $this->data['data'] as $resourceObj) {
            $serializedData .= $serializedData == "" ? "" : ",\n";
            $serializedData .= $resourceObj;
        }
        $serializedData = Utils\str_indent(API::getIndentation()*2, $serializedData); // indent lines by 2 times the API::$indentation value
        unset($this->data['data']);

        $collectionSerialized = get_class($this) . ' JSON: ' . Utils\toJSON( $this->data, 4, API::getIndentation() );
        $baseIndent = str_repeat(' ', API::getIndentation());
        $collectionSerialized = substr($collectionSerialized, 0, -2) . ",\n$baseIndent\"data\" : [\n$serializedData\n$baseIndent]\n}";

        return $collectionSerialized;
    }
    
    public function __get($field) {
        $properties = array('object', 'has_more', 'limit', 'offset', 'url', 'data');
        if ( in_array($field, $properties) ) {
            return $this->data[$field];
        } else {
            throw new InvalidPropertyException(array(
                'object'  => 'error',
                'type'    => 'invalid_property_exception',
                'status'  => 400,
                'message' => "Invalid Property $field. Collection object only supports these properties: " . join(', ', $properties) . ".\n",
            ));
        }
    }
    
}