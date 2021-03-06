# Coronavirus (COVID-19, specifically) Reporter
[![Travis](https://img.shields.io/travis/guillermoandrae/coronavirus-reporter.svg?style=flat-square)](https://travis-ci.org/guillermoandrae/coronavirus-reporter) [![Scrutinizer](https://img.shields.io/scrutinizer/g/guillermoandrae/coronavirus-reporter.svg?style=flat-square)](https://scrutinizer-ci.com/g/guillermoandrae/coronavirus-reporter/) [![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/guillermoandrae/coronavirus-reporter.svg?style=flat-square)](https://scrutinizer-ci.com/g/guillermoandrae/coronavirus-reporter/) 
 [![@guillermoandrae on Twitter](http://img.shields.io/badge/twitter-%40guillermoandrae-blue.svg?style=flat-square)](https://twitter.com/guillermoandrae)

This project provides data about the number of confirmed COVID-19 cases in select states.

## A Note About DOH Sites
Lots has changed since this project first went live. I'm no longer scraping Department of Health websites, because most of them look way different than they originally did and are using more advanced methods of conveying information (like visualizations that can't be easily scraped). 

## Installation
Do this, then relax (if you can!!!!!):
```
composer install guillermoandrae/coronavirus-reporter
```

## Getting Started
You can run this locally:
```
php ./bin/covid-19.php
```

You can also view the API available at https://covid-19.bklyn.dev/.

## Testing
Run the following command to make sure your code is appropriately styled:
```
composer check-style
```

Run the following command to check style, run tests, and generate a Clover report:
```
composer test
```

Run the following command to check style, run tests, and generate an HTML report (access the report at http://localhost:8080):
```
composer test-html
```
