<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SettingsController extends Controller
{
   public function selectShippingMethods($type){
      if($type === 'free')
         $shippingMethod = Setting::where('key','free_shipping_label')->first();
      elseif ($type === 'inner')
           $shippingMethod = Setting::where('key','local_label')->first();
      elseif($type === 'outer')
           $shippingMethod = Setting::where('key','outer_label')->first();
      else
           $shippingMethod = Setting::where('key','free_shipping_label')->first();
      return view('dashboard.settings.shippings.edit' , compact('shippingMethod'));
   }
   public function updateShippingMethods(ShippingsRequest $request , $id){
       try{
           $shipping=Setting::find($id);
           DB::beginTransaction();
           $shipping->update(['plain_value'=>$request->get('plain_value')]);
           //---save translation
           $shipping->value=$request->get('value');
           $shipping->save();
           DB::commit();
           return redirect()->back()->with(['success'=>__('admin/sidebar.update successfully')]);
       }catch (Exception $ex){
           return redirect()->back()->with(['errors'=>__('admin/sidebar.An error occurred during modification')]);
          DB:rollback();
       }


   }
}
