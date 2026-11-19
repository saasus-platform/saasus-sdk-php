<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class BasicInfo extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Domain Name
     *
     * @var string|null
     */
    protected $domainName;
    /**
     * DNS Record Verification Results
     *
     * @var bool|null
     */
    protected $isDnsValidated;
    /**
     * Domain setup status. Pending means validation or configuration is in progress; action_required means user action is needed; completed means configuration has been accepted.
     *
     * @var string|null
     */
    protected $domainSetupStatus;
    /**
     * Reason domain setup is incomplete. Omitted when no known reason is available. DNS validation may still be pending while records propagate. Failed or timed-out certificate requests require resubmitting the domain settings after correcting DNS.
     *
     * @var string|null
     */
    protected $domainSetupReasonCode;
    /**
     * 
     *
     * @var DnsRecord|null
     */
    protected $certificateDnsRecord;
    /**
     * 
     *
     * @var DnsRecord|null
     */
    protected $cloudFrontDnsRecord;
    /**
     * DKIM DNS Records
     *
     * @var list<DnsRecord>|null
     */
    protected $dkimDnsRecords;
    /**
     * Default Domain Name
     *
     * @var string|null
     */
    protected $defaultDomainName;
    /**
     * Sender Email for Authentication Email
     *
     * @var string|null
     */
    protected $fromEmailAddress;
    /**
     * Reply-from email address of authentication email
     *
     * @var string|null
     */
    protected $replyEmailAddress;
    /**
     * SES sandbox release and Cognito SES configuration results
     *
     * @var bool|null
     */
    protected $isSesSandboxGranted;
    /**
     * Domain Name
     *
     * @return string|null
     */
    public function getDomainName() : ?string
    {
        return $this->domainName;
    }
    /**
     * Domain Name
     *
     * @param string|null $domainName
     *
     * @return self
     */
    public function setDomainName(?string $domainName) : self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
    /**
     * DNS Record Verification Results
     *
     * @return bool|null
     */
    public function getIsDnsValidated() : ?bool
    {
        return $this->isDnsValidated;
    }
    /**
     * DNS Record Verification Results
     *
     * @param bool|null $isDnsValidated
     *
     * @return self
     */
    public function setIsDnsValidated(?bool $isDnsValidated) : self
    {
        $this->initialized['isDnsValidated'] = true;
        $this->isDnsValidated = $isDnsValidated;
        return $this;
    }
    /**
     * Domain setup status. Pending means validation or configuration is in progress; action_required means user action is needed; completed means configuration has been accepted.
     *
     * @return string|null
     */
    public function getDomainSetupStatus() : ?string
    {
        return $this->domainSetupStatus;
    }
    /**
     * Domain setup status. Pending means validation or configuration is in progress; action_required means user action is needed; completed means configuration has been accepted.
     *
     * @param string|null $domainSetupStatus
     *
     * @return self
     */
    public function setDomainSetupStatus(?string $domainSetupStatus) : self
    {
        $this->initialized['domainSetupStatus'] = true;
        $this->domainSetupStatus = $domainSetupStatus;
        return $this;
    }
    /**
     * Reason domain setup is incomplete. Omitted when no known reason is available. DNS validation may still be pending while records propagate. Failed or timed-out certificate requests require resubmitting the domain settings after correcting DNS.
     *
     * @return string|null
     */
    public function getDomainSetupReasonCode() : ?string
    {
        return $this->domainSetupReasonCode;
    }
    /**
     * Reason domain setup is incomplete. Omitted when no known reason is available. DNS validation may still be pending while records propagate. Failed or timed-out certificate requests require resubmitting the domain settings after correcting DNS.
     *
     * @param string|null $domainSetupReasonCode
     *
     * @return self
     */
    public function setDomainSetupReasonCode(?string $domainSetupReasonCode) : self
    {
        $this->initialized['domainSetupReasonCode'] = true;
        $this->domainSetupReasonCode = $domainSetupReasonCode;
        return $this;
    }
    /**
     * 
     *
     * @return DnsRecord|null
     */
    public function getCertificateDnsRecord() : ?DnsRecord
    {
        return $this->certificateDnsRecord;
    }
    /**
     * 
     *
     * @param DnsRecord|null $certificateDnsRecord
     *
     * @return self
     */
    public function setCertificateDnsRecord(?DnsRecord $certificateDnsRecord) : self
    {
        $this->initialized['certificateDnsRecord'] = true;
        $this->certificateDnsRecord = $certificateDnsRecord;
        return $this;
    }
    /**
     * 
     *
     * @return DnsRecord|null
     */
    public function getCloudFrontDnsRecord() : ?DnsRecord
    {
        return $this->cloudFrontDnsRecord;
    }
    /**
     * 
     *
     * @param DnsRecord|null $cloudFrontDnsRecord
     *
     * @return self
     */
    public function setCloudFrontDnsRecord(?DnsRecord $cloudFrontDnsRecord) : self
    {
        $this->initialized['cloudFrontDnsRecord'] = true;
        $this->cloudFrontDnsRecord = $cloudFrontDnsRecord;
        return $this;
    }
    /**
     * DKIM DNS Records
     *
     * @return list<DnsRecord>|null
     */
    public function getDkimDnsRecords() : ?array
    {
        return $this->dkimDnsRecords;
    }
    /**
     * DKIM DNS Records
     *
     * @param list<DnsRecord>|null $dkimDnsRecords
     *
     * @return self
     */
    public function setDkimDnsRecords(?array $dkimDnsRecords) : self
    {
        $this->initialized['dkimDnsRecords'] = true;
        $this->dkimDnsRecords = $dkimDnsRecords;
        return $this;
    }
    /**
     * Default Domain Name
     *
     * @return string|null
     */
    public function getDefaultDomainName() : ?string
    {
        return $this->defaultDomainName;
    }
    /**
     * Default Domain Name
     *
     * @param string|null $defaultDomainName
     *
     * @return self
     */
    public function setDefaultDomainName(?string $defaultDomainName) : self
    {
        $this->initialized['defaultDomainName'] = true;
        $this->defaultDomainName = $defaultDomainName;
        return $this;
    }
    /**
     * Sender Email for Authentication Email
     *
     * @return string|null
     */
    public function getFromEmailAddress() : ?string
    {
        return $this->fromEmailAddress;
    }
    /**
     * Sender Email for Authentication Email
     *
     * @param string|null $fromEmailAddress
     *
     * @return self
     */
    public function setFromEmailAddress(?string $fromEmailAddress) : self
    {
        $this->initialized['fromEmailAddress'] = true;
        $this->fromEmailAddress = $fromEmailAddress;
        return $this;
    }
    /**
     * Reply-from email address of authentication email
     *
     * @return string|null
     */
    public function getReplyEmailAddress() : ?string
    {
        return $this->replyEmailAddress;
    }
    /**
     * Reply-from email address of authentication email
     *
     * @param string|null $replyEmailAddress
     *
     * @return self
     */
    public function setReplyEmailAddress(?string $replyEmailAddress) : self
    {
        $this->initialized['replyEmailAddress'] = true;
        $this->replyEmailAddress = $replyEmailAddress;
        return $this;
    }
    /**
     * SES sandbox release and Cognito SES configuration results
     *
     * @return bool|null
     */
    public function getIsSesSandboxGranted() : ?bool
    {
        return $this->isSesSandboxGranted;
    }
    /**
     * SES sandbox release and Cognito SES configuration results
     *
     * @param bool|null $isSesSandboxGranted
     *
     * @return self
     */
    public function setIsSesSandboxGranted(?bool $isSesSandboxGranted) : self
    {
        $this->initialized['isSesSandboxGranted'] = true;
        $this->isSesSandboxGranted = $isSesSandboxGranted;
        return $this;
    }
}