<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/addstudent','StudentsController::insert');
$routes->put('/updatestudent/(:num)','StudentsController::update/$1');
$routes->get('/getstudents','StudentsController::getStudents');
$routes->get('/getstudent/(:num)', 'StudentsController::getStudent/$1');
$routes->delete('/student/(:num)','StudentsController::delete/$1');

