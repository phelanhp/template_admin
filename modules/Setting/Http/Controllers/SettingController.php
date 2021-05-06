<?php

namespace Modules\Setting\Http\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Setting\Model\Setting;


class SettingController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        return view("Setting::index");
    }

    /**
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function emailConfig(Request $request) {
        $post    = $request->post();
        $setting = new Setting();

        if($post) {

            foreach($post as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                if(!empty($setting)) {
                    $setting->update(['value' => $value]);
                } else {
                    $setting        = new Setting();
                    $setting->key   = $key;
                    $setting->value = $value;
                    $setting->save();
                }
            }

            $request->session()->flash('success', 'Email Config updated successfully.');

            return redirect()->back();
        }

        return view("Setting::email", compact('setting'));
    }

    /**
     * @return RedirectResponse
     */
    public function testSendMail(Request $request){
        $mail_to = 'phuchp.613@gmai.com';
        $subject = 'Test email';
        $title = 'Test email function';
        $body = 'We are testing email!';
        Helper::sendMail( $mail_to, $subject, $title, $body, 'Base::mail.send_test_mail');

        $request->session()->flash('success', 'Mail send successfully');

        return redirect()->back();
    }
}
