<?php
use Illuminate\Support\Facades\Route;

//GET - admin/crm/module
//POST - admin/crm/module - store
//PUT - admin/crm/module/{calendar} - update
//GET - admin/crm/module/{calendar} - show
//DELETE - admin/crm/module/{calendar} - destroy
//GET - admin/crm/module/{calendar}/edit - edit

Route::group([
    'namespace' => 'Admin', 'prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect('admin/settings/seo');
    });

    Route::post('gallery/set', 'Gallery\IndexController@sort')->name('gallery.sort');
    Route::post('image/set', 'Gallery\ImageController@sort')->name('image.sort');
    Route::post('box/set', 'Box\IndexController@sort')->name('box.sort');

    Route::resources([
        'page' => 'Page\IndexController',
        'url' => 'Url\IndexController',
        'dictionary' => 'Dictionary\IndexController',
        'file' => 'File\IndexController',
        'file-catalog' => 'File\CatalogController',
        'gallery' => 'Gallery\IndexController',
        'user' => 'User\IndexController',
        'role' => 'Role\IndexController',
        'greylist' => 'Greylist\IndexController',
        'article' => 'Article\IndexController',
        'contract' => 'Contract\IndexController',
        'image' => 'Gallery\ImageController',
        'box' => 'Box\IndexController',
        'map' => 'Map\IndexController'
    ]);
    // Gallery
    Route::get('ajaxGetGalleries', 'Gallery\IndexController@ajaxGetGalleries')->name('ajaxGetGalleries');

    Route::get('dictionary/{slug}/{locale}/edit', 'Dictionary\IndexController@edit')->name('dictionary.edit');

    // Settings
    Route::group(['prefix'=>'/settings', 'as' => 'settings.'], function () {

        Route::resources([
            '/' => 'Dashboard\IndexController',
            'seo' => 'Dashboard\SeoController',
            'social' => 'Dashboard\SocialController',
            'popup' => 'Dashboard\PopupController'
        ]);
    });

    Route::get('logs', 'Log\IndexController@index')->name('log.index');
    Route::get('logs/datatable', 'Log\IndexController@datatable')->name('log.datatable');

    Route::group(['namespace' => 'File', 'middleware' => 'file_owner', 'as' => 'file-catalog.'], function () {
        Route::get('file-catalog/{file_catalog}', 'CatalogController@show')->name('show');
        Route::get('file-catalog/{file_catalog}/edit', 'CatalogController@edit')->name('edit');
    });

    Route::group(['namespace' => 'File', 'prefix'=>'/file', 'as' => 'file.'], function () {
        Route::get('{file}/download', 'IndexController@download')->name('download');
        Route::get('file-catalog/{file}/create', 'CatalogController@create')->name('create.catalog');
        Route::get('file-catalog/{file}/create-file', 'IndexController@create')->name('create.file-file');
    });

    Route::group(['namespace' => 'Rodo', 'prefix' => '/rodo', 'as' => 'rodo.'], function () {

        Route::resources([
            'rules' => 'RulesController',
            'settings' => 'SettingsController',
            'clients' => 'ClientController'
        ]);

    });

// CRM
    Route::group(['namespace' => 'Crm', 'prefix' => '/crm', 'as' => 'crm.'], function () {

        Route::resources([
            'custom-fields' => 'CustomField\IndexController'
        ]);

        Route::get('inbox', 'Inbox\IndexController@index')->name('inbox.index');
        Route::get('inbox/datatable', 'Inbox\IndexController@datatable')->name('inbox.datatable');
        Route::get('inbox/raport', 'Inbox\RaportController@index')->name('inbox.raport');

        Route::group(['namespace' => 'Client','prefix'=>'/clients', 'as' => 'clients.'], function () {

            Route::get('/', 'IndexController@index')->name('index');
            Route::get('/datatable', 'IndexController@datatable')->name('datatable');
            Route::get('/{client}', 'IndexController@show')->name('show');

            Route::get('{client}/calendar', 'CalendarController@index')->name('calendar');
            Route::get('{client}/rodo', 'RodoController@show')->name('rodo');

            // Client files
            Route::get('{client}/files', 'FileController@show')->name('files');
            Route::post('{client}/files', 'FileController@store')->name('files.store');
            Route::post('{client}/files/create', 'FileController@create')->name('files.create');
            Route::delete('{client}/files/{clientFile}', 'FileController@destroy')->name('file.destroy');

            // Client file description
            Route::post('file-desc/{clientFile}/form', 'FileController@form')->name('file.desc.form');
            Route::post('file-desc/{clientFile}', 'FileController@storeDesc')->name('file.desc.store');
            Route::delete('file-desc/{clientFile}', 'FileController@destroyDesc')->name('file.desc.destroy');

            // Client notes
            Route::get('{client}/notes', 'NoteController@show')->name('notes');
            Route::post('{client}/notes', 'NoteController@store')->name('notes.store');
            Route::put('{client}/notes/{note}', 'NoteController@update')->name('notes.update');
            Route::delete('{client}/notes/{note}', 'NoteController@destroy')->name('notes.destroy');

            // Client calendar
            Route::get('{client}/events', 'CalendarController@show')->name('events.show');
            Route::post('{client}/events/form', 'CalendarController@create')->name('events.create');

            // Client chat
            Route::group(['prefix'=>'{client}/chat', 'as' => 'chat.'], function () {
                Route::get('/', 'ChatController@show')->name('show');
                Route::post('/form', 'ChatController@form')->name('form');
                Route::post('/mark', 'ChatController@mark')->name('mark');
                Route::post('/', 'ChatController@create')->name('create');
            });
        });

        Route::group(['namespace' => 'Board','prefix'=>'/board', 'as' => 'board.'], function () {

            // Main board
            Route::get('/', 'IndexController@index')->name('index');

            // Stages
            Route::post('/stage/form', 'StageController@form')->name('stage.form');
            Route::post('/stage', 'StageController@store')->name('stage.store');
            Route::post('/stage/sort', 'StageController@sort')->name('stage.sort');

            // Tasks
            Route::post('/task/form', 'TaskController@form')->name('task.form');
            Route::post('/task', 'TaskController@store')->name('task.store');
            Route::delete('/task/{task}', 'TaskController@destroy')->name('task.destroy');
            Route::post('/task/sort', 'TaskController@sort')->name('task.sort');

        });

        Route::group(['namespace' => 'Calendar','prefix'=>'/calendar', 'as' => 'calendar.'], function () {
            Route::get('/', 'IndexController@index')->name('index');
            Route::post('/', 'IndexController@store')->name('store');
            Route::get('/events', 'IndexController@show')->name('show');

            Route::put('{event}/move', 'IndexController@move')->name('event.move');
            Route::delete('{event}/delete', 'IndexController@destroy')->name('event.destroy');

            Route::post('form', 'IndexController@create')->name('create');
        });

    });

// DeveloPro
    Route::group(['namespace' => 'Developro', 'prefix' => '/developro', 'as' => 'developro.'], function () {

        Route::resources([
            'investment' => 'Investment\IndexController'
        ]);

        Route::group(['prefix' => '/investment', 'as' => 'investment.'], function () {
            Route::resources([
                '{investment}/plan' => 'Plan\IndexController',
                '{investment}/search' => 'Search\IndexController',
                '{investment}/houses' => 'House\HouseController',
                '{investment}/floors' => 'Floor\FloorController',
                '{investment}/floor/{floor}/properties' => 'Property\PropertyController',
                '{investment}/buildings' => 'Building\BuildingController',
                '{investment}/building.floors' => 'Building\BuildingFloorController',
                '{investment}/building.floor.properties' => 'Building\BuildingPropertyController',
                '{investment}/property/{property}/message' => 'MessageController',
            ]);

            Route::get('{investment}/floors/{floor}/copy', 'Floor\FloorController@copy')->name('floors.copy');
            Route::get('{investment}/building/{building}/floors/{floor}/copy', 'Building\BuildingFloorController@copy')->name('building.floors.copy');
            Route::get('{investment}/property/{property}/copy', 'Property\PropertyController@copy')->name('property.copy');
        });
    });
});

Route::group(['prefix' => '{locale?}', 'where' => ['locale' => '(?!admin)*[a-z]{2}'], 'middleware' => 'web'], function() {
    Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)')->name('subupage');
});
