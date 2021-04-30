<?php
use Illuminate\Support\Facades\Route;

Route::prefix("setting")->group(function (){
    Route::get("/", "SettingController@index")->name("get.setting.list");
    Route::get("email/", "SettingController@emailConfig")->name("get.setting.emailConfig");
    Route::post("email/", "SettingController@emailConfig")->name("post.setting.emailConfig");
});
