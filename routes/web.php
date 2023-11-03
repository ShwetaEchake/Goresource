<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OfferLetterController;
use App\Http\Controllers\PreMedicalController;
use App\Http\Controllers\QvcProcessController;
use App\Http\Controllers\VisaProcessController;
use App\Http\Controllers\JobAppliedController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\AdvertismentController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PostAssessmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\EmailTemplatesController;
use App\Http\Controllers\SmsTemplatesController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MedicalExaminationCenterController;
use App\Http\Controllers\EnquiryDocumenttypeController;
use App\Http\Controllers\CallStatusController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CandidateInterviewController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\EnquiryController;




use App\Models\Users;
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

Route::get('/', function () {
    return redirect(route('login'));
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   


    Route::resource('user', 'UserController');
    Route::resource('personal', 'PersonalController');
    Route::resource('executive', 'ExecutiveController');
    Route::resource('category', 'CategoryController');
    Route::resource('enquirychecklist', 'EnquiryChecklistController');
    Route::resource('locations', 'LocationsController');
    Route::resource('emailtemplate', 'EmailTemplatesController');
    Route::resource('smstemplate', 'SmsTemplatesController');
    Route::resource('role', 'RoleController');
    Route::resource('branch', 'BranchController');
    Route::resource('country', 'CountryController');
    Route::resource('language','LanguageController');
    Route::resource('medicalexaminationcenter','MedicalExaminationCenterController');
    Route::resource('enquirydocumenttype','EnquiryDocumenttypeController');
     Route::resource('cities', 'CitiesController');
     Route::resource('state', 'StateController');

Route::get('/status-update/{id}/{location_id}/{applied_id}','JobAppliedController@status_update');
Route::get('/deleteApplicants/{id}/{location_id}/{applied_id}','JobAppliedController@deleteApplicants');

Route::get('/update_status/{id}/{location_id}/{applied_id}','EnrollmentController@update_status');




  Route::get('getAssessment',[AssessmentController::class,'getAssessment'])->name('getAssessment');
  Route::get('getPostAssessment',[PostAssessmentController::class,'getPostAssessment'])->name('getPostAssessment');
  Route::get('getInterview',[InterviewController::class,'getInterview'])->name('getInterview');
  Route::get('getOfferLetter',[OfferLetterController::class,'getOfferLetter'])->name('getOfferLetter');
  Route::get('getPreMedical',[PreMedicalController::class,'getPreMedical'])->name('getPreMedical');
  Route::get('getQvc',[QvcProcessController::class,'getQvc'])->name('getQvc');
  Route::get('getVisa',[VisaProcessController::class,'getVisa'])->name('getVisa');
  Route::get('getDeployment',[DeploymentController::class,'getDeployment'])->name('getDeployment');
  Route::get('getCallStatus',[CallStatusController::class,'getCallStatus'])->name('getCallStatus');

//view
  Route::get('getCandidateInterview',[CandidateInterviewController::class,'getCandidateInterview'])->name('getCandidateInterview');



    Route::resource('client','ClientController');
    Route::resource('enquiry','EnquiryController');
    Route::resource('projectlocation','ProjectLocationController');


    Route::resource('job','JobController');
    Route::resource('advertisment','AdvertismentController');


    //Route::resource('assessment','AssessmentController');
Route::resource('assessment', 'AssessmentController')->except(['create']);
Route::get('assessment/create/{id}', 'AssessmentController@create')->name('assessment.create');

 


    Route::resource('interview', 'InterviewController');
    Route::resource('enrollment','EnrollmentController');
    Route::resource('selection','SelectionController');
    Route::resource('offerletter','OfferLetterController');
    Route::resource('premedical', 'PreMedicalController');
    Route::resource('qvcprocess','QvcProcessController'); 
    Route::resource('visaprocess','VisaProcessController');
    Route::resource('deployment','DeploymentController');
    Route::resource('postassessment','PostAssessmentController');
    Route::resource('jobapplied','JobAppliedController');
    Route::resource('documenttype','DocumentTypeController');
    Route::resource('callstatus','CallStatusController');
    Route::resource('candidateinterview','CandidateInterviewController');
    Route::resource('templatemaster','TemplateController');





  Route::get('getCategory',[JobController::class, 'getCategory'])->name('getCategory');
  Route::get('getEnquiry',[JobController::class, 'getEnquiry'])->name('getEnquiry');

  Route::get('/advance', 'PersonalController@advance')->name('advance_search');


  Route::get('getEnquiry',[HomeController::class, 'getEnquiry'])->name('getEnquiry');
  Route::get('getJob',[HomeController::class, 'getJob'])->name('getJob');

  Route::get('getEnquiryReports',[ReportsController::class, 'getEnquiryReports'])->name('getEnquiryReports');
  Route::get('getJobReports',[ReportsController::class, 'getJobReports'])->name('getJobReports');

  Route::get('getEnquirydata',[InterviewController::class, 'getEnquirydata'])->name('getEnquirydata');
  Route::get('getJobdata',[InterviewController::class, 'getJobdata'])->name('getJobdata');







  // Route::get('getEnquiryOffer',[OfferLetterController::class, 'getEnquiryOffer'])->name('getEnquiryOffer');
  // Route::get('getJobOffer',[OfferLetterController::class, 'getJobOffer'])->name('getJobOffer');

  // Route::get('getEnquiryPre',[PreMedicalController::class, 'getEnquiryPre'])->name('getEnquiryPre');
  // Route::get('getJobPre',[PreMedicalController::class, 'getJobPre'])->name('getJobPre');
  

  // Route::get('getEnquiryQvc',[QvcProcessController::class, 'getEnquiryQvc'])->name('getEnquiryQvc');
  // Route::get('getJobQvc',[QvcProcessController::class, 'getJobQvc'])->name('getJobQvc');


  // Route::get('getEnquiryVisa',[VisaProcessController::class, 'getEnquiryVisa'])->name('getEnquiryVisa');
  // Route::get('getJobVisa',[VisaProcessController::class, 'getJobVisa'])->name('getJobVisa');


  Route::get('getEnquiryJobapplied',[JobAppliedController::class, 'getEnquiryJobapplied'])->name('getEnquiryJobapplied');
  Route::get('getJobJobapplied',[JobAppliedController::class, 'getJobJobapplied'])->name('getJobJobapplied');

  // Route::get('getEnquirySelection',[SelectionController::class, 'getEnquirySelection'])->name('getEnquirySelection');
  // Route::get('getJobSelection',[SelectionController::class, 'getJobSelection'])->name('getJobSelection');


  // Route::get('getEnquiryAdd',[AdvertismentController::class, 'getEnquiryAdd'])->name('getEnquiryAdd');
  // Route::get('getJobAdd',[AdvertismentController::class, 'getJobAdd'])->name('getJobAdd');









         //Route::get('mypdf', 'EnquiryController@mypdf')->name('mypdf');  <!-- mypdfprivious -->
         Route::get('/mypdf/{id}',[EnquiryController::class,'mypdf'])->name('mypdf');

         Route::get('pdf', 'PersonalController@pdf')->name('pdf');
       
         Route::get('add', 'AdvertismentController@add')->name('add');
         Route::get('CandOfferLetter', 'OfferLetterController@ShowOfferletter')->name('SendOffer');

         
    Route::get('getmailtemplate',[PersonalController::class, 'getmailtemplate'])->name('getmailtemplate');
    Route::get('getsmstemplate',[PersonalController::class, 'getsmstemplate'])->name('getsmstemplate');
    Route::post('/jobassign',[JobAppliedController::class,'deleteCheckedCustomers'])->name('jobassign.deleteCheckedCustomers');




Route::get('export', 'JobAppliedController@export');
Route::get('Personalexport', 'PersonalController@Personalexport');


Route::match(['get','post'],'personal/shortlist',[PersonalController::class,'shortlist'] )->name("shortlist"); 
Route::match(['get','post'],'emailtemplate/email',[EmailTemplatesController::class,'email'] )->name("email"); 
Route::match(['get','post'],'smstemplate/SendSMS',[SmsTemplatesController::class,'SendSMS'] )->name("SendSMS"); 

  


Route::get('/download_zip/{id}/{job_id}/{location_id}','DeploymentController@download_zip');

Route::match(['get','post'],'offerletter/change',[OfferLetterController::class,'change'] )->name("change"); 


Route::match(['get','post'],'visaprocess/evstatuschange',[VisaProcessController::class,'evstatuschange'] )->name("evstatuschange"); 



Route::get('template', 'EnquiryController@template')->name('template');
Route::get('document', 'EnquiryController@document')->name('document');



    //Route::resource('dashboard', 'DashboardController');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


     Route::get('/soa','ReportsController@soa');
     Route::get('/isl','ReportsController@isl');
     Route::get('/salary','ReportsController@salary');

     Route::get('/firebase', [App\Http\Controllers\NotificationController::class, 'index'])->name('firebase');
    Route::post('/save-token', [App\Http\Controllers\NotificationController::class, 'saveToken'])->name('save-token');
Route::post('/send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send.notification');

  

Route::match(['get','post'],'offerletter/sendOfferletter',[OfferLetterController::class,'sendOfferletter'] )->name("sendOfferletter"); 
    Route::match(['get','post'],'/calendar',[DashboardController::class,'systemCalendar'] )->name("systemCalendar"); 




//----------------------- view pdf candidate assmnt to depymnt---------------

         Route::get('assmntprint', 'AssessmentController@assessmentPrint')->name('assessmentPrint');
         Route::get('postassmntprint', 'PostAssessmentController@postassessmentPrint')->name('postassessmentPrint');
         Route::get('viewinterviewprint', 'InterviewController@viewinterviewPrint')->name('viewinterviewPrint');
         Route::get('offerformprint', 'OfferLetterController@offerformPrint')->name('offerformPrint');
         Route::get('premedicalprint', 'PreMedicalController@premedicalPrint')->name('premedicalPrint');
         Route::get('qvcprint', 'QvcProcessController@qvcPrint')->name('qvcPrint');
         Route::get('visaprint', 'VisaProcessController@visaPrint')->name('visaPrint');
         Route::get('deploymentprint', 'DeploymentController@deploymentPrint')->name('deploymentPrint');


 Route::get('getState',[ClientController::class, 'getState'])->name('getState');
 Route::get('getCity',[ClientController::class, 'getCity'])->name('getCity');

 Route::get('getCurrency',[ClientController::class, 'getCurrency'])->name('getCurrency');
 Route::get('getCountryCode',[PersonalController::class, 'getCountryCode'])->name('getCountryCode');
 Route::get('getLocation',[PersonalController::class, 'getLocation'])->name('getLocation');


     // Route::get('/invoice', [App\Http\Controllers\DashboardController::class, 'InvoiceData'])->name('invoice');

    Route::resource('invoice','InvoiceController');


    // Route::match(['get','post'],'/user/{id}/edit',[User::class,'update'] )->name("editUser"); 

    // Route::match(['get','post'],'/card/{id}/edit',[Card::class,'update'] )->name("editCard"); 
    // Route::match(['get','post'],'/cardtype/{id}/edit',[CardType::class,'update'] )->name("editCardType"); 
    // Route::match(['get','post'],'/partners/{id}/edit',[Partners::class,'update'] )->name("editPartners"); 


    Route::resource('helpmenu','ExecutiveController');

});


// Route::group(['middleware' => ['auth', 'role_or_permission:admin|create role|create permission']], function() {

//     Route::resource('role', 'RoleController');


// });

Auth::routes();

//////////////////////////////// axios request

