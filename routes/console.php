<?php

use App\Models\Ticket;
use Zendesk\API\HttpClient as ZendeskAPI;

Schedule::command('items:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:00');

Schedule::command('serials:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:05');

Schedule::command('contacts:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:10');
