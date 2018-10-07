<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/16/18
 * Time: 10:45 PM
 */

namespace App\Libraries\Bandwidth;

use App\Libraries\Bandwidth\Exceptions\APIRequestException;
use App\Libraries\Bandwidth\Exceptions\ConfigMissingException;
use App\Libraries\Bandwidth\Exceptions\ValidationException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Validator;

abstract class Client
{
    private $useId;
    private $apiToken;
    private $apiSecret;

    /**
     * @var HttpClient
     * @author vuldh <vuldh@nal.vn>
     */
    protected $httpClient;

    /**
     * Client constructor.
     * @param $useId
     * @param $apiToken
     * @param $apiSecret
     * @throws ConfigMissingException
     */
    public function __construct($useId, $apiToken, $apiSecret)
    {
        $this->useId = $useId;
        $this->apiToken = $apiToken;
        $this->apiSecret = $apiSecret;

        if (empty($this->useId)
            || empty($this->apiSecret)
            || empty($this->apiToken)) {
            throw new ConfigMissingException();
        }

        $this->httpClient = new HttpClient([
            'base_uri' => 'https://api.catapult.inetwork.com/v1/users/' . $this->useId . "/",
            'auth' => [$this->apiToken, $this->apiSecret],
            'headers' => ['Content-Type' => 'application/json']
        ]);
    }

    /**
     * @param $response
     * @return mixed
     * @author vuldh <vuldh@nal.vn>
     */
    protected function extractId($response)
    {
        $location_header = explode("/", $response->getHeaderLine('Location'));
        return end($location_header);
    }

    /**
     * @param $uri
     * @param $body
     * @return mixed
     * @throws APIRequestException
     * @throws \Exception
     * @author vuldh <vuldh@nal.vn>
     */
    protected function makePostRequest($uri, $body)
    {
        try {
            \Log::debug("[Bandwidth][Request] $uri - " . json_encode($body));
            $response = $this->httpClient->post($uri, [
                RequestOptions::JSON => $body
            ]);
            \Log::debug("[Bandwidth][Response] $uri" . $response->getBody());
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            $data = json_decode($response->getBody(), true);
            throw new APIRequestException($data['code'], $data['message'], $data['category']);
        }
    }

    /**
     * @param $data
     * @param $rules
     * @author vuldh <vuldh@nal.vn>
     * @throws ValidationException
     */
    protected function validate($data, $rules)
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }
}