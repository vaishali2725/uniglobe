<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Main_Controller';
$route['UserLogin'] = 'Main_Controller/userLogin';
$route['forgotPassword'] = 'Main_Controller/forgotPassword';
$route['getUserInfo'] = 'Main_Controller/getUserInfo';
$route['getUserTask'] = 'Main_Controller/getUserTask';
$route['deleteTask'] = 'Main_Controller/deleteTask';
$route['deleteUser'] = 'Main_Controller/deleteUser';
$route['addTask'] = 'Main_Controller/addTask';
$route['addUser'] = 'Main_Controller/addUser';
$route['getUsers'] = 'Main_Controller/getUsers';
$route['getUserName'] = 'Main_Controller/getUserName';
$route['addLeads'] = 'Main_Controller/addLeads';
$route['getLeads'] = 'Main_Controller/getLeads';
$route['deleteLead'] = 'Main_Controller/deleteLead';
$route['total_leads'] = 'Main_Controller/total_leads';
$route['completed_leads'] = 'Main_Controller/completed_leads';
$route['pending_leads'] = 'Main_Controller/pending_leads';
$route['getMyLeads'] = 'Main_Controller/getMyLeads';
$route['getLeadById'] = 'Main_Controller/getLeadById';
$route['getMyProfileInfo'] = 'Main_Controller/getMyProfileInfo';
$route['addAction'] = 'Main_Controller/addAction';
$route['updateUser'] = 'Main_Controller/updateUser';
$route['addLeadToMyList'] = 'Main_Controller/addLeadToMyList';
$route['addReminder'] = 'Main_Controller/addReminder';
$route['getreminders'] = 'Main_Controller/getreminders';
$route['deletereminder'] = 'Main_Controller/deletereminder';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
