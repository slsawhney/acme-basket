# Acme Widget Basket

## Overview
This is a proof-of-concept shopping basket for Acme Widget Co.  
It calculates totals including delivery rules and special offers.

## Features
- Add products by code
- Apply delivery rules
- Apply offers (e.g., "buy 1 red widget, get the second half price")
- Unit tests with PHPUnit
- Fully Dockerized environment

## Prerequisites
- Docker & Docker Compose (no local PHP required)

## Setup
- Execute `make build` command to setup the project
```bash
make build
```

## Other commands
- Execute `make run` command to run the run.php. It would give us 
  the price with discount on command prompt.
```bash
make run
```

- Execute `make test` command to execute the Test Cases
```bash
make test
```

- Execute `make shell` command to enter the app in docker container
```bash
make shell
```

- Execute `make phpcs` command to run PHPCode Sniffer on Code
```bash
make phpcs
```

- Execute `make phpstan` command to run PHPStan on Code
```bash
make phpstan
```