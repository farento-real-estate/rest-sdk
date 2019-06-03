<?php

namespace Farento\SDK\Service;

/**
 * @method proxyList()
 * @method lock()
 * @method page()
 * @method pageList()
 * @method styleByHash()
 * @method style()
 * @method locationCountryList()
 * @method locationCountry()
 * @method locationDistrictList()
 * @method locationDistrict()
 * @method locationCity()
 * @method locationCityList()
 * @method locationStreetList()
 * @method locationStreet()
 * @method locationRegion()
 * @method locationRegionList()
 * @method locationHouse()
 * @method locationHouseList()
 * @method locationFloor()
 * @method locationFloorList()
 * @method address()
 * @method addressList()
 * @method phone()
 * @method phoneList()
 * @method contactOwner()
 * @method contactList()
 * @method pageHistory()
 * @method pageHistoryList()
 * @method contact()
 * @method advertList()
 * @method advert()
 * @method advert_group()
 * @method advert_groupList()
 * @method driveGoogleFolderList()
 * @method driveGoogleFolder()
 * @method pageIs_grabbed()
 * @method estateList()
 * @method estate()
 */
class Router
{
    private $baseRoute;

    private $host;

    /**
     * Router constructor.
     *
     * @param string $apiHost
     */
    public function __construct(string $apiHost)
    {
        $this->baseRoute = $apiHost . '/api/v1';
        $this->host      = $apiHost;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return null|string
     */
    public function __call($name, $arguments): ?string
    {
        unset($arguments);

        $explode = \explode('_', $name);

        if (\count($explode) > 1) {
            $name = '';

            $i = 0;
            foreach ($explode as $part) {
                $delimiter = '';
                if (0 !== $i) {
                    $delimiter = '-';
                }

                $name .= $delimiter . $part;
                ++$i;
            }
        }

        if (\preg_match_all('/((?:^|[A-Z])[a-z-]+)/u', $name, $matches) > 0) {
            $matches = \array_shift($matches);
            $route   = '';

            foreach ($matches as $item) {
                $route .= '/' . \mb_strtolower($item);
            }

            return $this->baseRoute . $route;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
}
