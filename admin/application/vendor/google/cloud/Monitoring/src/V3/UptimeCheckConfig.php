<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/monitoring/v3/uptime.proto

namespace Google\Cloud\Monitoring\V3;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * This message configures which resources and services to monitor for
 * availability.
 *
 * Generated from protobuf message <code>google.monitoring.v3.UptimeCheckConfig</code>
 */
class UptimeCheckConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * A unique resource name for this UptimeCheckConfig. The format is:
     *   `projects/[PROJECT_ID]/uptimeCheckConfigs/[UPTIME_CHECK_ID]`.
     * This field should be omitted when creating the uptime check configuration;
     * on create, the resource name is assigned by the server and included in the
     * response.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * A human-friendly name for the uptime check configuration. The display name
     * should be unique within a Stackdriver Account in order to make it easier
     * to identify; however, uniqueness is not enforced. Required.
     *
     * Generated from protobuf field <code>string display_name = 2;</code>
     */
    private $display_name = '';
    /**
     * How often the uptime check is performed.
     * Currently, only 1, 5, 10, and 15 minutes are supported. Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration period = 7;</code>
     */
    private $period = null;
    /**
     * The maximum amount of time to wait for the request to complete (must be
     * between 1 and 60 seconds). Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration timeout = 8;</code>
     */
    private $timeout = null;
    /**
     * The expected content on the page the check is run against.
     * Currently, only the first entry in the list is supported, and other entries
     * will be ignored. The server will look for an exact match of the string in
     * the page response's content. This field is optional and should only be
     * specified if a content match is required.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.ContentMatcher content_matchers = 9;</code>
     */
    private $content_matchers;
    /**
     * The list of regions from which the check will be run.
     * If this field is specified, enough regions to include a minimum of
     * 3 locations must be provided, or an error message is returned.
     * Not specifying this field will result in uptime checks running from all
     * regions.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckRegion selected_regions = 10;</code>
     */
    private $selected_regions;
    /**
     * The internal checkers that this check will egress from.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.InternalChecker internal_checkers = 14;</code>
     */
    private $internal_checkers;
    protected $resource;
    protected $check_request_type;

    public function __construct() {
        \GPBMetadata\Google\Monitoring\V3\Uptime::initOnce();
        parent::__construct();
    }

    /**
     * A unique resource name for this UptimeCheckConfig. The format is:
     *   `projects/[PROJECT_ID]/uptimeCheckConfigs/[UPTIME_CHECK_ID]`.
     * This field should be omitted when creating the uptime check configuration;
     * on create, the resource name is assigned by the server and included in the
     * response.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * A unique resource name for this UptimeCheckConfig. The format is:
     *   `projects/[PROJECT_ID]/uptimeCheckConfigs/[UPTIME_CHECK_ID]`.
     * This field should be omitted when creating the uptime check configuration;
     * on create, the resource name is assigned by the server and included in the
     * response.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * A human-friendly name for the uptime check configuration. The display name
     * should be unique within a Stackdriver Account in order to make it easier
     * to identify; however, uniqueness is not enforced. Required.
     *
     * Generated from protobuf field <code>string display_name = 2;</code>
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * A human-friendly name for the uptime check configuration. The display name
     * should be unique within a Stackdriver Account in order to make it easier
     * to identify; however, uniqueness is not enforced. Required.
     *
     * Generated from protobuf field <code>string display_name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setDisplayName($var)
    {
        GPBUtil::checkString($var, True);
        $this->display_name = $var;

        return $this;
    }

    /**
     * The monitored resource associated with the configuration.
     *
     * Generated from protobuf field <code>.google.api.MonitoredResource monitored_resource = 3;</code>
     * @return \Google\Api\MonitoredResource
     */
    public function getMonitoredResource()
    {
        return $this->readOneof(3);
    }

    /**
     * The monitored resource associated with the configuration.
     *
     * Generated from protobuf field <code>.google.api.MonitoredResource monitored_resource = 3;</code>
     * @param \Google\Api\MonitoredResource $var
     * @return $this
     */
    public function setMonitoredResource($var)
    {
        GPBUtil::checkMessage($var, \Google\Api\MonitoredResource::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * The group resource associated with the configuration.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.ResourceGroup resource_group = 4;</code>
     * @return \Google\Cloud\Monitoring\V3\UptimeCheckConfig_ResourceGroup
     */
    public function getResourceGroup()
    {
        return $this->readOneof(4);
    }

    /**
     * The group resource associated with the configuration.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.ResourceGroup resource_group = 4;</code>
     * @param \Google\Cloud\Monitoring\V3\UptimeCheckConfig_ResourceGroup $var
     * @return $this
     */
    public function setResourceGroup($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Monitoring\V3\UptimeCheckConfig_ResourceGroup::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Contains information needed to make an HTTP or HTTPS check.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.HttpCheck http_check = 5;</code>
     * @return \Google\Cloud\Monitoring\V3\UptimeCheckConfig_HttpCheck
     */
    public function getHttpCheck()
    {
        return $this->readOneof(5);
    }

    /**
     * Contains information needed to make an HTTP or HTTPS check.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.HttpCheck http_check = 5;</code>
     * @param \Google\Cloud\Monitoring\V3\UptimeCheckConfig_HttpCheck $var
     * @return $this
     */
    public function setHttpCheck($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Monitoring\V3\UptimeCheckConfig_HttpCheck::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * Contains information needed to make a TCP check.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.TcpCheck tcp_check = 6;</code>
     * @return \Google\Cloud\Monitoring\V3\UptimeCheckConfig_TcpCheck
     */
    public function getTcpCheck()
    {
        return $this->readOneof(6);
    }

    /**
     * Contains information needed to make a TCP check.
     *
     * Generated from protobuf field <code>.google.monitoring.v3.UptimeCheckConfig.TcpCheck tcp_check = 6;</code>
     * @param \Google\Cloud\Monitoring\V3\UptimeCheckConfig_TcpCheck $var
     * @return $this
     */
    public function setTcpCheck($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Monitoring\V3\UptimeCheckConfig_TcpCheck::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * How often the uptime check is performed.
     * Currently, only 1, 5, 10, and 15 minutes are supported. Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration period = 7;</code>
     * @return \Google\Protobuf\Duration
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * How often the uptime check is performed.
     * Currently, only 1, 5, 10, and 15 minutes are supported. Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration period = 7;</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setPeriod($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->period = $var;

        return $this;
    }

    /**
     * The maximum amount of time to wait for the request to complete (must be
     * between 1 and 60 seconds). Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration timeout = 8;</code>
     * @return \Google\Protobuf\Duration
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * The maximum amount of time to wait for the request to complete (must be
     * between 1 and 60 seconds). Required.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration timeout = 8;</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setTimeout($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->timeout = $var;

        return $this;
    }

    /**
     * The expected content on the page the check is run against.
     * Currently, only the first entry in the list is supported, and other entries
     * will be ignored. The server will look for an exact match of the string in
     * the page response's content. This field is optional and should only be
     * specified if a content match is required.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.ContentMatcher content_matchers = 9;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getContentMatchers()
    {
        return $this->content_matchers;
    }

    /**
     * The expected content on the page the check is run against.
     * Currently, only the first entry in the list is supported, and other entries
     * will be ignored. The server will look for an exact match of the string in
     * the page response's content. This field is optional and should only be
     * specified if a content match is required.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.ContentMatcher content_matchers = 9;</code>
     * @param \Google\Cloud\Monitoring\V3\UptimeCheckConfig_ContentMatcher[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setContentMatchers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Monitoring\V3\UptimeCheckConfig_ContentMatcher::class);
        $this->content_matchers = $arr;

        return $this;
    }

    /**
     * The list of regions from which the check will be run.
     * If this field is specified, enough regions to include a minimum of
     * 3 locations must be provided, or an error message is returned.
     * Not specifying this field will result in uptime checks running from all
     * regions.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckRegion selected_regions = 10;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getSelectedRegions()
    {
        return $this->selected_regions;
    }

    /**
     * The list of regions from which the check will be run.
     * If this field is specified, enough regions to include a minimum of
     * 3 locations must be provided, or an error message is returned.
     * Not specifying this field will result in uptime checks running from all
     * regions.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckRegion selected_regions = 10;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setSelectedRegions($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::ENUM, \Google\Cloud\Monitoring\V3\UptimeCheckRegion::class);
        $this->selected_regions = $arr;

        return $this;
    }

    /**
     * The internal checkers that this check will egress from.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.InternalChecker internal_checkers = 14;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getInternalCheckers()
    {
        return $this->internal_checkers;
    }

    /**
     * The internal checkers that this check will egress from.
     *
     * Generated from protobuf field <code>repeated .google.monitoring.v3.UptimeCheckConfig.InternalChecker internal_checkers = 14;</code>
     * @param \Google\Cloud\Monitoring\V3\UptimeCheckConfig_InternalChecker[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setInternalCheckers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Monitoring\V3\UptimeCheckConfig_InternalChecker::class);
        $this->internal_checkers = $arr;

        return $this;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return $this->whichOneof("resource");
    }

    /**
     * @return string
     */
    public function getCheckRequestType()
    {
        return $this->whichOneof("check_request_type");
    }

}
