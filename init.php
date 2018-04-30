<?php

require_once(dirname(__FILE__) . '/lib/API.php');
require_once(dirname(__FILE__) . '/lib/Collection.php');
require_once(dirname(__FILE__) . '/lib/ResourceBase.php');
require_once(dirname(__FILE__) . '/lib/ListOnlyResource.php');
require_once(dirname(__FILE__) . '/lib/SingleResource.php');
require_once(dirname(__FILE__) . '/lib/ReadOnlyResource.php');

// Utilities
require_once(dirname(__FILE__) . '/lib/Utils.php');

// HTTP Client
require_once(dirname(__FILE__) . '/lib/CURLClient.php');

// Errors
require_once(dirname(__FILE__) . '/lib/Error/APIException.php');
require_once(dirname(__FILE__) . '/lib/Error/APIError.php');
require_once(dirname(__FILE__) . '/lib/Error/APIConnectionError.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidAPIKeyError.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidAccountError.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidPropertyException.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidRequestError.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidRequestParametersError.php');
require_once(dirname(__FILE__) . '/lib/Error/InvalidResourceError.php');
require_once(dirname(__FILE__) . '/lib/Error/JSONDecodingError.php');
require_once(dirname(__FILE__) . '/lib/Error/JSONEncodingError.php');
require_once(dirname(__FILE__) . '/lib/Error/MethodNotSupportedError.php');
require_once(dirname(__FILE__) . '/lib/Error/MissingResponseError.php');
require_once(dirname(__FILE__) . '/lib/Error/ResourceCreateError.php');
require_once(dirname(__FILE__) . '/lib/Error/ResourceNotFoundError.php');
require_once(dirname(__FILE__) . '/lib/Error/UndefinedAPIKeyError.php');
require_once(dirname(__FILE__) . '/lib/Error/UndefinedCURLClientError.php');
require_once(dirname(__FILE__) . '/lib/Error/UndefinedRequestParametersError.php');
require_once(dirname(__FILE__) . '/lib/Error/UndefinedResponseError.php');

// AdButler API Resources
require_once(dirname(__FILE__) . '/lib/Resource/Advertiser.php');
require_once(dirname(__FILE__) . '/lib/Resource/Banner.php');
require_once(dirname(__FILE__) . '/lib/Resource/BannerCampaign.php');
require_once(dirname(__FILE__) . '/lib/Resource/BannerZone.php');
require_once(dirname(__FILE__) . '/lib/Resource/Bidder.php');
require_once(dirname(__FILE__) . '/lib/Resource/CampaignAssignment.php');
require_once(dirname(__FILE__) . '/lib/Resource/Channel.php');
require_once(dirname(__FILE__) . '/lib/Resource/Creative.php');
require_once(dirname(__FILE__) . '/lib/Resource/CreativeSingleResource.php');
require_once(dirname(__FILE__) . '/lib/Resource/CustomHTMLBanner.php');
require_once(dirname(__FILE__) . '/lib/Resource/CustomHTMLPopup.php');
require_once(dirname(__FILE__) . '/lib/Resource/EmailZone.php');
require_once(dirname(__FILE__) . '/lib/Resource/FlashBanner.php');
require_once(dirname(__FILE__) . '/lib/Resource/FlashCreative.php');
require_once(dirname(__FILE__) . '/lib/Resource/FlashPopup.php');
require_once(dirname(__FILE__) . '/lib/Resource/GeoTarget.php');
require_once(dirname(__FILE__) . '/lib/Resource/ISPTarget.php');
require_once(dirname(__FILE__) . '/lib/Resource/ImageBanner.php');
require_once(dirname(__FILE__) . '/lib/Resource/ImageCreative.php');
require_once(dirname(__FILE__) . '/lib/Resource/ImagePopup.php');
require_once(dirname(__FILE__) . '/lib/Resource/Manager.php');
require_once(dirname(__FILE__) . '/lib/Resource/MediaGroup.php');
require_once(dirname(__FILE__) . '/lib/Resource/Placement.php');
require_once(dirname(__FILE__) . '/lib/Resource/PlatformTarget.php');
require_once(dirname(__FILE__) . '/lib/Resource/Publisher.php');
require_once(dirname(__FILE__) . '/lib/Resource/Report.php');
require_once(dirname(__FILE__) . '/lib/Resource/RichMediaBanner.php');
require_once(dirname(__FILE__) . '/lib/Resource/RichMediaCreative.php');
require_once(dirname(__FILE__) . '/lib/Resource/Schedule.php');
require_once(dirname(__FILE__) . '/lib/Resource/Stats.php');
require_once(dirname(__FILE__) . '/lib/Resource/TextAd.php');
require_once(dirname(__FILE__) . '/lib/Resource/TextAdCampaign.php');
require_once(dirname(__FILE__) . '/lib/Resource/TextZone.php');
require_once(dirname(__FILE__) . '/lib/Resource/VideoCreative.php');
require_once(dirname(__FILE__) . '/lib/Resource/Zone.php');
require_once(dirname(__FILE__) . '/lib/Resource/ZoneTag.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTCampaign.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTZone.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTChannel.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTChannelZoneAssignment.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTBanner.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTCompanion.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTMedia.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTSchedule.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTPlacement.php');
require_once(dirname(__FILE__) . '/lib/Resource/VASTTracking.php');





