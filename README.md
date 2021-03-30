# Tracktik Test Assessment for PHP Backend Developer
### Simulation of buying of electronic items

## Directory Structure
```
.
├── config/             Configuration files include bootstrap/setting file
├── public/             Web server files (DocumentRoot)
│   └── css             css
│   └── index.php       The front controller
├── src/                PHP source code (The TrackTik namespace)
│    └── model          Entity files
│    └── view           Twig templates
│    └── controller     Controller functions
│    └── businessLogic   
├── var/cache/twig      Twig cache files
├── vendor/             Reserved for composer
├── .env                store environment variables e.g PURCHASED_ITEMS - dummy data for test
├── .gitignore          Git ignore rules
└── composer.json       Project dependencies and autoloader
└── phpunit.xml         Configuration of phpunit for unit testing
└── tests/               TestCase files
```

## Requirements
- PHP >= 7.4 
- Composer
- Nginx

## Installation

- nginx config example:
```
server {
	
  listen 80;
  server_name tracktik.test;
  return 301 https://tracktik.test$request_uri;
}

server {
	
  listen 443;
  server_name tracktik.test;

  root /Users/myname/Trakit_test/test_swanand09;

  include ssl.inc;

  charset utf-8;

  location / {
    index public/index.php;
    try_files $uri $uri/ /public/index.php?$args;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_pass unix:/Users/myname/php.socket;
    fastcgi_index index.php;
    client_max_body_size 32m;
    fastcgi_buffer_size 16k;
    fastcgi_buffers 8 16k;
    fastcgi_read_timeout 120s;
    include fastcgi_params;
    fastcgi_param DOCUMENT_ROOT $realpath_root;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    fastcgi_param APPLICATION_ENV swanand;
    fastcgi_param APPLICATION_DEBUG 1;
  }
}
```

- add ``` 127.0.0.1	tracktik.test ``` to /etc/hosts
- Go to project folder and do  composer install
- access these urls on the browser:
    - https://tracktik.test
    - https://tracktik.test/console-bought/
    - http://tracktik.test/api/list-items-purchase/
    - https://tracktik.test/api/console-bought/


## API Endpoints:
- Question1 : **http://tracktik.test/api/list-items-purchase/**
- Question2: **https://tracktik.test/api/console-bought/**

## Answers to questions
- Question1 : **https://tracktik.test**
- Question2: **https://tracktik.test/console-bought/**
  
## Unit Testing 
- run `vendor/bin/phpunit`  
- tests/TestController.php -> routes test cases
- tests/TestFactoryPurchase.php -> test factory functions(src/businessLogic/factory) against model entities(src/model/entities)



## Description of Assignment
>*Question 1*: Using the code given, create each type of electronic as classes. Every
ElectronicItem must have a function called maxExtras that limits the number of extras an
electronic item can have. The extras are a list of electronic items that are attached to another
electronic item to complement it.
- The console can have a maximum of 4 extras
- The television has no maximum extras
- The microwave can't have any extras
- The controller can't have any extras

### Create a scenario where a person would buy:
>1 console, 2 televisions with different prices and 1 microwave
The console and televisions have extras; those extras are controllers. The console has 2 remote
controllers and 2 wired controllers. The TV #1 has 2 remote controllers and the TV #2 has 1
remote controller.
Sort the items by price and output the total pricing.

>*Question 2*: That person's friend saw her with her new purchase and asked her how much the
console and its controllers had cost her. Give the answer.
Please return the test in a compressed PHP file or through an online Git repository (GitHub or
similar).
You will be evaluated by several TrackTik developers on the following aspects:
(scale of 1 to 10)
- Correct Output of Code and Bug Free
- Code Clarity and Simplicity
- Code Structure
- Application of Object-Oriented Concepts
- Technical Level of Solution vs your level of expertise

### Codes Given:

```
<?php

class ElectronicItems
{
    private $items = array();
    public function __construct(array $items)
    {
        $this->items = $items;
    }
    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        foreach ($this->items as $item) {
            $sorted[($item->price * 100)] = $item;
        }
        return ksort($sorted, SORT_NUMERIC);
    }
    /**
     *
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
        }
        return false;
    }
}

class ElectronicItem
{
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    private $type;
    public $wired;
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    private static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE, self::ELECTRONIC_ITEM_TELEVISION
    );
    function getPrice()
    {
        return $this->price;
    }
    function getType()
    {
        return $this->type;
    }
    function getWired()
    {
        return $this->wired;
    }
    function setPrice($price)
    {
        $this->price = $price;
    }
    function setType($type)
    {
        $this->type = $type;
    }
    function setWired($wired)
    {
        $this->wired = $wired;
    }
}

```