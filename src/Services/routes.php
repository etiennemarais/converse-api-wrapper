<?php

Route::get('/{pageName?}', 'ConverseApi\Services\Content\ContentController@renderPage');