<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Main_Controller';
$route['UserLogin'] = 'Main_Controller/userLogin';
$route['UserLogout'] = 'Main_Controller/userLogout';
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
$route['editLead'] = 'Main_Controller/editLead';
$route['transferLead'] = 'Main_Controller/transferLead';
$route['updateLead'] = 'Main_Controller/updateLead';
$route['updateData'] = 'Main_Controller/updateData';
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
$route['changePassword'] = 'Main_Controller/changePassword';
$route['getUpcomingReminders'] = 'Main_Controller/getUpcomingReminders';
$route['getPendingLeads'] = 'Main_Controller/getPendingLeads';
$route['get_selecteduser_data'] = 'Report_Controller/get_selecteduser_data';
$route['get_ComLeads'] = 'Report_Controller/get_ComLeads';
$route['get_callbkLeads'] = 'Report_Controller/get_callbkLeads';
$route['get_firstcall_leads'] = 'Report_Controller/get_firstcall_leads';
$route['get_followup_leads'] = 'Report_Controller/get_followup_leads';
$route['get_firstcall_leads'] = 'Report_Controller/get_firstcall_leads';
$route['get_followup_leads'] = 'Report_Controller/get_followup_leads';
$route['get_selecteduser_leads'] = 'Report_Controller/get_selecteduser_leads';
$route['get_selecteduser_data'] = 'Report_Controller/get_selecteduser_data';
$route['getallleads'] = 'Report_Controller/getallleads';
$route['get_last_month_leads'] = 'Report_Controller/get_last_month_leads';
$route['get_last_week_leads'] = 'Report_Controller/get_last_week_leads';
$route['get_leads_bydate'] = 'Report_Controller/get_leads_bydate';
$route['get_leads'] = 'Report_Controller/get_leads';
$route['leaderBoard'] = 'Main_Controller/leaderboard';
$route['forgotPassword'] = 'Report_Controller/forgotPassword';
$route['updatepassword'] = 'Report_Controller/updatepassword';
$route['changepassword'] = 'Report_Controller/changepassword';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
