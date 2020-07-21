<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->get('response/{status}/{message}', [
        'uses' => 'Controller@apiResponse'
    ]);

    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->group(['prefix' => 'posts'], function () use ($router) {
            $router->get('/', 'PostController@get');
            $router->get('/all', 'PostController@getAll');
            $router->post('/store', 'PostController@store');
            $router->put('/update', 'PostController@update');
            $router->post('/delete', 'PostController@delete');
        });

        $router->get('user/', 'AdminController@getSingleUser');
        $router->get('user/all', 'AdminController@getAllUser');
        $router->post('mahasiswa/store', [
            'as' => 'api.admin.mahasiswa.store', 'uses' => 'AdminController@createMahasiswa'
        ]);
        $router->post('konselor/store', [
          'as' => 'api.admin.konselor.store', 'uses' => 'AdminController@createKonselor'
        ]);
        $router->post('pembantu_direktur/store', [
            'as' => 'api.admin.pembantu_direktur.store', 'uses' => 'AdminController@createPembantuDirektur'
        ]);
    });

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->put('/update', [
            'as' => 'api.user.update', 'uses' => 'UserController@update'
        ]);
        $router->get('/profile', [
            'as' => 'api.user.profile', 'uses' => 'UserController@profile'
        ]);
    });

    $router->group(['prefix' => 'mahasiswa'], function () use ($router) {
        $router->put('/update', [
            'as' => 'api.mahasiswa.update', 'uses' => 'MahasiswaController@update'
        ]);
        $router->post('/konseling/store', 'KonselingController@store');
        $router->get('/konseling', [
            'as' => 'api.mahasiswa.konseling', 'uses' => 'KonselingController@getOneByMahasiswa'
        ]);
        $router->get('/konselor', [
            'as' => 'api.konselor.getAll', 'uses' => 'MahasiswaController@getAllKonselor'
        ]);
    });

    $router->group(['prefix' => 'pd3'], function () use ($router) {
        $router->get('/konseling', [
            'as' => 'api.pd3.konseling', 'uses' => 'PDController@getDataKonseling'
        ]);
        // $router->get('/konselor', [
        //     'as' => 'api.pd3.konselor', 'uses' => 'PDController@getKonselor'
        // ]);
        // $router->get('/mahasiswa', [
        //     'as' => 'api.pd3.mahasiswa', 'uses' => 'PDController@getMahasiswa'
        // ]);
        $router->post('/tahunan', [
            'as' => 'api.pd3.tahunan', 'uses' => 'PDController@getDataTahunan'
        ]);
        $router->post('/bulanan', [
            'as' => 'api.pd3.bulanan', 'uses' => 'PDController@getDataBulanan'
        ]);
    });

    $router->group(['prefix' => 'konseling'], function () use ($router) {
        $router->get('/all', [
          'as' => 'api.konseling.all', 'uses' => 'KonselingController@getAll'
        ]);
        $router->post('/one', [
            'as' => 'api.konseling.one', 'uses' => 'KonselingController@getOne'
        ]);
        $router->get('/next', [
            'as' => 'api.konseling.next', 'uses' => 'KonselingController@getKonselingMendatang'
        ]);
        $router->post('/mahasiswa', [
            'as' => 'api.konseling.mahasiswa', 'uses' => 'KonselingController@getOneByMahasiswa'
        ]);
        $router->post('/konselor', [
            'as' => 'api.konseling.konselor', 'uses' => 'KonselingController@getOneByKonselor'
        ]);
        $router->put('/updatebymahasiswa', [
            'as' => 'api.konseling.updateByMahasiswa', 'uses' => 'KonselingController@updateByMahasiswa'
        ]);
        $router->put('/updatebykonselor', [
            'as' => 'api.konseling.updateByKonselor', 'uses' => 'KonselingController@updateByKonselor'
        ]);
    });


    $router->group(['prefix' => 'program_studi'], function () use ($router) {
        $router->get('/', [
            'as' => 'api.program_studi', 'uses' => 'ProgramStudiController@get'
        ]);
        $router->get('/all', [
            'as' => 'api.program_studi.all', 'uses' => 'ProgramStudiController@getAll'
        ]);
        $router->get('/jurusan', [
            'as' => 'api.program_studi.jurusan', 'uses' => 'ProgramStudiController@getProgramStudiByJurusan'
        ]);
    });

    $router->group(['prefix' => 'jurusan'], function () use ($router) {
        $router->get('/', [
            'as' => 'api.jurusan', 'uses' => 'JurusanController@get'
        ]);
        $router->get('/all', [
            'as' => 'api.jurusan.all', 'uses' => 'JurusanController@getAll'
        ]);
    });

    $router->group(['prefix' => 'konselor'], function () use ($router) {
        $router->get('/all', [
            'as' => 'api.jurusan', 'uses' => 'KonselorController@getAll'
        ]);
    });
});
