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
     * @var string
     */
    protected $domainName;
    /**
     * DNSレコードの検証結果(DNS Record Verification Results)
     *
     * @var bool
     */
    protected $isDnsValidated;
    /**
     * 
     *
     * @var DnsRecord
     */
    protected $certificateDnsRecord;
    /**
     * 
     *
     * @var DnsRecord
     */
    protected $cloudFrontDnsRecord;
    /**
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @var DnsRecord[]
     */
    protected $dkimDnsRecords;
    /**
     * デフォルトドメイン名(Default Domain Name)
     *
     * @var string
     */
    protected $defaultDomainName;
    /**
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
     *
     * @var string
     */
    protected $fromEmailAddress;
    /**
     * ドメイン名(Domain Name)
     *
     * @return string
     */
    public function getDomainName() : string
    {
        return $this->domainName;
    }
    /**
     * ドメイン名(Domain Name)
     *
     * @param string $domainName
     *
     * @return self
     */
    public function setDomainName(string $domainName) : self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
    /**
     * DNSレコードの検証結果(DNS Record Verification Results)
     *
     * @return bool
     */
    public function getIsDnsValidated() : bool
    {
        return $this->isDnsValidated;
    }
    /**
     * DNSレコードの検証結果(DNS Record Verification Results)
     *
     * @param bool $isDnsValidated
     *
     * @return self
     */
    public function setIsDnsValidated(bool $isDnsValidated) : self
    {
        $this->initialized['isDnsValidated'] = true;
        $this->isDnsValidated = $isDnsValidated;
        return $this;
    }
    /**
     * 
     *
     * @return DnsRecord
     */
    public function getCertificateDnsRecord() : DnsRecord
    {
        return $this->certificateDnsRecord;
    }
    /**
     * 
     *
     * @param DnsRecord $certificateDnsRecord
     *
     * @return self
     */
    public function setCertificateDnsRecord(DnsRecord $certificateDnsRecord) : self
    {
        $this->initialized['certificateDnsRecord'] = true;
        $this->certificateDnsRecord = $certificateDnsRecord;
        return $this;
    }
    /**
     * 
     *
     * @return DnsRecord
     */
    public function getCloudFrontDnsRecord() : DnsRecord
    {
        return $this->cloudFrontDnsRecord;
    }
    /**
     * 
     *
     * @param DnsRecord $cloudFrontDnsRecord
     *
     * @return self
     */
    public function setCloudFrontDnsRecord(DnsRecord $cloudFrontDnsRecord) : self
    {
        $this->initialized['cloudFrontDnsRecord'] = true;
        $this->cloudFrontDnsRecord = $cloudFrontDnsRecord;
        return $this;
    }
    /**
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @return DnsRecord[]
     */
    public function getDkimDnsRecords() : array
    {
        return $this->dkimDnsRecords;
    }
    /**
     * DKIM DNS レコード(DKIM DNS Records)
     *
     * @param DnsRecord[] $dkimDnsRecords
     *
     * @return self
     */
    public function setDkimDnsRecords(array $dkimDnsRecords) : self
    {
        $this->initialized['dkimDnsRecords'] = true;
        $this->dkimDnsRecords = $dkimDnsRecords;
        return $this;
    }
    /**
     * デフォルトドメイン名(Default Domain Name)
     *
     * @return string
     */
    public function getDefaultDomainName() : string
    {
        return $this->defaultDomainName;
    }
    /**
     * デフォルトドメイン名(Default Domain Name)
     *
     * @param string $defaultDomainName
     *
     * @return self
     */
    public function setDefaultDomainName(string $defaultDomainName) : self
    {
        $this->initialized['defaultDomainName'] = true;
        $this->defaultDomainName = $defaultDomainName;
        return $this;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
     *
     * @return string
     */
    public function getFromEmailAddress() : string
    {
        return $this->fromEmailAddress;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender Email for Authentication Email)
     *
     * @param string $fromEmailAddress
     *
     * @return self
     */
    public function setFromEmailAddress(string $fromEmailAddress) : self
    {
        $this->initialized['fromEmailAddress'] = true;
        $this->fromEmailAddress = $fromEmailAddress;
        return $this;
    }
}