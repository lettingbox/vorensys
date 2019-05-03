<?php

namespace Lettingbox\Vorensys;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Lettingbox\Vorensys\Exceptions\VorensysException;

class Vorensys
{
    private $client;
    private $key;
    private $id;
    private $username;
    private $password;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    /**
     * Starts the referencing process for a new prospective tenant by submitting an application for tenant reference report.
     *
     * @param Application $applicant
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submit(Application $applicant)
    {
        try {
            $reponse = $this->client->post('https://www.vorensys.com/api/submit', [
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'Lettingbox',
                ],
                'form_params' => [
                    'apiKey' => $this->key,
                    'username' => $this->username,
                    'password' => $this->password,
                    'custId' => $this->id,
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
                    't_pri_job_num' => $applicant->applicationId,
                ]
            ]);

            if ($reponse->getStatusCode() !== 200) {
                throw VorensysException::couldNotConnect();
            }

            $vorensysResponse = json_decode($reponse->getBody(), true);

            if ($vorensysResponse['status'] != 200) {
                throw VorensysException::serviceReturnedError(json_encode($vorensysResponse['Validation Failure(s)']));
            }
            return ['id' => $vorensysResponse['job number'], 'url' => $vorensysResponse['tenant form URL']];
        } catch (Exception $exception) {
            throw VorensysException::couldNotConnect();
        }
    }

    /**
     * Set the API key.
     *
     * @param mixed $key
     * @return Vorensys
     */
    public function setApiKey($key): Vorensys
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Set the API Customer Id.
     *
     * @param mixed $id
     * @return Vorensys
     */
    public function setId($id): Vorensys
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set the API username.
     *
     * @param mixed $username
     * @return Vorensys
     */
    public function setUsername($username): Vorensys
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Set the API Passworrd.
     *
     * @param mixed $password
     * @return Vorensys
     */
    public function setPassword($password): Vorensys
    {
        $this->password = $password;
        return $this;
    }
}
