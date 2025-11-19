<?php

use App\Models\Ticket;
use Zendesk\API\HttpClient as ZendeskAPI;

Schedule::command('items:import ' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:00');

Schedule::command('serials:import ' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:05');

Schedule::command('contacts:import ' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:10');
