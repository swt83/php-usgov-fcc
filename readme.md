# FCC

A PHP library for working w/ the FCC API.

## Install

Normal install via Composer.

## Usage

There are only two methods available, ``facility_search`` and ``facility_details``.

```php
// return list of stations based on search
$stations = Travis\FCC::facility_search($search);

// return details on a specific station
$details = Travis\FCC::facility_details($fcc_id);
```

Find more information about the API on the [FCC Developer Page](https://stations.fcc.gov/developer/).