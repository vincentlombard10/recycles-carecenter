<?php

Route::webhooks('/webhooks/zendesk/tickets', 'zendesk.tickets', 'patch')
    ->withoutMiddleware(['auth']);



