# Simple flight booking system

## General

Based of Zend Framework 2 Skeleton Application.
Created for demonstration purposes.

## Overview

Has simple inventory tools for managing flights.
Inventory implement standard CRUD actions.
- **CREATE** new flight
- **READ** all flights
- **UPDATE** existing flights
- **DELETE** existing flights

Inventory implemented as separate module.
Add flight form has separate filter and custom validator.
Form implements defence from CSRF attacks.

## PHPUnit

Tests available at `./tests/unit/Test` directory.
They implement simple demo tests.
- **EntityTest** covers simple variable validation tests
- **InventoryControllerTest** demonstrates controller testing. View and Add action covered.
Add action has mocked database query.

## Credits

[Vladyslav Semerenko](mailto:vladyslav.semerenko@gmail.com)