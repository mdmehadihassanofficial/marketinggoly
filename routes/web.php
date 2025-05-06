<?php

use App\Http\Controllers\frontend\config\configuration;
use App\Http\Controllers\frontend\config\facebook;
use App\Http\Controllers\frontend\config\linkedin;
use App\Http\Controllers\frontend\config\pushNotification;
use App\Http\Controllers\frontend\dashboard\dashboard;
use App\Http\Controllers\frontend\email\emailCampaign;
use App\Http\Controllers\frontend\email\emailCampaignCat;
use App\Http\Controllers\frontend\email\emailCollection;
use App\Http\Controllers\frontend\email\emailInbox;
use App\Http\Controllers\frontend\email\emailManager;
use App\Http\Controllers\frontend\email\emailSender;
use App\Http\Controllers\frontend\image\media;
use App\Http\Controllers\frontend\loginRegister\login;
use App\Http\Controllers\frontend\loginRegister\register;
use App\Http\Controllers\frontend\shortLink\shortLink;
use App\Http\Controllers\frontend\socialPostManager\socialPost;
use App\Http\Controllers\frontend\socialPostManager\socialPostManage;
use App\Http\Controllers\frontend\template\emailTemplate;
use App\Http\Controllers\frontend\template\socialTemplate;
use App\Http\Controllers\frontend\twitterX\twitterX;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //return view('welcome');
    return redirect(route('login'));
});
Route::get('/phpinfo', function () {
    echo phpinfo();;
});

Route::get('/check24', function () {
echo '<h1>Do Not return Any Value</h1>';
});


Route::get( '/{lin}', array( shortLink::class, 'linkDetail' ) )->name( 'linkDetail' );
/*Email Open Tracking*/
Route::get( '/emailtrack/{code}', array( emailSender::class, 'emailOpenTrack' ) )->name( 'emailOpenTrack' );

// Not User Login Route
Route::prefix( 'user' )->middleware(['userUnderDashboard'])->group(function () {
    // Register Route
    Route::get( '/register', array( register::class, 'index' ) )->name( 'register' );
    Route::post( '/register/store', array( register::class, 'store' ) )->name( 'registerStore' );
    // Login Route
    Route::post( '/login/store', array( login::class, 'store' ) )->name( 'loginStore' );
    Route::get( '/login', array( login::class, 'index' ) )->name( 'login' );
    Route::get('/verify', function () {
        return view('Frontend.login.two-factor');
    });
    
    Route::get('/new-password', function () {
        return view('Frontend.login.new-password');
    });
    
    Route::get('/reset-password', function () {
        return view('Frontend.login.reset-password');
    });
});

//  User Login Route Only
Route::prefix( 'user' )->middleware(['userNotUnderDashboard'])->name('user.')->group(function () {
    // User Dashboard
    Route::get( '/dashboard', array( dashboard::class, 'index' ) )->name( 'dashboard' );

    Route::get( '/logout', array( login::class, 'logout' ) )->name( 'logout' );
    // Short Link Route
    Route::post( '/shortLink/selectDelete', array( shortLink::class, 'selectDelete' ) )->name( 'shortLinkSelectDelete' );
    Route::post( '/shortLink/update2/{id}', array( shortLink::class, 'update' ) )->name( 'shortLinkUpdate2' );
    // Email Template Route
    Route::post( '/emailTemplate/selectDelete', array( emailTemplate::class, 'selectDelete' ) )->name( 'emailTemplateSelectDelete' );
    Route::DELETE( '/emailTemplate/deactive/{id}', array( emailTemplate::class, 'deactive' ) )->name( 'emailTemplateDeactive' );
    Route::DELETE( '/emailTemplate/active/{id}', array( emailTemplate::class, 'active' ) )->name( 'emailTemplateActive' );
    Route::get( '/emailTemplate/designView/{id}', array( emailTemplate::class, 'designView' ) )->name( 'emailTemplateDesignView' );
    Route::post( '/emailTemplate/designSave/{id}', array( emailTemplate::class, 'designSave' ) )->name( 'emailTemplateDesignSave' );
    // Email Campaign Category Route
    Route::post( '/emailCampaignCat/selectDelete', array( emailCampaignCat::class, 'selectDelete' ) )->name( 'emailCampaignCatSelectDelete' );
    Route::DELETE( '/emailCampaignCat/deactive/{id}', array( emailCampaignCat::class, 'deactive' ) )->name( 'emailCampaignCatDeactive' );
    Route::DELETE( '/emailCampaignCat/active/{id}', array( emailCampaignCat::class, 'active' ) )->name( 'emailCampaignCatActive' );
    // Email Campaign Route
    Route::post( '/emailCampaign/selectDelete', array( emailCampaign::class, 'selectDelete' ) )->name( 'emailCampaignSelectDelete' );
    Route::DELETE( '/emailCampaign/deactive/{id}', array( emailCampaign::class, 'deactive' ) )->name( 'emailCampaignDeactive' );
    Route::DELETE( '/emailCampaign/active/{id}', array( emailCampaign::class, 'active' ) )->name( 'emailCampaignActive' );
    //Email Collection Route
    Route::post( '/emailCollectionStore/{campaignId}', array( emailCollection::class, 'storeWithCampaignID' ) )->name( 'emailCollectionStoreWithID' );
    Route::get( '/emailCollection/{campaignId}', array( emailCollection::class, 'index' ) )->name( 'emailCollectionList' );
    Route::DELETE( '/emailCollectionDeactive/{Id}', array( emailCollection::class, 'deactive' ) )->name( 'emailCollectionDeactive' );
    Route::DELETE( '/emailCollectionActive/{Id}', array( emailCollection::class, 'active' ) )->name( 'emailCollectionActive' );
    Route::DELETE( '/emailCollectionDelete/{Id}', array( emailCollection::class, 'destroy' ) )->name( 'emailCollectionDelete' );
    Route::post( '/emailCollectionSelectDelete', array( emailCollection::class, 'selectDelete' ) )->name( 'emailCollectionSelectDelete' );
    // Configuration Route
    Route::get( '/config/smtp', array( configuration::class, 'configSmtpView' ) )->name( 'configSmtpView' );
    Route::post( '/config/smtp/store', array( configuration::class, 'configSmtpStore' ) )->name( 'configSmtpStore' );

    // Email Sender Route
    Route::get( '/emailSender/direct', array( emailSender::class, 'emailDirectSenderView' ) )->name( 'emailDirectSenderView' );
    Route::post( '/emailSender/send', array( emailSender::class, 'emailDirectSenderSend' ) )->name( 'emailDirectSenderSend' );
    // Email Manager Route
    Route::get( '/emailManager', array( emailManager::class, 'index' ) )->name( 'emailManagerIndex' );
    Route::post( '/emailManager/store', array( emailManager::class, 'store' ) )->name( 'emailManagerStore' );
    // 
    Route::get( '/emailTemplateViewById/{id}', array( emailManager::class, 'emailTemplateViewById' ) )->name( 'emailTemplateViewById' );
    Route::get( '/emailCampaignListViewById/{id}', array( emailManager::class, 'emailCampaignListViewById' ) )->name( 'emailCampaignListViewById' );

    // Email Manage Single Item
    Route::get( '/emailManagerUpdate/{id}', array( emailManager::class, 'emailManagerUpdate' ) )->name( 'emailManagerUpdate' );
    Route::post( '/emailManagerUp/{id}', array( emailManager::class, 'emailManagerUp' ) )->name( 'emailManagerUp' );

    //   Email Template Design
    Route::DELETE( '/emailManager/deactive/{id}', array( emailManager::class, 'deactive' ) )->name( 'emailManagerDeactive' );
    Route::DELETE( '/emailManager/active/{id}', array( emailManager::class, 'active' ) )->name( 'emailManagerActive' );
    Route::DELETE( '/emailManagerDelete/{Id}', array( emailManager::class, 'destroy' ) )->name( 'emailManagerDelete' );
    Route::post( '/emailManagerSelectDelete', array( emailManager::class, 'selectDelete' ) )->name( 'emailManagerSelectDelete' );

    //Email Manager Report
    Route::get( '/emailManagerReport/{id}', array( emailManager::class, 'emailManagerReport' ) )->name( 'emailManagerReport' );

    //Email Inbox route
    Route::get( '/emailInbox', array( emailInbox::class, 'emailInbox' ) )->name( 'emailInbox' );
    Route::get( '/emailInbox-reload', array( emailInbox::class, 'emailInboxReload' ) )->name( 'emailInboxReload' );
    Route::get( '/emailInbox-unseen', array( emailInbox::class, 'emailInboxUnseen' ) )->name( 'emailInboxUnseen' );
    Route::get( '/emailInbox-unseen-reload', array( emailInbox::class, 'emailInboxUnseenReload' ) )->name( 'emailInboxUnseenReload' );
    Route::get( '/email/{seenUnseen}/{id}', array( emailInbox::class, 'emailSingleView' ) )->name( 'emailSingleView' );
    Route::get( '/checkInbox', array( emailInbox::class, 'checkEmailInbox' ) )->name( 'checkEmailInbox' );
    Route::get( '/iframsrc', array( emailInbox::class, 'iframSrcEmailInboxSingle' ) )->name( 'iframSrcEmailInboxSingle' );


    // Twitter Or X Configaration
    Route::get( '/twitter', array( twitterX::class, 'twitterConfigView' ) )->name( 'twitterConfigView' );
    Route::post( '/twitter/login', array( twitterX::class, 'twitterLogin' ) )->name( 'twitterLogin' );
    Route::get( '/twitter/callback', array( twitterX::class, 'twitterCallBack' ) )->name( 'twitterCallBack' );

    // LinkedIn Configaration
    Route::get( '/linkedIn', array( linkedin::class, 'linkedinConfigView' ) )->name( 'linkedinConfigView' );
    Route::get( '/linkedIn/callback', array( linkedin::class, 'linkedInCallBack' ) )->name( 'linkedInCallBack' );
    Route::post( '/linkedIn/login', array( linkedin::class, 'linkedinLogin' ) )->name( 'linkedinLogin' );

  // Facebook Configaration
    Route::get( '/facebook', array( facebook::class, 'facebookConfigView' ) )->name( 'facebookConfigView' );
    Route::get( '/facebook/callback', array( facebook::class, 'facebookCallBack' ) )->name( 'facebookCallBack' );
    Route::post( '/facebook/login', array( facebook::class, 'facebookLogin' ) )->name( 'facebookLogin' );

    //Social Template Route
    Route::DELETE( '/socialTemplate/deactive/{id}', array( socialTemplate::class, 'deactive' ) )->name( 'socialTemplateDeactive' );
    Route::DELETE( '/socialTemplate/active/{id}', array( socialTemplate::class, 'active' ) )->name( 'socialTemplateActive' );
    Route::post( '/socialTemplateSelectDelete', array( socialTemplate::class, 'selectDelete' ) )->name( 'socialTemplateSelectDelete' );

    // Social Post Route
    Route::get( '/socialPost', array( socialPost::class, 'socialPostView' ) )->name( 'socialPostView' );
    Route::post( '/socialPost/post', array( socialPost::class, 'socialPostSend' ) )->name( 'socialPostSend' );
    Route::get( '/socialPostManage', array( socialPostManage::class, 'socialPostManageView' ) )->name( 'socialPostManageView' );
    Route::get( '/socialPostManage/{id}', array( socialPostManage::class, 'templateViewById' ) )->name( 'templateViewById' );
    Route::get( '/socialPostReport/{id}', array( socialPostManage::class, 'socialPostReport' ) )->name( 'socialPostReport' );
    Route::get( '/PostReport/{id}', array( socialPostManage::class, 'socialPostReportView' ) )->name( 'socialPostReportView' );
    Route::get( '/autoSocialPost', array( socialPost::class, 'autoSocialPostView' ) )->name( 'autoSocialPostView' );
// Social Post Manage Delete And Active Deactive
    Route::DELETE( '/socialPostManageDelete/{Id}', array( socialPostManage::class, 'destroy' ) )->name( 'socialPostManageDelete' );
    Route::post( '/socialPostManageSelectDelete', array( socialPostManage::class, 'selectDelete' ) )->name( 'socialPostManageSelectDelete' );

    Route::DELETE( '/socialPostManage/deactive/{id}', array( socialPostManage::class, 'deactive' ) )->name( 'socialPostManageDeactive' );
    Route::DELETE( '/socialPostManage/active/{id}', array( socialPostManage::class, 'active' ) )->name( 'socialPostManageActive' );
    // Social Post Manage Single Item
    Route::get( '/socialPostManageUpdate/{id}', array( socialPostManage::class, 'socialPostManageUpdate' ) )->name( 'socialPostManageUpdate' );
    Route::post( '/socialPostManageUp/{id}', array( socialPost::class, 'socialPostManageUp' ) )->name( 'socialPostManageUp' );

    // Push Notification 
    Route::post( '/deviceToken/pushNotification', array( pushNotification::class, 'deviceTokenStore' ) )->name( 'deviceTokenStore' );
    Route::get( '/pushNotification/send', array( pushNotification::class, 'pushNotificationSend' ) )->name( 'pushNotificationSend' );

    // Check A tag href code here
    Route::get( '/CheckCode/', array( emailCollection::class, 'CheckCode' ) )->name( 'CheckCode' );

    // Image Media 
    Route::get( '/media', array( media::class, 'view' ) )->name( 'mediaView' );
    Route::get( '/media/load', array( media::class, 'viewLoad' ) )->name( 'mediaViewLoad' );
    Route::post('/upload-images', [media::class, 'upload'])->name('mediaUpload');
    Route::DELETE('/destroy-images/{id}', [media::class, 'destroy'])->name('mediaDestroy');

    Route::get( '/media/{id}', array( media::class, 'viewSingleLoad' ) )->name( 'viewSingleLoad' );
    Route::put( '/mediaUpdate/{id}', array( media::class, 'updateSingleLoad' ) )->name( 'updateSingleLoad' );


    
    
    //  Here Route Array 
    Route::resources([
        'shortLink' => shortLink::class,
        'emailTemplate' => emailTemplate::class,
        'emailCampaign' => emailCampaign::class,
        'emailCampaignCat' => emailCampaignCat::class,
        'socialTemplate' => socialTemplate::class,
        //'emailCollection' => emailCollection::class,
        //'posts' => PostController::class,
    ]);
    
});