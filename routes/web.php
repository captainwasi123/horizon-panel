<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Auth Routes */
	Route::get('/', 'authController@dashboardView');
	Route::get('/login', 'authController@loginView');
	Route::get('/logout', 'authController@logout');
	Route::post('/login', 'authController@loginAttempt');

	Route::prefix('users')->group(function(){
		Route::get('/', 'authController@users');
		Route::get('/Add', 'authController@addUser');
		Route::get('/delete/{id}', 'authController@deleteUser');
		Route::get('/edit/{id}', 'authController@editUser');
		Route::get('/inactive/{id}', 'authController@inactiveUser');
		Route::get('/active/{id}', 'authController@activeUser');
		Route::post('/insert', 'authController@insertUser');
		Route::post('/update', 'authController@updateUser');


		Route::get('/log', 'authController@userLog');
		Route::post('/log', 'authController@userLogSubmit');


		Route::prefix('team')->group(function(){

			Route::get('/', 'settingController@team')->name('user.team');
			Route::post('/add', 'settingController@addTeam')->name('user.team.add');
		});
	});

//Building Material

	Route::prefix('hbm')->middleware('hbmauth')->group(function(){

		Route::get('queries', 'hbmController@queries')->name('hbm.queries');
		Route::post('queries', 'hbmController@queriesSubmit');


		Route::get('queries/add', 'hbmController@queriesAdd')->name('hbm.queries.add');
		Route::get('query/delete/{id}', 'hbmController@deleteQuery');
		Route::get('query/sale/{id}', 'hbmController@saleQuery');
		Route::get('query/query/{id}', 'hbmController@sendQuery');
		Route::post('queries/add', 'hbmController@queriesInsert')->name('hbm.queries.insert');


		Route::get('sales', 'hbmController@sales')->name('hbm.sales');
		Route::post('sales', 'hbmController@salesSubmit');

		//Remarks
		Route::get('query/remarks/load/{id}', 'hbmController@loadRemarks');
		Route::post('query/remarks/add', 'hbmController@remarksInsert')->name('hbm.remarks.insert');
	});


/* Leads Route */

	Route::prefix('query')->group(function(){
		Route::get('add', 'leadsController@addLead');
		Route::get('delete/{id}', 'leadsController@deleteLead');
		Route::get('edit/{id}', 'leadsController@editLead');
		Route::get('convert/{id}', 'leadsController@convertLead');
		Route::get('status/{status}/{id}', 'leadsController@queryStatus');
		Route::get('pre-potential/{id}', 'leadsController@prePotential');

		Route::get('total', 'leadsController@totalQueries');
		Route::post('total', 'leadsController@totalQueriesSubmit');

		Route::get('potential', 'leadsController@potentialQueries');
		Route::post('potential', 'leadsController@potentialQueriesSubmit');


		Route::get('superPotential', 'leadsController@superpotentialQueries');
		Route::post('superPotential', 'leadsController@superpotentialQueriesSubmit');

		Route::post('assign/person', 'leadsController@assignPerson');
		Route::post('visitDate', 'leadsController@setVisitDate');

		Route::get('total/{id}/{name}', 'leadsController@totalCategory');
	});

	Route::prefix('leads')->group(function(){
		Route::post('insert', 'leadsController@insertLead');
		Route::post('update', 'leadsController@updateLead');
		Route::post('remarks/add', 'leadsController@insertRemarks');

		Route::get('pending', 'leadsController@pendingLeads');
		Route::post('pending', 'leadsController@pendingLeadsSubmit');

		Route::get('remarks/load/{id}', 'leadsController@loadRemarks');
	});

	//Bahria
	Route::prefix('bahria')->group(function(){

		Route::prefix('query')->group(function(){
			Route::get('add', 'bahriaLeadsController@addLead');
			Route::get('delete/{id}', 'bahriaLeadsController@deleteLead');
			Route::get('edit/{id}', 'bahriaLeadsController@editLead');
			Route::get('convert/{id}', 'bahriaLeadsController@convertLead');
			Route::get('status/{status}/{id}', 'bahriaLeadsController@queryStatus');

			Route::get('total', 'bahriaLeadsController@totalQueries');
			Route::post('total', 'bahriaLeadsController@totalQueriesSubmit');

			Route::get('potential', 'bahriaLeadsController@potentialQueries');
			Route::post('potential', 'bahriaLeadsController@potentialQueriesSubmit');


			Route::get('superPotential', 'bahriaLeadsController@superpotentialQueries');
			Route::post('superPotential', 'bahriaLeadsController@superpotentialQueriesSubmit');

			Route::post('assign/person', 'bahriaLeadsController@assignPerson');
			Route::post('visitDate', 'bahriaLeadsController@setVisitDate');


			Route::get('total/{id}/{name}', 'bahriaLeadsController@totalCategory');
		});

		Route::prefix('leads')->group(function(){

			Route::get('pending', 'bahriaLeadsController@pendingLeads');
			Route::post('pending', 'bahriaLeadsController@pendingLeadsSubmit');
		});
	});

/* Sales Route */
	
	Route::get('/sales/leads/total', 'salesController@totalLeads');
	Route::post('/sales/leads/total', 'salesController@totalLeadsSubmit');

	Route::get('/sales/leads/potential', 'salesController@potentialleads');
	Route::post('/sales/leads/potential', 'salesController@potentialleadsSubmit');

	Route::post('/sales/leads/potential/target', 'salesController@potentialleadsTarget');


	Route::get('/sales/quotation/{id}', 'salesController@quotationPlan');
	Route::post('/sales/quotation/add', 'salesController@quotationPlanAdd');
	Route::get('/sales/quotation/delete/{id}', 'salesController@quotationPlanDelete');

	//Bahria
	Route::prefix('bahria')->group(function(){

		Route::get('leads/total', 'salesController@totalLeads');
		Route::post('leads/total', 'salesController@totalLeadsSubmit');

		Route::get('leads/potential', 'salesController@potentialleads');
		Route::post('leads/potential', 'salesController@potentialleadsSubmit');

		Route::post('leads/potential/target', 'salesController@potentialleadsTarget');


		Route::get('quotation/{id}', 'salesController@quotationPlan');
		Route::post('quotation/add', 'salesController@quotationPlanAdd');
		Route::get('quotation/delete/{id}', 'salesController@quotationPlanDelete');
	});

/* Target Agent Route */

	Route::get('/clientTarget', 'salesController@clientTarget');

/* Planning Route */

	Route::get('/planning/leads', 'planningController@leads');
	Route::post('/planning/leads', 'planningController@leadsSubmit');

/* Documentation Route */

	Route::get('/documentation/leads', 'documentationController@leads');
	Route::get('/documentation/leads/detail/{id}', 'documentationController@leadDetail');
	Route::post('/documentation/leads', 'documentationController@leadsSubmit');

	Route::post('/documentation/update', 'documentationController@updateDocument');

/* Construction Route */

	Route::get('/construction/requisition', 'constructionController@requisition');
	Route::get('/construction/requisition/add', 'constructionController@addRequisition');
	Route::post('/construction/requisition/insert', 'constructionController@insertRequisition');
	Route::get('/construction/requisition/edit/{id}', 'constructionController@editRequisition');
	Route::post('/construction/requisition/update', 'constructionController@updateRequisition');

	Route::get('/construction/workflow', 'constructionController@workflow');
	Route::post('/construction/workflow', 'constructionController@workflowSubmit');
	Route::get('/construction/workflow/{id}', 'constructionController@workflowDetail');
	Route::get('/construction/workflow/delete/{id}', 'constructionController@workflowDelete');
	Route::post('/construction/workflow/generate', 'constructionController@workflowGenerate');

	Route::post('/constRequisition/remarks/add', 'constructionController@insertRemarks');


/* Supply Chain Route */

	Route::get('/supplyChain/requisition', 'supplyChainController@requisition');
	Route::get('/supplyChain/requisition/status/{status}/{id}', 'supplyChainController@requisitionChangeStatus');


/* Approval Route */

	Route::get('/approval/construction_requisition', 'approvalController@constRequisition');




/* Settings */
	
	/* Work Flow */

		Route::get('/setting/workflow', 'settingController@workflow');
		Route::get('/setting/workflow/add', 'settingController@addWorkflow');
		Route::post('/setting/workflow/add', 'settingController@insertWorkflow');
		Route::get('/setting/workflow/edit/{id}', 'settingController@editWorkflow');
		Route::post('/setting/workflow/update', 'settingController@updateWorkflow');