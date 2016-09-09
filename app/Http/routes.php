<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Contact;
use App\Material_List;
use Barryvdh\DomPDF\Facade as PDF;
use App\Tender;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Fileentry;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {

    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index',function (){ notify()->flash('you have signed in.','success');});

Route::get('winsIndex','PhasesTenderController@winsIndex');
Route::get('lossesIndex','PhasesTenderController@lossesIndex');

//Password reset routes
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset','Auth\PasswordController@reset');

//for phases of tender,CRUD
Route::resource('phases','PhasesTenderController',['except' => ['create']]);

Route::resource('reminder','ReminderController',['except' => ['create']]);

Route::get('indexfor','ReminderController@indexfor');

Route::get('indexUser','AdminPageController@indexUser');
//admin page route
Route::get('/adminpage','AdminPageController@page');
Route::post('signup',[
    'uses'=>'AdminPageController@postSignUp',
    'as'=> 'signup'
]);

//for resource managemnet,CRUD, for municipality information
Route::resource('municipality','MunicipalityController');

//for resource managemnet,CRUD, for tender information
Route::resource('tender','TenderController');

Route::get('fileUpload{id}',['uses'=>'TenderController@fileUpload','as'=>'fileUpload']);
Route::get('files{id}',['uses'=>'TenderController@files','as'=>'files']);





//Route::post('upload','UploadController@upload');

Route::get('retrieve','UploadController@retrieve',function (){
    // return view('deneme');
});

Route::get('indexFile','UploadController@indexFile');

Route::resource('contact','ContactController',['except' => ['create']],function (){


});


Route::resource('user', 'UserController');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');



Route::get('/index','EmailController@index');

Route::post('/sendEmail',[
    'uses'=>'EmailController@sendEmail',
    'as'=> 'sendEmail']);



Route::post( 'sendEmailContact{id}',[
    'as'=> 'sendEmailContact',
    'uses'=>'ContactController@sendEmailContact'
]);

Route::get('indexEmail','ContactController@indexEmail');

Route::get('/autocomplete',array('as' =>'autocomplete','uses'=>'EmailController@autocomplete'));


Route::resource('materials','MaterialListController');

//search for contact
Route::any('/search',function(){
    $q = Input::get ( 'search' );
    $user = Contact::where('contactName','LIKE','%'.$q.'%')->orWhere('contactEmail','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('contactSearch')->withDetails($user)->withQuery ( $q );
    else

        return view ( 'contactSearch' )->withMessage ( 'No Details found. Try to search again !' );
});

Route::get('/autocomplete',array('as' =>'autocomplete','uses'=>'ContactController@autocomplete'));



//search for material

Route::any('/searchMaterial',function(){
    $a= Input::get ( 'searchMaterial' );
    $user = Material_List::where('material_name','LIKE','%'.$a.'%')->get();
    if(count($user) > 0)
        return view('materials.create')->withDetails($user)->withQuery ( $a );
    else
        return view ('materials.create')->withMessage('No Details found. Try to search again !');
});

Route::get('/autocompletematerial',array('as' =>'autocompletematerial','uses'=>'MaterialListController@autocompletematerial'));

//search for tender
Route::any('/searchTender',function(){

    $municipality=\App\Municipality::all();
    $phase=\App\PhasesTender::all();
    $user=User::all();
    $entries=\App\Fileentry::all();
    $q = Input::get ( 'searchTender' );
    $tendersearch = Tender::where('name','LIKE','%'.$q.'%')->get();

    if(count($tendersearch) > 0)
        return view('tender.search')->withDetails($tendersearch)->withQuery ( $q )->withMunicipality($municipality)->withPhase($phase)->withUser($user)->withEntries($entries);
    else

        return view('tender.search')->withMessage ( 'No Details found. Try to search again !' );


});

Route::get('/autocompleteTender',array('as' =>'autocompleteTender','uses'=>'TenderController@autocompleteTender'));

//excel
Route::get('/getImport','ExcelController@getImport');
Route::post('/postImport','ExcelController@postImport');
Route::get('/getExport','ExcelController@getExport');
Route::get('/getExport2','ExcelController@getExport2');


//bunu ıkıncı upload da kullanıyorsun
Route::get('fileentry', 'FileEntryController@index');

Route::get('fileentry/get/{original_filename}', [
    'as' => 'getentry', 'uses' => 'FileEntryController@get']);

Route::post('add{id}',[
    'as' => 'addentry', 'uses' => 'FileEntryController@add']);


Route::get('/deleteFile{id}',['as'=>'/deleteFile','uses'=>'FileEntryController@deleteFile']);

Route::post('/upload', function () {
    $file = Input::file('file');
    if($file) {
        $destinationPath =storage_path()."/app/";
        $filename = $file->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        if ($upload_success) {
            // resizing an uploaded file
            // Image::make($destinationPath . $filename)->resize(100, 100)->save($destinationPath . "100x100_" . $filename);
            $entry = new Fileentry();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename().'.'.$filename;
            $entry->tender_id= DB::table('tenders')->max('id');
            $entry->user_id= Auth::user()->id;
            $entry->save();
            Session::flash('success','the file has been added ');
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }return view('welcome');
});

Route::post('/uploadSecond', function (Request $request) {
    $tender_id =$request['tender_id'];
    $file = Input::file('file');
    if($file) {
        $destinationPath = storage_path() . "/app/";
        $filename = $file->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        if ($upload_success) {
            // resizing an uploaded file
            // Image::make($destinationPath . $filename)->resize(100, 100)->save($destinationPath . "100x100_" . $filename);
            $entry = new Fileentry();
            $entry->tender_id =$tender_id;
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename() . '.' . $filename;
            $entry->user_id = Auth::user()->id;
            $entry->save();
            Session::flash('success','the file has been added ');
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
    return view('welcome');
});

// delete image
Route::post('delete-image', function () {


    $destinationPath = public_path() . '/uploads/';
    File::delete($destinationPath . Input::get('file'));
    File::delete($destinationPath . "100x100_" . Input::get('file'));
    return Response::json('success', 200);
});


Route::get('phaseEdit{id}',['as'=>'phaseEdit','uses'=>'TenderController@phaseEdit']);

Route::put('phaseUpdate{id}',['as'=>'phaseUpdate','uses'=>'TenderController@phaseUpdate']);


Route::get('phaseUpdates',function (){
    $tender=Tender::all();
    return view('phaseUpdates')->withTender($tender);
});


Route::get('commentUpdate{id}',['as'=>'commentUpdate','uses'=>'TenderController@commentUpdate']);
Route::put('commentSave{id}',['as'=>'commentSave','uses'=>'TenderController@commentSave']);

Route::get('makeAdmin{id}',['as'=>'makeAdmin','uses'=>'UserController@makeAdmin']);
Route::put('admin{id}',['as'=>'admin','uses'=>'UserController@admin']);


//delete profile image kullanılıyo
Route::get('/deleteImage{id}',['as'=>'/deleteImage','uses'=>'UserController@deleteImage']);

Route::put('materialUpdate{id}',['as'=>'materialUpdate','uses'=>'TenderController@materialUpdate']);

Route::get('material{id}',['as'=>'material','uses'=>'TenderController@material']);




Route::get('ongoingTenders', function () {
    $products = App\Tender::all();
    $user=App\User::all();
    return view('tender.deneme')->withProducts($products)->withUser($user);
});
Route::get('ongoingTenders/{product_id?}',function($product_id){
    $product = App\Tender::find($product_id);
    return response()->json($product);
});
Route::post('ongoingTenders',function(Request $request){
    $product = App\Tender::create($request->input());
    return response()->json($product);
});
//update
Route::put('ongoingTenders/{product_id?}',function(Request $request,$product_id){
    $product = App\Tender::find($product_id);
    if($request->details == null || $request->details=="")
    {

    }
    else{
        $product->details = $request->details;
        $product->updated_user_id =Auth::user()->id;
        $product->save();
        return response()->json($product);
    }


});






Route::get('indexReminder', function () {
    $products = App\Reminder::all();
    return view('reminder.ajax')->with('products',$products);
});
Route::get('indexReminder/{product_id?}',function($product_id){

    $product = App\Reminder::find($product_id);
    return response()->json($product);
});
Route::post('indexReminder',function(Request $request){

    $product = App\Reminder::create($request->input());
    return response()->json($product);
});

//update
Route::put('indexReminder/{product_id?}',function(Request $request,$product_id){
    $product = App\Reminder::find($product_id);
    if($request->user_reminder == null ||$request->user_reminder =="" )
    {

    }
    else{
        $product->user_reminder = $request->user_reminder;
        $product->save();
        return response()->json($product);
    }
});

Route::get('denemee{id}',['as'=>'denemee','uses'=>'TenderController@denemee']);


Route::put(' denemeStroe{id}',['as'=>'denemeStroe','uses'=>'TenderController@denemeStroe']);

Route::resource('order','OrderController');

