<?php

namespace Lettingbox\Vorensys;

use GuzzleHttp\Client;
use Lettingbox\Vorensys\Exceptions\VorensysException;

class VorensysClass
{
    private $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Starts the referencing process for a new prospective tenant by submitting an application for tenant reference report.
     *
     * @param VorensysApplicant $applicant
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(VorensysApplicant $applicant)
    {
        $reponse = $this->client->request('POST', 'https://www.vorensys.com/api/submit', [
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'Lettingbox'
            ],
            'form_params' => [
                'apiKey' => config('vorensys.key'),
                'username' => config('vorensys.username'),
                'password' => config('vorensys.password'),
                'custId' => config('vorensys.id'),
                't_title' => $applicant->title,
                't_fname' => $applicant->firstName,
                't_sname' => $applicant->lastName,
                't_contact_email' => $applicant->contactEmail,
                't_mobilenum' => $applicant->mobileNumber,
                'service_type' => $applicant->serviceType,
                't_tenancy_term' => $applicant->tenancyTerm,
                'ren_prop_addr' => $applicant->propertyAddress,
                'ren_prop_postcode' => $applicant->propertyPostcode,
                'ren_prop_mon_rent' => $applicant->propertyMonthlyRent,
                't_joint' => $applicant->tenancyType,
                't_pri_job_num' => $applicant->applicationId
            ]
        ]);

        if ($reponse->getStatusCode() !== 200) {
            throw VorensysException::couldNotConnect();
        }

        $vorensysResponse = json_decode($reponse->getBody());

        if ($vorensysResponse->status != 200) {
            throw VorensysException::serviceReturnedError($reponse['Validation Failure(s)']);
        }

        return ['id' => $vorensysResponse['job number'], 'url' => $vorensysResponse['tenant form URL']];
    }
}
