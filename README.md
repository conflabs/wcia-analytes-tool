# wcia analytes maintainence tool
Consumes OpenTHC Lab Metrics and produces a flexible json object for use in WA State interop.

----------------------------------------

# Getting Started

## Prep

1. Load the storage area with the OpenTHC Lab Metrics.  
Clone the [https://github.com/openthc/api.git](https://github.com/openthc/api.git) repository and copy its 
`etc/lab-metric` folder to this repository's `storage/` folder (i.e., `storage/lab-metric`).  

2. Load the storage area with the WCIA analytes json files.
Clone the [https://github.com/conflabs/wcia-analytes.git](https://github.com/conflabs/wcia-analytes.git) repository and 
copy its `json/` folder to this repository's `storage/` folder (i.e., `storage/json`).

3. From the CLI, run `php makeOpenTHCResource.php` to create the OpenTHC Json Resource.  
   It is saved to the storage dir.  

----------------------------------------

## Find Missing OpenTHC Lab Metrics

From the CLI, run `php makeNotInWciaList.php` to create a list of OpenTHC lab metrics that are not in the WCIA list.

## Convert Missing OpenTHC Lab Metrics to WCIA Analytes

From the CLI, run `php makeNewWciaAnalytes.php` to create a list of new WCIA analytes from the OpenTHC lab metrics list.

----------------------------------------

## Find Missing WCIA Analytes

From the CLI, run `php makeNotInOpenThcList.php` to create a list of WCIA analytes that are not in the OpenTHC list.

## Convert Missing WCIA Analytes to OpenTHC Lab Metrics 

From the CLI, run `php makeNewOpenThcLabMetrics.php` to create a list of new OpenTHC stubs from the WCIA analytes list.

----------------------------------------

## Create Documents

1. Load the current and most up-to-date json folder from [wcia-analytes](https://github.com/conflabs/wcia-analytes) 
into the `storage/` directory.  
2. Make a directory in the storage folder called `storage/docs`.  
3. From the CLI, run `php makeMarkDown.php` to create a series of mark down docs in the `storage/docs` folder.  

----------------------------------------

## Unit Tests

The `tests/` folder is a reflection of the `src/` folder, but containing Unit Test classes. Run the unit tests from the
CLI, like so: `php vendor/bin/phpunit tests/`.

## Static Analysis

This project uses PHPStan for static analysis, and at a default level of `5`.  Run the analyser from the CLI like so,
`vendor/bin/phpstan analyse --level 5 src`.

----------------------------------------

## Docker

For simple, reproducible server environments, I've included a Dockerfile for creating a quick CLI environment with which
to run these scripts.

### Docker Build

`docker build -f Dockerfile -t wcia/analytes-generator:latest .`

### Docker Run CLI

`docker run -it --rm -v $PWD:/srv wcia/analytes-generator:latest bash`

### Docker Run Unit Tests

`docker run -it --rm -v $PWD:/srv wcia/analytes-generator:latest php vendor/bin/phpunit tests/`

### Docker Run Static Analysis

`docker run -it --rm -v $PWD:/srv wcia/analytes-generator:latest vendor/bin/phpstan analyse --level 5 src`