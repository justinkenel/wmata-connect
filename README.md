# Wmata Connect

Small web application that allows a user to select a metro station and then see the trains that will be arriving, including the line, their destination, and ETA.

This is built using [Laravel](https://laravel.com/) with a [Vue](https://v2.vuejs.org/) frontend. [Vuetify](https://vuetifyjs.com/en/) was used as a component library. Running this locally requires PHP, [artisan](https://laravel.com/docs/9.x/artisan), and [composer](https://getcomposer.org/).

![image](https://user-images.githubusercontent.com/2307171/162852101-486fc4ee-a45e-4381-b694-c85a6f577408.png)

## Local Dev

You must have an application registered on https://developer.wmata.com/. You will need to create a new `.env` file based on the `.env.example` file at the root level - it should have `WMATA_API_KEY` set to your subscription API key from the "Default Tier" on the product page.

To run locally, download the repo and run:

```
composer install
php artisan serve
```

Then navigate to `localhost:8000` (or possibly a different port - check your console).

The repo ships with a full build of the UI - run `npm install` and `npm run dev` to build locally.

## Overview
An overview of the backend and frontend:

### Backend
The server exposes two APIs -
- `/station` to get a list of stations
- `/station/{id}` to get a list of trains that will soon arrive at the station

The route definitions can be found in `routes/api.php`, while the implementations for those routes can be found in `app/Services/WmataApi.php`

### Front End
There are two components to the front end -

- `resources/js/components/StationSearchField.vue` contains the logic for getting the list of stations and allowing the user to search using an autocomplete
- `resources/js/components/NextTrainList.vue` contains the rendering of arriving trains once a station has been selected

These are collected, with their shared state, in `resources/js/components/TrainUpdates.vue`, which is the top level component.

## Potential Updates

Rate Limiting - the Wmata API has a rate limit of 10 calls/second - a library such as https://github.com/nikolaposa/rate-limit could be used with either an in memory or Redis (for scalability) implementation. In the case of an error, the backend could return a specific response indicating the rate limit, and the front end would display this to the user. It could also prevent input on the front end.

Alternate Station List Caching - currently the station list is cached on the server after it has been loaded once - however, this list is unlikely to change, and could be either committed alongside the codebase as a file, or stashed in another lower latency data source (SQL server, Blob storage, etc).
