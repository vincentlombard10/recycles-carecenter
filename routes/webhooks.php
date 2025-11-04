<?php

Route::webhooks('/webhooks/zendesk/tickets', 'zendesk.tickets', 'patch')
    ->withoutMiddleware(['auth']);

Route::webhooks('/webhooks/contacts', 'contacts', 'post')
    ->withoutMiddleware(['auth']);



