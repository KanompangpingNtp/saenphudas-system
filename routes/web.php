<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\disability\AdminDisabilityController;
use App\Http\Controllers\disability\DisabilityController;
use App\Http\Controllers\general_requests\AdminGeneralRequestsController;
use App\Http\Controllers\general_requests\GeneralRequestsController;
use App\Http\Controllers\elderly_allowance\AdminElderlyAllowanceController;
use App\Http\Controllers\elderly_allowance\ElderlyAllowanceController;
use App\Http\Controllers\receive_assistance\AdminReceiveAssistanceController;
use App\Http\Controllers\receive_assistance\ReceiveAssistanceController;
use App\Http\Controllers\change_in_use\AdminChangeInUse;
use App\Http\Controllers\change_in_use\ChangeInUse;
use App\Http\Controllers\license_tax\AdminLicenseTax;
use App\Http\Controllers\license_tax\LicenseTax;
use App\Http\Controllers\recruiting_children\AdminRecruitingChildrenController;
use App\Http\Controllers\recruiting_children\RecruitingChildrenController;
use App\Http\Controllers\pay_tax_build_and_room\AdminPayTaxBuildAndRoom;
use App\Http\Controllers\pay_tax_build_and_room\PayTaxBuildAndRoom;
use App\Http\Controllers\land_building_tax_appeals\AdminLandBuildingTaxAppealController;
use App\Http\Controllers\land_building_tax_appeals\LandBuildingTaxAppealController;
use App\Http\Controllers\tax_refund_requests\AdminLandTaxRefundRequestController;
use App\Http\Controllers\tax_refund_requests\LandTaxRefundRequestController;
use App\Http\Controllers\garbage_collection\AdminGarbageCollectionController;
use App\Http\Controllers\garbage_collection\GarbageCollectionController;
use App\Http\Controllers\emergency\EmergencyController;
use App\Http\Controllers\waste_payment\AdminWastePaymentController;
use App\Http\Controllers\waste_payment\UserWastePaymentController;
use App\Http\Controllers\waste_payment\CheckValuetrashController;
use App\Http\Controllers\waste_payment\StatusTrashController;
use App\Http\Controllers\waste_payment\TrashToxicController;
use App\Http\Controllers\trash_can_installation\TrashCanInstallationController;
use App\Http\Controllers\verify_payment\VerifyPaymentController;
use App\Http\Controllers\payment_history\PaymentHistoryController;
use App\Http\Controllers\trash_installer\TrashInstallerController;
use App\Http\Controllers\non_payment\NonPaymentController;
use App\Http\Controllers\health_hazard_applications\AdminHealthHazardApplicationController;
use App\Http\Controllers\health_hazard_applications\HealthHazardApplicationController;
use App\Http\Controllers\food_storage_license\AdminFoodStorageLicenseController;
use App\Http\Controllers\food_storage_license\FoodStorageLicenseController;
use App\Http\Controllers\private_market\AdminPrivateMarketController;
use App\Http\Controllers\private_market\PrivateMarketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//test
Route::view('/test', 'home.trash-page');

Route::get('/', [HomeController::class, 'Home'])->name('Home');
Route::get('/eservice', [HomeController::class, 'Eservice'])->name('Eservice');

//auth
Route::get('/login-page', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/register-page', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::post('/register', [AuthController::class, 'Register'])->name('Register');
Route::post('/login', [AuthController::class, 'Login'])->name('Login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//คำร้องทั่วไป
Route::get('/general-requests', [GeneralRequestsController::class, 'GeneralRequestsFormPage'])->name('GeneralRequestsFormPage');
Route::post('/general-requests/form/create', [GeneralRequestsController::class, 'GeneralRequestsFormCreate'])->name('GeneralRequestsFormCreate');

//แบบยืนยันสิทธิผู้สูงอายุ
Route::get('/elderly-allowance', [ElderlyAllowanceController::class, 'ElderlyAllowanceFormPage'])->name('ElderlyAllowanceFormPage');
Route::post('/elderly-allowance/form/create', [ElderlyAllowanceController::class, 'ElderlyAllowanceFormCreate'])->name('ElderlyAllowanceFormCreate');

//แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
Route::get('/disability', [DisabilityController::class, 'DisabilityFormPage'])->name('DisabilityFormPage');
Route::post('/disability/form/create', [DisabilityController::class, 'DisabilityFormCreate'])->name('DisabilityFormCreate');

//แบบคำขอรับการสงเคราะห์
Route::get('/receive_assistance', [ReceiveAssistanceController::class, 'ReceiveAssistanceFormPage'])->name('ReceiveAssistanceFormPage');
Route::post('/receive_assistance/form/create', [ReceiveAssistanceController::class, 'ReceiveAssistanceFormCreate'])->name('ReceiveAssistanceFormCreate');

//(ภ.ป.๑ แนบแสดงรายการ ภาษีป้าย)
Route::get('/license_tax', [LicenseTax::class, 'LicenseTaxFormPage'])->name('LicenseTaxFormPage');
Route::post('/license_tax/form/create', [LicenseTax::class, 'LicenseTaxFormCreate'])->name('LicenseTaxFormCreate');

//(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
Route::get('/change_in_use', [ChangeInUse::class, 'ChangeInUseFormPage'])->name('ChangeInUseFormPage');
Route::post('/change_in_use/form/create', [ChangeInUse::class, 'ChangeInUseFormCreate'])->name('ChangeInUseFormCreate');

//แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
Route::get('/ChildApply', [RecruitingChildrenController::class, 'ChildApplyPage'])->name('ChildApplyPage');
Route::post('/ChildApply/form/create', [RecruitingChildrenController::class, 'ChildApplyFormCreate'])->name('ChildApplyFormCreate');

//หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด
Route::get('/pay_tax_build_and_room', [PayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomFormPage'])->name('PayTaxBuildAndRoomFormPage');
Route::post('/pay_tax_build_and_room/form/create', [PayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomFormCreate'])->name('PayTaxBuildAndRoomFormCreate');

//คำร้องคัดค้านการประเมินภาษี
Route::get('/land_building_tax_appeals', [LandBuildingTaxAppealController::class, 'LandBuildingTaxAppealPage'])->name('LandBuildingTaxAppealPage');
Route::post('/land_building_tax_appeals/form/create', [LandBuildingTaxAppealController::class, 'LandBuildingTaxAppealFormCreate'])->name('LandBuildingTaxAppealFormCreate');

//คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
Route::get('/tax_refund_requests', [LandTaxRefundRequestController::class, 'LandTaxRefundRequestPage'])->name('LandTaxRefundRequestPage');
Route::post('/tax_refund_requests/form/create', [LandTaxRefundRequestController::class, 'LandTaxRefundRequestFormCreate'])->name('LandTaxRefundRequestFormCreate');

//ตัวแจ้งเหตุ
Route::get('/emergency', [EmergencyController::class, 'index'])->name('emergency.index');
Route::post('/emergency/send', [EmergencyController::class, 'send'])->name('emergency.send');

//
Route::get('/garbage_collection', [GarbageCollectionController::class, 'GarbageCollectionForm'])->name('GarbageCollectionForm');
Route::post('/garbage_collection/form/create', [GarbageCollectionController::class, 'GarbageCollectionFormCreate'])->name('GarbageCollectionFormCreate');

Route::middleware(['user'])->group(function () {
    Route::get('/user/index', [UserController::class, 'UserIndex'])->name('UserIndex');

    //คำร้องทั่วไป
    Route::get('/user-account/general-requests/show-details', [GeneralRequestsController::class, 'GeneralRequestsShowDetails'])->name('GeneralRequestsShowDetails');
    Route::get('/user-account/general-requests/export-pdf/{id}', [GeneralRequestsController::class, 'GeneralRequestsUserExportPDF'])->name('GeneralRequestsUserExportPDF');
    Route::post('/user-account/general-requests/reply/{id}', [GeneralRequestsController::class, 'GeneralRequestsUserReply'])->name('GeneralRequestsUserReply');
    Route::get('/user-account/general-requests/show-edit/{id}', [GeneralRequestsController::class, 'GeneralRequestsUserShowFormEdit'])->name('GeneralRequestsUserShowFormEdit');
    Route::put('/user-account/general-requests/update-data/{id}', [GeneralRequestsController::class, 'GeneralRequestsUserUpdateForm'])->name('GeneralRequestsUserUpdateForm');

    //แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
    Route::get('/user/account/Disability/record', [DisabilityController::class, 'TableDisabilityUsersPages'])->name('TableDisabilityUsersPages');
    Route::get('/user/account/Disability/{id}/edit', [DisabilityController::class, 'DisabilityUserShowEdit'])->name('DisabilityUserShowEdit');
    Route::put('/user/account/Disability/{id}/Update', [DisabilityController::class, 'DisabilityUserFormUpdate'])->name('DisabilityUserFormUpdate');
    Route::get('/user/account/Disability/{id}/pdf', [DisabilityController::class, 'DisabilityUserExportPDF'])->name('DisabilityUserExportPDF');
    Route::post('/user/account/Disability/{form}/reply', [DisabilityController::class, 'DisabilityUserReply'])->name('DisabilityUserReply');

    //แบบยืนยันสิทธิผู้สูงอายุ
    Route::get('/user-account/elderly-allowance/show-details', [ElderlyAllowanceController::class, 'ElderlyAllowanceShowDetails'])->name('ElderlyAllowanceShowDetails');
    Route::get('/user-account/elderly-allowance/export-pdf/{id}', [ElderlyAllowanceController::class, 'ElderlyAllowanceUserExportPDF'])->name('ElderlyAllowanceUserExportPDF');
    Route::post('/user-account/elderly-allowance/reply/{id}', [ElderlyAllowanceController::class, 'ElderlyAllowanceUserReply'])->name('ElderlyAllowanceUserReply');
    Route::get('/user-account/elderly-allowance/show-edit/{id}', [ElderlyAllowanceController::class, 'ElderlyAllowanceUserShowEdit'])->name('ElderlyAllowanceUserShowEdit');
    Route::put('/user-account/elderly-allowance/update-data/{id}', [ElderlyAllowanceController::class, 'ElderlyAllowanceUserUpdateForm'])->name('ElderlyAllowanceUserUpdateForm');

    //แบบคำขอรับการสงเคราะห์
    Route::get('/user/account/ReceiveAssistance/record', [ReceiveAssistanceController::class, 'TableReceiveAssistanceUsersPages'])->name('TableReceiveAssistanceUsersPages');
    Route::post('/user/account/ReceiveAssistance/{form}/reply', [ReceiveAssistanceController::class, 'ReceiveAssistanceUserReply'])->name('ReceiveAssistanceUserReply');
    Route::get('/user/account/ReceiveAssistance/{id}/pdf', [ReceiveAssistanceController::class, 'ReceiveAssistanceUserExportPDF'])->name('ReceiveAssistanceUserExportPDF');
    Route::get('/user/account/ReceiveAssistance/{id}/edit', [ReceiveAssistanceController::class, 'ReceiveAssistanceUsersShowFormEdit'])->name('ReceiveAssistanceUsersShowFormEdit');
    Route::put('/user/account/ReceiveAssistance/{id}/Update', [ReceiveAssistanceController::class, 'updateReceiveAssistance'])->name('updateReceiveAssistance');

    //(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
    Route::get('/user-account/change_in_use/show-details', [ChangeInUse::class, 'ChangeInUseShowDetails'])->name('ChangeInUseShowDetails');
    Route::get('/user-account/change_in_use/export-pdf/{id}', [ChangeInUse::class, 'ChangeInUseUserExportPDF'])->name('ChangeInUseUserExportPDF');
    Route::post('/user-account/change_in_use/reply/{id}', [ChangeInUse::class, 'ChangeInUseUserReply'])->name('ChangeInUseUserReply');

    //(ภ.ป.๑ แนบแสดงรายการ ภาษีป้าย)
    Route::get('/user-account/license_tax/show-details', [LicenseTax::class, 'LicenseTaxShowDetails'])->name('LicenseTaxShowDetails');
    Route::get('/user-account/license_tax/export-pdf/{id}', [LicenseTax::class, 'LicenseTaxUserExportPDF'])->name('LicenseTaxUserExportPDF');
    Route::post('/user-account/license_tax/reply/{id}', [LicenseTax::class, 'LicenseTaxUserReply'])->name('LicenseTaxUserReply');

    //แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
    Route::get('/user/account/RecruitingChildren/record', [RecruitingChildrenController::class, 'TableChildApplyUsersPages'])->name('TableChildApplyUsersPages');
    Route::put('/user/account/RecruitingChildren/{id}/Update', [RecruitingChildrenController::class, 'updateChildInformation'])->name('updateChildInformation');
    Route::get('/user/account/RecruitingChildren/{id}/pdf', [RecruitingChildrenController::class, 'ChildApplyUserExportPDF'])->name('ChildApplyUserExportPDF');
    Route::post('/user/account/RecruitingChildren/{form}/reply', [RecruitingChildrenController::class, 'ChildApplyUserReply'])->name('ChildApplyUserReply');

    //หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง / ห้องชุด
    Route::get('/user-account/pay_tax_build_and_room/show-details', [PayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomShowDetails'])->name('PayTaxBuildAndRoomShowDetails');
    Route::get('/user-account/pay_tax_build_and_room/export-pdf/{id}', [PayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomUserExportPDF'])->name('PayTaxBuildAndRoomUserExportPDF');
    Route::post('/user-account/pay_tax_build_and_room/reply/{id}', [PayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomUserReply'])->name('PayTaxBuildAndRoomUserReply');

    //คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง
    Route::get('/user/account/LandBuildingTaxAppeal/show-details', [LandBuildingTaxAppealController::class, 'LandBuildingTaxAppealShowDetails'])->name('LandBuildingTaxAppealShowDetails');
    Route::post('/user/account/LandBuildingTaxAppeal/{form}/reply', action: [LandBuildingTaxAppealController::class, 'LandBuildingTaxAppealUserReply'])->name('LandBuildingTaxAppealUserReply');
    Route::get('/user/account/LandBuildingTaxAppeal/{id}/pdf', [LandBuildingTaxAppealController::class, 'LandBuildingTaxAppealUserExportPDF'])->name('LandBuildingTaxAppealUserExportPDF');

    //คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
    Route::get('/user/account/TaxRefundRequest/show-details', [LandTaxRefundRequestController::class, 'LandTaxRefundRequestShowDetails'])->name('LandTaxRefundRequestShowDetails');
    Route::post('/user/account/TaxRefundRequest/{form}/reply', [LandTaxRefundRequestController::class, 'LandTaxRefundRequestUserReply'])->name('LandTaxRefundRequestUserReply');
    Route::get('/user/account/TaxRefundRequest/{id}/pdf', [LandTaxRefundRequestController::class, 'LandTaxRefundRequestUserExportPDF'])->name('LandTaxRefundRequestUserExportPDF');

    //ค่าขยะ (หน้าเว็บ)
    Route::get('/user/waste_payment', [UserWastePaymentController::class, 'UserWastePayment'])->name('UserWastePayment');

    Route::get('/user/waste_payment/check-valuetrash', [CheckValuetrashController::class, 'CheckValuetrash'])->name('CheckValuetrash');
    Route::post('/user/waste_payment/check-valuetrash/update-slip/{id}', [CheckValuetrashController::class, 'CheckValuetrashUpdateSlip'])->name('CheckValuetrashUpdateSlip');

    Route::get('/user/waste_payment/status-trash', [StatusTrashController::class, 'StatusTrash'])->name('StatusTrash');

    Route::get('/user/waste_payment/trash-toxic', [TrashToxicController::class, 'TrashToxic'])->name('TrashToxic');

    //แบบคำขอรับการประเมินค่าธรรมเนียมการกำจัดสิ่งปฏิกูลและมูลฝอย และ แบบขอรับถังขยะมูลฝอยทั่วไป
    Route::get('/user/account/GarbageCollection/show-details', [GarbageCollectionController::class, 'GarbageCollectionShowDetails'])->name('GarbageCollectionShowDetails');
    Route::post('/user/account/GarbageCollection/{form}/reply', [GarbageCollectionController::class, 'GarbageCollectionUserReply'])->name('GarbageCollectionUserReply');
    Route::get('/user/account/GarbageCollection/{id}/pdf', [GarbageCollectionController::class, 'GarbageCollectionUserExportPDF'])->name('GarbageCollectionUserExportPDF');

    //แบบคำร้องใบอณุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ
    Route::get('/health_hazard_applications', [HealthHazardApplicationController::class, 'HealthHazardApplicationFormPage'])->name('HealthHazardApplicationFormPage');
    Route::post('/health_hazard_applications/form/create', [HealthHazardApplicationController::class, 'HealthHazardApplicationFormCreate'])->name('HealthHazardApplicationFormCreate');
    Route::get('/user-account/health_hazard_applications/show-details', [HealthHazardApplicationController::class, 'HealthHazardApplicationShowDetails'])->name('HealthHazardApplicationShowDetails');
    Route::get('/user-account/health_hazard_applications/export-pdf/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationUserExportPDF'])->name('HealthHazardApplicationUserExportPDF');
    Route::post('/user-account/health_hazard_applications/reply/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationUserReply'])->name('HealthHazardApplicationUserReply');
    Route::get('/user-account/health_hazard_applications/show-edit/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationUserShowFormEdit'])->name('HealthHazardApplicationUserShowFormEdit');
    Route::get('/user-account/certificate/health_hazard_applications/export-pdf/{id}', [HealthHazardApplicationController::class, 'CertificateHealthHazardPDF'])->name('CertificateHealthHazardPDF');
    Route::get('/user-account/health_hazard_applications/detail/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationDetail'])->name('HealthHazardApplicationDetail');
    Route::get('/user-account/health_hazard_applications/calendar/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationCalendar'])->name('HealthHazardApplicationCalendar');
    Route::put('/user-account/health_hazard_applications/calendarSave', [HealthHazardApplicationController::class, 'HealthHazardApplicationCalendarSave'])->name('HealthHazardApplicationCalendarSave');
    Route::get('/user-account/health_hazard_applications/payment/{id}', [HealthHazardApplicationController::class, 'HealthHazardApplicationPayment'])->name('HealthHazardApplicationPayment');
    Route::put('/user-account/health_hazard_applications/paymentSave', [HealthHazardApplicationController::class, 'HealthHazardApplicationPaymentSave'])->name('HealthHazardApplicationPaymentSave');

    //แบบคำร้องใบอณุญาตสะสมอาหาร
    Route::get('/food_storage_license', [FoodStorageLicenseController::class, 'FoodStorageLicenseFormPage'])->name('FoodStorageLicenseFormPage');
    Route::post('/food_storage_license/form/create', [FoodStorageLicenseController::class, 'FoodStorageLicenseFormCreate'])->name('FoodStorageLicenseFormCreate');
    Route::get('/user-account/food_storage_license/show-details', [FoodStorageLicenseController::class, 'FoodStorageLicenseShowDetails'])->name('FoodStorageLicenseShowDetails');
    Route::get('/user-account/food_storage_license/export-pdf/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseUserExportPDF'])->name('FoodStorageLicenseUserExportPDF');
    Route::post('/user-account/food_storage_license/reply/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseUserReply'])->name('FoodStorageLicenseUserReply');
    Route::get('/user-account/food_storage_license/show-edit/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseUserShowFormEdit'])->name('FoodStorageLicenseUserShowFormEdit');
    Route::get('/user-account/certificate/food_storage_license/export-pdf/{id}', [FoodStorageLicenseController::class, 'CertificateFoodStorageLicensePDF'])->name('CertificateFoodStorageLicensePDF');
    Route::get('/user-account/certificate/food_sales/export-pdf/{id}', [FoodStorageLicenseController::class, 'CertificateFoodSalesPDF'])->name('CertificateFoodSalesPDF');
    Route::get('/user-account/food_storage_license/detail/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseDetail'])->name('FoodStorageLicenseDetail');
    Route::get('/user-account/food_storage_license/calendar/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseCalendar'])->name('FoodStorageLicenseCalendar');
    Route::get('/user-account/food_storage_license/payment/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicensePayment'])->name('FoodStorageLicensePayment');
    Route::put('/user-account/food_storage_license/paymentSave', [FoodStorageLicenseController::class, 'FoodStorageLicensePaymentSave'])->name('FoodStorageLicensePaymentSave');
    Route::put('/user-account/food_storage_license/calendarSave', [FoodStorageLicenseController::class, 'FoodStorageLicenseCalendarSave'])->name('FoodStorageLicenseCalendarSave');
    Route::get('/user-account/food_storage_license/food_checklist/export-pdf/{id}', [FoodStorageLicenseController::class, 'FoodStorageLicenseUserChecklistPDF'])->name('FoodStorageLicenseUserChecklistPDF');

    //คำร้องขอจัดตั้งตลาดเอกชน
    Route::get('/private_market', [PrivateMarketController::class, 'PrivateMarketFormPage'])->name('PrivateMarketFormPage');
    Route::post('/private_market/form/create', [PrivateMarketController::class, 'PrivateMarketFormCreate'])->name('PrivateMarketFormCreate');
    Route::get('/user-account/private_market/show-details', [PrivateMarketController::class, 'PrivateMarketShowDetails'])->name('PrivateMarketShowDetails');
    Route::get('/user-account/private_market/export-pdf/{id}', [PrivateMarketController::class, 'privateMarketUserExportPDF'])->name('privateMarketUserExportPDF');
    Route::get('/user-account/private_market/detail/{id}', [PrivateMarketController::class, 'privateMarketDetail'])->name('privateMarketDetail');
    Route::get('/user-account/private_market/calendar/{id}', [PrivateMarketController::class, 'PrivateMarketCalendar'])->name('PrivateMarketCalendar');
    Route::put('/user-account/private_market/calendarSave', [PrivateMarketController::class, 'PrivateMarketCalendarSave'])->name('PrivateMarketCalendarSave');
    Route::get('/user-account/private_market/payment/{id}', [PrivateMarketController::class, 'PrivateMarketPayment'])->name('PrivateMarketPayment');
    Route::put('/user-account/private_market/paymentSave', [PrivateMarketController::class, 'PrivateMarketPaymentSave'])->name('PrivateMarketPaymentSave');
    Route::get('/user-account/certificate/private_market/export-pdf/{id}', [PrivateMarketController::class, 'CertificatePrivateMarketPDF'])->name('CertificatePrivateMarketPDF');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'AdminIndex'])->name('AdminIndex');

    //คำร้องทั่วไป
    Route::get('/admin/general-requests/showdata', [AdminGeneralRequestsController::class, 'GeneralRequestsAdminShowData'])->name('GeneralRequestsAdminShowData');
    Route::get('/admin/general-requests/export-pdf/{id}', [AdminGeneralRequestsController::class, 'GeneralRequestsAdminExportPDF'])->name('GeneralRequestsAdminExportPDF');
    Route::post('/admin/general-requests/admin-reply/{id}', [AdminGeneralRequestsController::class, 'GeneralRequestsAdminReply'])->name('GeneralRequestsAdminReply');
    Route::post('/admin/general-requests/update-status/{id}', [AdminGeneralRequestsController::class, 'GeneralRequestsUpdateStatus'])->name('GeneralRequestsUpdateStatus');

    //แบบคำขอลงทะเบียนรับเงินเบี้ยความพิการ
    Route::get('/admin/disability/showdata', [AdminDisabilityController::class, 'DisabilityAdminShowData'])->name('DisabilityAdminShowData');
    Route::get('/admin/disability/export-pdf/{id}', [AdminDisabilityController::class, 'DisabilityExportPDF'])->name('DisabilityExportPDF');
    Route::post('/admin/disability/admin-reply/{id}', [AdminDisabilityController::class, 'DisabilityAdminReply'])->name('DisabilityAdminReply');
    Route::post('/admin/disability/update-status/{id}', [AdminDisabilityController::class, 'DisabilityUpdateStatus'])->name('DisabilityUpdateStatus');

    //แบบยืนยันสิทธิผู้สูงอายุ
    Route::get('/admin/elderly-allowance/showdata', [AdminElderlyAllowanceController::class, 'ElderlyAllowanceAdminShowData'])->name('ElderlyAllowanceAdminShowData');
    Route::get('/admin/elderly-allowance/export-pdf/{id}', [AdminElderlyAllowanceController::class, 'ElderlyAllowanceAdminExportPDF'])->name('ElderlyAllowanceAdminExportPDF');
    Route::post('/admin/elderly-allowance/admin-reply/{id}', [AdminElderlyAllowanceController::class, 'ElderlyAllowanceAdminReply'])->name('ElderlyAllowanceAdminReply');
    Route::post('/admin/elderly-allowance/update-status/{id}', [AdminElderlyAllowanceController::class, 'ElderlyAllowanceUpdateStatus'])->name('ElderlyAllowanceUpdateStatus');

    //แบบคำขอรับการสงเคราะห์
    Route::get('/TablePages/ReceiveAssistance', [AdminReceiveAssistanceController::class, 'TableReceiveAssistanceAdminPages'])->name('TableReceiveAssistanceAdminPages');
    Route::post('/TablePages/ReceiveAssistance/AdminReply/{id}', [AdminReceiveAssistanceController::class, 'ReceiveAssistanceAdminReply'])->name('ReceiveAssistanceAdminReply');
    Route::get('/TablePages/ReceiveAssistance/ExportPdf/{id}', [AdminReceiveAssistanceController::class, 'ReceiveAssistanceAdminExportPDF'])->name('ReceiveAssistanceAdminExportPDF');
    Route::post('/TablePages/ReceiveAssistance/{id}/update-status', [AdminReceiveAssistanceController::class, 'ReceiveAssistanceUpdateStatus'])->name('ReceiveAssistanceUpdateStatus');

    //(ภ.ด.ส.๕) แบบแจ้งการเปลี่ยนแปลงการใช้ประโยชน์ที่ดินหรือสิ่งปลูกสร้าง
    Route::get('/admin/change_in_use', [AdminChangeInUse::class, 'ChangeInUseAdminPages'])->name('ChangeInUseAdminPages');
    Route::get('/admin/change_in_use/ExportPdf/{id}', [AdminChangeInUse::class, 'ChangeInUseAdminExportPDF'])->name('ChangeInUseAdminExportPDF');
    Route::post('/admin/change_in_use/AdminReply/{id}', [AdminChangeInUse::class, 'ChangeInUseAdminReply'])->name('ChangeInUseAdminReply');
    Route::post('/admin/change_in_use/{id}/update-status', [AdminChangeInUse::class, 'ChangeInUseUpdateStatus'])->name('ChangeInUseUpdateStatus');

    //(ภ.ป.๑) แนบแสดงรายการ ภาษีป้าย
    Route::get('/admin/license_tax', [AdminLicenseTax::class, 'LicenseTaxAdminPages'])->name('LicenseTaxAdminPages');
    Route::get('/admin/license_tax/ExportPdf/{id}', [AdminLicenseTax::class, 'LicenseTaxAdminExportPDF'])->name('LicenseTaxAdminExportPDF');
    Route::post('/admin/license_tax/AdminReply/{id}', [AdminLicenseTax::class, 'LicenseTaxAdminReply'])->name('LicenseTaxAdminReply');
    Route::post('/admin/license_tax/{id}/update-status', [AdminLicenseTax::class, 'LicenseTaxUpdateStatus'])->name('LicenseTaxUpdateStatus');

    //แบบฟอร์มใบสมัคร ศูนย์พัฒนาเด็กเล็ก
    Route::get('/admin/RecruitingChildren', [AdminRecruitingChildrenController::class, 'TableChildApplyAdminPages'])->name('TableChildApplyAdminPages');
    Route::get('/admin/RecruitingChildren/ExportPdf/{id}', [AdminRecruitingChildrenController::class, 'ChildApplyAdminExportPDF'])->name('ChildApplyAdminExportPDF');
    Route::post('/admin/RecruitingChildren/AdminReply/{id}', [AdminRecruitingChildrenController::class, 'ChildApplyAdminReply'])->name('ChildApplyAdminReply');
    Route::post('/admin/RecruitingChildren/{id}/update-status', [AdminRecruitingChildrenController::class, 'ChildApplyUpdateStatus'])->name('ChildApplyUpdateStatus');

    //หนังสือขอผ่อนชำระภาษีที่ดินและสิ่งปลูกสร้าง
    Route::get('/admin/pay_tax_build_and_room', [AdminPayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomAdminPages'])->name('PayTaxBuildAndRoomAdminPages');
    Route::get('/admin/pay_tax_build_and_room/ExportPdf/{id}', [AdminPayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomAdminExportPDF'])->name('PayTaxBuildAndRoomAdminExportPDF');
    Route::post('/admin/pay_tax_build_and_room/AdminReply/{id}', [AdminPayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomAdminReply'])->name('PayTaxBuildAndRoomAdminReply');
    Route::post('/admin/pay_tax_build_and_room/{id}/update-status', [AdminPayTaxBuildAndRoom::class, 'PayTaxBuildAndRoomUpdateStatus'])->name('PayTaxBuildAndRoomUpdateStatus');

    //คำร้องคัดค้านการประเมินภาษีหรือ การเรียกเก็บภาษีที่ดินและสิ่งปลูกสร้าง
    Route::get('/admin/land_building_tax_appeals/showdata', [AdminLandBuildingTaxAppealController::class, 'LandBuildingTaxAppealAdminShowData'])->name('LandBuildingTaxAppealAdminShowData');
    Route::get('/admin/land_building_tax_appeals/export-pdf/{id}', [AdminLandBuildingTaxAppealController::class, 'LandBuildingTaxAppealAdminExportPDF'])->name('LandBuildingTaxAppealAdminExportPDF');
    Route::post('/admin/land_building_tax_appeals/admin-reply/{id}', [AdminLandBuildingTaxAppealController::class, 'LandBuildingTaxAppealAdminReply'])->name('LandBuildingTaxAppealAdminReply');
    Route::post('/admin/land_building_tax_appeals/update-status/{id}', [AdminLandBuildingTaxAppealController::class, 'LandBuildingTaxAppealUpdateStatus'])->name('LandBuildingTaxAppealUpdateStatus');

    //คำร้องขอรับเงินภาษีที่ดินและสิ่งปลูกสร้างคืน
    Route::get('/admin/tax_refund_requests/showdata', [AdminLandTaxRefundRequestController::class, 'LandTaxRefundRequestAdminShowData'])->name('LandTaxRefundRequestAdminShowData');
    Route::get('/admin/tax_refund_requests/export-pdf/{id}', [AdminLandTaxRefundRequestController::class, 'LandTaxRefundRequestAdminExportPDF'])->name('LandTaxRefundRequestAdminExportPDF');
    Route::post('/admin/tax_refund_requests/admin-reply/{id}', [AdminLandTaxRefundRequestController::class, 'LandTaxRefundRequestAdminReply'])->name('LandTaxRefundRequestAdminReply');
    Route::post('/admin/tax_refund_requests/update-status/{id}', [AdminLandTaxRefundRequestController::class, 'LandTaxRefundRequestUpdateStatus'])->name('LandTaxRefundRequestUpdateStatus');

    //แบบคำขอรับการประเมินค่าธรรมเนียมการกำจัดสิ่งปฏิกูลและมูลฝอย และ แบบขอรับถังขยะมูลฝอยทั่วไป
    Route::get('/admin/GarbageCollection/showdata', [AdminGarbageCollectionController::class, 'GarbageCollectionAdminShowData'])->name('GarbageCollectionAdminShowData');
    Route::get('/admin/GarbageCollection/export-pdf/{id}', [AdminGarbageCollectionController::class, 'GarbageCollectionAdminExportPDF'])->name('GarbageCollectionAdminExportPDF');
    Route::post('/admin/GarbageCollection/admin-reply/{id}', [AdminGarbageCollectionController::class, 'AdminGarbageCollectionAdminReply'])->name('AdminGarbageCollectionAdminReply');
    Route::post('/admin/GarbageCollection/update-status/{id}', [AdminGarbageCollectionController::class, 'AdminGarbageCollectionUpdateStatus'])->name('AdminGarbageCollectionUpdateStatus');

    //แบบคำร้องใบอณุญาตประกอบกิจการที่เป็นอันตรายต่อสุขภาพ
    Route::get('/admin/health_hazard_applications/showdata', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminShowData'])->name('HealthHazardApplicationAdminShowData');
    Route::get('/admin/health_hazard_applications/appointment', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminAppointment'])->name('HealthHazardApplicationAdminAppointment');
    Route::get('/admin/health_hazard_applications/export-pdf/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminExportPDF'])->name('HealthHazardApplicationAdminExportPDF');
    Route::post('/admin/health_hazard_applications/admin-reply/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminReply'])->name('HealthHazardApplicationAdminReply');
    Route::post('/admin/health_hazard_applications/update-status/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationUpdateStatus'])->name('HealthHazardApplicationUpdateStatus');
    Route::get('/admin/health_hazard_applications/confirm/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminConfirm'])->name('HealthHazardApplicationAdminConfirm');
    Route::put('/admin/health_hazard_applications/confirm', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminConfirmSave'])->name('HealthHazardApplicationAdminConfirmSave');
    Route::get('/admin/health_hazard_applications/detail/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminDetail'])->name('HealthHazardApplicationAdminDetail');
    Route::get('/admin/health_hazard_applications/calendar/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminCalendar'])->name('HealthHazardApplicationAdminCalendar');
    Route::put('/admin/health_hazard_applications/calendarSave', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminCalendarSave'])->name('HealthHazardApplicationAdminCalendarSave');
    Route::get('/admin/health_hazard_applications/explore', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminExplore'])->name('HealthHazardApplicationAdminExplore');
    Route::get('/admin/health_hazard_applications/checklist/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminChecklist'])->name('HealthHazardApplicationAdminChecklist');
    Route::put('/admin/health_hazard_applications/checklistSave', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminChecklistSave'])->name('HealthHazardApplicationAdminChecklistSave');
    Route::get('/admin/health_hazard_applications/payment', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminPayment'])->name('HealthHazardApplicationAdminPayment');
    Route::get('/admin/health_hazard_applications/payment-check/{id}', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminPaymentCheck'])->name('HealthHazardApplicationAdminPaymentCheck');
    Route::put('/admin/health_hazard_applications/paymentSave', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminPaymentSave'])->name('HealthHazardApplicationAdminPaymentSave');
    Route::get('/admin/health_hazard_applications/approve', [AdminHealthHazardApplicationController::class, 'HealthHazardApplicationAdminApprove'])->name('HealthHazardApplicationAdminApprove');
    Route::get('/admin/certificate/health_hazard_applications/export-pdf/{id}', [AdminHealthHazardApplicationController::class, 'AdminCertificateHealthHazardApplicationPDF'])->name('AdminCertificateHealthHazardApplicationPDF');
    Route::post('/admin/certificate/health_hazard_applications/extend', [AdminHealthHazardApplicationController::class, 'CertificateHealthHazardApplicationCoppy'])->name('CertificateHealthHazardApplicationCoppy');
    Route::get('/admin/health_hazard_applications/expire', [AdminHealthHazardApplicationController::class, 'CertificateHealthHazardApplicationExpire'])->name('CertificateHealthHazardApplicationExpire');

    //แบบคำร้องใบอณุญาตสะสมอาหาร
    Route::get('/admin/food_storage_license/showdata', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminShowData'])->name('FoodStorageLicenseAdminShowData');
    Route::get('/admin/food_storage_license/appointment', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminAppointment'])->name('FoodStorageLicenseAdminAppointment');
    Route::get('/admin/food_storage_license/explore', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminExplore'])->name('FoodStorageLicenseAdminExplore');
    Route::get('/admin/food_storage_license/payment', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminPayment'])->name('FoodStorageLicenseAdminPayment');
    Route::get('/admin/food_storage_license/approve', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminApprove'])->name('FoodStorageLicenseAdminApprove');
    Route::get('/admin/food_storage_license/export-pdf/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminExportPDF'])->name('FoodStorageLicenseAdminExportPDF');
    Route::get('/admin/food_storage_license/calendar/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminCalendar'])->name('FoodStorageLicenseAdminCalendar');
    Route::get('/admin/food_storage_license/checklist/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminChecklist'])->name('FoodStorageLicenseAdminChecklist');
    Route::get('/admin/food_storage_license/payment-check/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminPaymentCheck'])->name('FoodStorageLicenseAdminPaymentCheck');
    Route::get('/admin/food_storage_license/detail/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminDetail'])->name('FoodStorageLicenseAdminDetail');
    Route::get('/admin/food_storage_license/confirm/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminConfirm'])->name('FoodStorageLicenseAdminConfirm');
    Route::put('/admin/food_storage_license/confirm', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminConfirmSave'])->name('FoodStorageLicenseAdminConfirmSave');
    Route::put('/admin/food_storage_license/checklistSave', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminChecklistSave'])->name('FoodStorageLicenseAdminChecklistSave');
    Route::put('/admin/food_storage_license/calendarSave', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminCalendarSave'])->name('FoodStorageLicenseAdminCalendarSave');
    Route::put('/admin/food_storage_license/paymentSave', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminPaymentSave'])->name('FoodStorageLicenseAdminPaymentSave');
    Route::post('/admin/food_storage_license/admin-reply/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseAdminReply'])->name('FoodStorageLicenseAdminReply');
    Route::post('/admin/food_storage_license/update-status/{id}', [AdminFoodStorageLicenseController::class, 'FoodStorageLicenseUpdateStatus'])->name('FoodStorageLicenseUpdateStatus');
    Route::get('/admin/certificate/food_storage_license/export-pdf/{id}', [AdminFoodStorageLicenseController::class, 'AdminCertificateFoodStorageLicensePDF'])->name('AdminCertificateFoodStorageLicensePDF');
    Route::post('/admin/certificate/food_storage_license/extend', [AdminFoodStorageLicenseController::class, 'CertificateFoodStorageLicenseCoppy'])->name('CertificateFoodStorageLicenseCoppy');
    Route::get('/admin/food_storage_license/expire', [AdminFoodStorageLicenseController::class, 'CertificateFoodStorageLicenseExpire'])->name('CertificateFoodStorageLicenseExpire');

    //คำร้องขอจัดตั้งตลาดเอกชน
    Route::get('/admin/private_market/showdata', [AdminPrivateMarketController::class, 'PrivateMarketAdminShowData'])->name('PrivateMarketAdminShowData');
    Route::get('/admin/private_market/export-pdf/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminExportPDF'])->name('PrivateMarketAdminExportPDF');
    Route::get('/admin/private_market/confirm/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminConfirm'])->name('PrivateMarketAdminConfirm');
    Route::put('/admin/private_market/confirm', [AdminPrivateMarketController::class, 'PrivateMarketAdminConfirmSave'])->name('PrivateMarketAdminConfirmSave');
    Route::get('/admin/private_market/appointment', [AdminPrivateMarketController::class, 'PrivateMarketAdminAppointment'])->name('PrivateMarketAdminAppointment');
    Route::get('/admin/private_market/detail/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminDetail'])->name('PrivateMarketAdminDetail');
    Route::get('/admin/private_market/calendar/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminCalendar'])->name('PrivateMarketAdminCalendar');
    Route::put('/admin/private_market/calendarSave', [AdminPrivateMarketController::class, 'PrivateMarketAdminCalendarSave'])->name('PrivateMarketAdminCalendarSave');

    Route::get('/admin/private_market/explore', [AdminPrivateMarketController::class, 'PrivateMarketAdminExplore'])->name('PrivateMarketAdminExplore');
    Route::get('/admin/private_market/checklist/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminChecklist'])->name('PrivateMarketAdminChecklist');
    Route::put('/admin/private_market/checklistSave', [AdminPrivateMarketController::class, 'PrivateMarketAdminChecklistSave'])->name('PrivateMarketAdminChecklistSave');
    Route::get('/admin/private_market/payment', [AdminPrivateMarketController::class, 'PrivateMarketAdminPayment'])->name('PrivateMarketAdminPayment');
    Route::get('/admin/private_market/payment-check/{id}', [AdminPrivateMarketController::class, 'PrivateMarketAdminPaymentCheck'])->name('PrivateMarketAdminPaymentCheck');
    Route::put('/admin/private_market/paymentSave', [AdminPrivateMarketController::class, 'PrivateMarketAdminPaymentSave'])->name('PrivateMarketAdminPaymentSave');
    Route::get('/admin/private_market/approve', [AdminPrivateMarketController::class, 'PrivateMarketAdminApprove'])->name('PrivateMarketAdminApprove');
    Route::get('/admin/certificate/private_market/export-pdf/{id}', [AdminPrivateMarketController::class, 'AdminCertificatePrivateMarketPDF'])->name('AdminCertificatePrivateMarketPDF');
    Route::post('/admin/certificate/private_market/extend', [AdminPrivateMarketController::class, 'CertificatePrivateMarketCopy'])->name('CertificatePrivateMarketCopy');
    Route::get('/admin/private_market/expire', [AdminPrivateMarketController::class, 'CertificatePrivateMarketExpire'])->name('CertificatePrivateMarketExpire');
});

Route::middleware(['admin_waste_payment'])->group(function () {
    Route::get('/admin/waste_payment', [AdminWastePaymentController::class, 'AdminWastePayment'])->name('AdminWastePayment');

    Route::get('/admin/trash_can_installation', [TrashCanInstallationController::class, 'TrashCanInstallationPage'])->name('TrashCanInstallationPage');
    Route::get('/admin/trash_can_installation/detail/{id}', [TrashCanInstallationController::class, 'TrashCanInstallationDetail'])->name('TrashCanInstallationDetail');
    Route::post('/admin/trash_can_installation/detail/update-trash-status/{id}', [TrashCanInstallationController::class, 'updateTrashStatus'])->name('updateTrashStatus');
    Route::post('/admin/trash_can_installation/bill/create/{id}', [TrashCanInstallationController::class, 'CreateBill'])->name('CreateBill');

    Route::get('/admin/verify_payment', [VerifyPaymentController::class, 'VerifyPaymentPage'])->name('VerifyPaymentPage');
    Route::post('/admin/verify_payment/approve/{id}', [VerifyPaymentController::class, 'approvePayment'])->name('approvePayment');

    Route::get('/admin/payment_history', [PaymentHistoryController::class, 'PaymentHistoryPage'])->name('PaymentHistoryPage');
    Route::post('/admin/payment_history/upload-bill/{id}', [PaymentHistoryController::class, 'uploadBill'])->name('uploadBill');

    Route::get('/admin/trash_installer', [TrashInstallerController::class, 'TrashInstallerPage'])->name('TrashInstallerPage');
    Route::get('/admin/trash_installer/detail/{id}', [TrashInstallerController::class, 'TrashInstallerDetail'])->name('TrashInstallerDetail');

    Route::get('/admin/non_payment', [NonPaymentController::class, 'NonPaymentPage'])->name('NonPaymentPage');
});
