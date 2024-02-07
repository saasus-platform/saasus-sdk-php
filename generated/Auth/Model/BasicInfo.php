<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class BasicInfo extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = array();
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * ドメイン名(Domain Name)
     *
     * @var string|null
     */
    protected $domainName;
    /**
     * DNSレコードの検証結果(DNS Record Verification Results)
     *
     * @var bool|null
     */
    protected $isDnsValidated;
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
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @var DnsRecord[]|null
     */
    protected $dkimDnsRecords;
    /**
     * デフォルトドメイン名(Default Domain Name)
     *
     * @var string|null
     */
    protected $defaultDomainName;
    /**
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
     *
     * @var string|null
     */
    protected $fromEmailAddress;
    /**
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
     *
     * @var string|null
     */
    protected $replyEmailAddress;
    /**
     * SESのサンドボックス解除及びCognitoのSES設定結果(SES sandbox release and Cognito SES configuration results)
     *
     * @var bool|null
     */
    protected $isSesSandboxGranted;
    /**
     * ドメイン名(Domain Name)
     *
     * @return string|null
     */
    public function getDomainName() : ?string
    {
        return $this->domainName;
    }
    /**
     * ドメイン名(Domain Name)
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
     * DNSレコードの検証結果(DNS Record Verification Results)
     *
     * @return bool|null
     */
    public function getIsDnsValidated() : ?bool
    {
        return $this->isDnsValidated;
    }
    /**
     * DNSレコードの検証結果(DNS Record Verification Results)
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
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @return DnsRecord[]|null
     */
    public function getDkimDnsRecords() : ?array
    {
        return $this->dkimDnsRecords;
    }
    /**
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @param DnsRecord[]|null $dkimDnsRecords
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
     * デフォルトドメイン名(Default Domain Name)
     *
     * @return string|null
     */
    public function getDefaultDomainName() : ?string
    {
        return $this->defaultDomainName;
    }
    /**
     * デフォルトドメイン名(Default Domain Name)
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
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
     *
     * @return string|null
     */
    public function getFromEmailAddress() : ?string
    {
        return $this->fromEmailAddress;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
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
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
     *
     * @return string|null
     */
    public function getReplyEmailAddress() : ?string
    {
        return $this->replyEmailAddress;
    }
    /**
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
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
     * SESのサンドボックス解除及びCognitoのSES設定結果(SES sandbox release and Cognito SES configuration results)
     *
     * @return bool|null
     */
    public function getIsSesSandboxGranted() : ?bool
    {
        return $this->isSesSandboxGranted;
    }
    /**
     * SESのサンドボックス解除及びCognitoのSES設定結果(SES sandbox release and Cognito SES configuration results)
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