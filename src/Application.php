<?php

namespace Lettingbox\Vorensys;

class Application
{
    public $companyName;
    public $title;
    public $firstName;
    public $lastName;
    public $contactEmail;
    public $landLineNumber;
    public $mobileNumber;
    public $propertyAddress;
    public $propertyPostcode;
    public $propertyMonthlyRent;
    public $tenancyTerm = 12;
    public $tenancyType = 0;
    public $serviceType = 2;
    public $guarantor;
    public $applicationId;

    /**
     * Applicant constructor.
     *
     * @param $title            string      Tenant’s title
     * @param $firstName        string      Tenant’s first name
     * @param $lastName         string      Tenant’s last name
     * @param $contactEmail     string      Tenant’s email address
     */
    public function __construct($title, $firstName, $lastName, $contactEmail)
    {
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->contactEmail = $contactEmail;
    }

    /**
     * Type of service requested:
     * 1 - credit check only, 2 - full tenant report.
     *
     * @param mixed $serviceType
     * @return Application
     */
    public function ServiceType(int $serviceType): Application
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * Tenancy term:
     * 0, 6 or 12.
     * 0 is used for non-tenancy related personal credit checks.
     *
     * @param mixed $tenancyTerm
     * @return Application
     */
    public function TenancyTerm(int $tenancyTerm): Application
    {
        $this->tenancyTerm = $tenancyTerm;
        return $this;
    }

    /**
     * Tenant’s landline number.
     *
     * @param mixed $landLineNumber
     * @return Application
     */
    public function LandLineNumber($landLineNumber): Application
    {
        $this->landLineNumber = $landLineNumber;
        return $this;
    }

    /**
     * Tenant’s mobile number (will be used to send a text reminder).
     *
     * @param mixed $mobileNumber
     * @return Application
     */
    public function MobileNumber($mobileNumber): Application
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    /**
     * Tenancy type:
     * 0- Sole applicant,
     * 1- Primary applicant in joint tenancy,
     * 2- Additional applicant in joint tenancy.
     *
     * @param bool $primary Is this the primary applicant?
     * @param string $applicationId Identify the application id for the primary applicant
     * @return Application
     */
    public function JointTenancy(bool $primary, string $applicationId = null): Application
    {
        $this->tenancyType = $primary ? 1 : 2;
        $this->applicationId = $applicationId;
        return $this;
    }
}
