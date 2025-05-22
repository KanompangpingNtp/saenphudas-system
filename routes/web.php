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
use App\Http\Controllers\emergency\EmergencyController;

use App\Http\Controllers\waste_payment\AdminWastePaymentController;
use App\Http\Controllers\waste_payment\UserWastePaymentController;

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
});

Route::middleware(['user_waste_payment'])->group(function () {
    Route::get('/user/waste_payment', [UserWastePaymentController::class, 'UserWastePayment'])->name('UserWastePayment');
});

Route::middleware(['admin_waste_payment'])->group(function () {
    Route::get('/admin/waste_payment', [AdminWastePaymentController::class, 'AdminWastePayment'])->name('AdminWastePayment');
});
