<?php


namespace app\services;


use app\exceptions\InvalidAccessTokenException;
use app\models\Station;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use app\exceptions\QuotaExceededException;
use UnexpectedValueException;
use app\exceptions\UnknownStationException;

class Waqi
{
    private const ENDPOINT = 'https://api.waqi.info/api';

    private $token;

    private $raw_data;
    /**
     * @var Station
     */
    private $station;

    public function __construct()
    {
        $this->token = getenv('WAQI_TOKEN');
    }

    /**
     * @param Station $station
     * @throws GuzzleException
     * @throws InvalidAccessTokenException
     * @throws QuotaExceededException
     * @throws UnknownStationException
     */
    public function getObservationByStation(Station $station): void
    {
        $this->station = $station;
        if (empty($station)) {
            throw new UnexpectedValueException(sprintf('Monitoring station or city "%s" is an invalid value.', $station));
        }
        $client = new Client(['base_uri' => self::ENDPOINT]);
        $response = $client->request('GET', 'feed/' . $station->endpoint . '/', ['query' => 'token=' . $this->token]);
        $_response_body = json_decode($response->getBody());
        if ($_response_body->status === 'ok') {
            $this->raw_data = $_response_body->data;
        } elseif ($_response_body->status === 'error') {
            if (isset($_response_body->data)) {
                switch ($_response_body->data) {
                    case 'Unknown station':
                        throw new UnknownStationException($station);
                    case 'Over quota':
                        throw new QuotaExceededException();
                    case 'Invalid key':
                        throw new InvalidAccessTokenException();
                }
            }
        }
    }

    public function getAQI(): int
    {
        return (int)$this->raw_data->aqi;
    }

    public function getMeasurementTime(): DateTime
    {
        return new DateTime($this->raw_data->time->s, new DateTimeZone($this->raw_data->time->tz));
    }

    public function getMonitoringStation(): array
    {
        return [
            'id' => (int)$this->raw_data->idx,
            'name' => (string)\html_entity_decode($this->raw_data->city->name),
            'coordinates' => [
                'latitude' => (float)$this->raw_data->city->geo[0],
                'longitude' => (float)$this->raw_data->city->geo[1],
            ],
            'url' => (string)$this->raw_data->city->url
        ];
    }

    public function getAttributions(): array
    {
        return (array)json_decode(\json_encode($this->raw_data->attributions), true);
    }

    public function getHumidity(): ?string
    {
        return $this->raw_data->iaqi->h->v ?? null;
    }

    public function getTemperature(): ?float
    {
        return $this->raw_data->iaqi->t->v ?? null;
    }

    public function getPressure(): ?string
    {
        return $this->raw_data->iaqi->p->v ?? null;
    }

    public function getCO(): ?string
    {
        return $this->raw_data->iaqi->co->v ?? null;
    }

    public function getNO2(): ?string
    {
        return $this->raw_data->iaqi->no2->v ?? null;
    }

    public function getO3(): ?string
    {
        return $this->raw_data->iaqi->o3->v ?? null;
    }

    public function getPM10(): ?string
    {
        return $this->raw_data->iaqi->pm10->v ?? null;
    }

    public function getPM25(): ?string
    {
        return $this->raw_data->iaqi->pm25->v ?? null;
    }

    public function getSO2(): ?string
    {
        return $this->raw_data->iaqi->so2->v ?? null;
    }

    public function getPrimaryPollutant(): string
    {
        return (string)$this->raw_data->dominentpol;
    }

    public function getStationId() {
        return $this->station->id;
    }
}