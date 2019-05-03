<?php


namespace Lettingbox\Vorensys;


class VorensysApplicant
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
     * Type of service requested
     * 1 - credit check only, 2 - full tenant report
     *
     * @param mixed $serviceType
     * @return VorensysApplicant
     */
    public function ServiceType(int $serviceType): VorensysApplicant
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * Tenancy term
     * 0, 6 or 12
     * 0 is used for non-tenancy related personal credit checks.
     *
     * @param mixed $tenancyTerm
     * @return VorensysApplicant
     */
    public function TenancyTerm(int $tenancyTerm): VorensysApplicant
    {
        $this->tenancyTerm = $tenancyTerm;
        return $this;
    }

    /**
     * Tenant’s landline number
     *
     * @param mixed $landLineNumber
     * @return VorensysApplicant
     */
    public function LandLineNumber($landLineNumber): VorensysApplicant
    {
        $this->landLineNumber = $landLineNumber;
        return $this;
    }

    /**
     * Tenant’s mobile number (will be used to send a text reminder)
     *
     * @param mixed $mobileNumber
     * @return VorensysApplicant
     */
    public function MobileNumber($mobileNumber): VorensysApplicant
    {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    /**
     * Tenancy type
     * 0- Sole applicant,
     * 1- Primary applicant in joint tenancy,
     * 2- Additional applicant in joint tenancy
     *
     * @param bool $primary Is this the primary applicant?
     * @param string $applicationId Identify the application id for the primary applicant
     * @return VorensysApplicant
     */
    public function JointTenancy(bool $primary, string $applicationId = null): VorensysApplicant
    {
        $this->tenancyType = $primary ? 1 : 2;
        $this->applicationId = $applicationId;
        return $this;
    }
}
