<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ConfirmPasswordRequest;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
        $this->url_regis = getUrlRegis();
        $this->url_login = getUrlLogin();

    }

    public function loginpage ()
    {
        return view('auth.login');
    }

    public function authentication (Request $request)
    {
        $validator = Validator::make($request->all(), [

            'username'              => 'required',
            'password'              => 'required',

        ],[
            'username' => 'Username form cannot be empty',
            'password' => 'The password form cannot be empty',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

                $payloads = [
                    'grant_type' => 'password',
                    'username' => $request->username,
                    'password' => $request->password,
                    'scope' => 'apim:admin apim:api_key apim:app_import_export apim:app_manage apim:store_settings apim:sub_alert_manage apim:sub_manage apim:subscribe openid apim:subscribe'
                ];

                $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Authorization' => 'Basic ckJpNTJRa1QyT0dTUjk5a0R6TTVPMGtRT253YToxdXY5UmI4UjBRZWZLaEVkSExDaDBNbUZUamNh',
                ])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url_login. '/oauth2/token');

                $data = json_decode($response->getBody()->getContents());

                if ($response->status() == 200)
                {
                    $request->session()->put('token', $data->access_token);
                    $request->session()->put('idtoken', $data->id_token);

                    return redirect(route('index'))->with('success', 'Successful User Login!');
                }

                return redirect()->back()->with('warning', 'Wrong Username or Password');
        }

    }
    
    public function registerpage()
    {
        return view('auth.register');
    }

    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [

            'firstname'             => 'required',
            'lastname'              => 'required',
            'userlogin'             => 'required|min:6',
            'phone'                 => 'required|numeric',
            'email'                 => 'required|email:rfc,dns',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            try {
                
                $payloads = [
                    'user' =>
                        [
                            'username' => $request->userlogin,
                            'realm' => 'PRIMARY',
                            'password' => $request->password,
                            'claims' =>
                            [
                                [
                                    "uri" => "http://wso2.org/claims/givenname",
                                    "value" => $request->firstname
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/emailaddress",
                                    "value" => $request->email
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/lastname",
                                    "value" => $request->lastname
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/mobile",
                                    "value" => $request->phone
                                ]
                            ],
                        ],
                    'properties' =>
                        [
                            [
                                "key" => "callback",
                                "value" => "https://194.233.88.81:9443/authenticationendpoint/login.do"
                            ]
                        ]
                ];

                $response = Http::withBasicAuth('admin', 'admin')
                ->withOptions(['verify' => false])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url_regis. '/identity/user/v1.0/me');

                $data = json_decode($response->getBody()->getContents());

                if ($response->status() == '409') {
                    return back()->with('warning', $data->description);
                } else {
                    return redirect(route('loginpage'))->with('success', 'Successful User Registration!');
                }

            } catch (\Exception $e) {
                dd($e);

                alert('Register user','Failed to perform user registration', 'error');
                return redirect()->back()->withInput($request->input());
            }

        }
    }

    public function changepassword(Request $request)
    {
        try {

            $payloads = [
                'currentPassword' => $request->currentpassword,
                'newPassword' => $request->newpassword
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url. '/me/change-password');

            $data =json_decode($response->getBody()->getContents());
            
            if ($response->status() == '401') {
                $request->session()->forget('token');
                return redirect(route('loginpage'));
            }
            if ($response->status() == '400') {
                if ($data->code == '901451') {
                    return back()->with('warning', 'Current password incorrect');
                }
            }
            if ($response->status() == ('200')) {
                return redirect(route('index'))->with('success', 'Successful Change Password!');
            }
            return back()->with('warning', 'Somthing Wrong With Data!');

            return redirect(route('index'))->with('success', 'Successful Change Password!');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('token');
        return redirect(route('loginpage'));
    }

    // Forgot Password
    public function forgetpage()
    {
        return view('auth.forgotpassword.forgotpass');
    }

    // public function forgotpassword(Request $request)
    // {        
    //     try {
            
    //         $response = Http::withOptions(['verify' => false])
    //         ->asForm()->post('https://194.233.88.81:9443/accountrecoveryendpoint/verify.do', [
    //             'usernameUserInput' => $request->username,
    //             'username' => $request->username,
    //             'tenantDomain' => 'carbon.super',
    //             'isSaaSApp' => 'true',
    //             'recoveryOption' => 'EMAIL',
    //             'callback' => 'https://194.233.88.81:9443/authenticationendpoint/login.do?authenticators=BasicAuthenticator:LOCAL&response_type=code&type=oidc&tenantDomain=carbon.super&client_id=&relyingParty=&passiveAuth=false&isSaaSApp=true&commonAuthCallerPath=/oauth2/authorize&scope=apim:admin+apim:api_key+apim:app_import_export+apim:app_manage+apim:store_settings+apim:sub_alert_manage+apim:sub_manage+apim:subscribe+openid&forceAuth=false&sessionDataKey=&redirect_uri=https://194.233.88.81:9443/devportal/services/auth/callback/login&state=/apis&sp=apim_devportal',
    //         ]);

    //         $data = $response->getBody()->getContents();
    //         if ($response->status() == '200') {
    //             return redirect(route('loginpage'))->with('success', 'Cek your email for reset password');
    //         }

    //         return back()->with('warning', 'Failed!');

    //     } catch (\Exception $e) {
    //         dd($e);
    //     }
    // }

    public function vnewpassword(Request $request)
    {
        $payloads = [
            'code' => $request->confirmation,
            'step' => '',
            'properties' => [],
        ];

        $response = Http::withOptions(['verify' => false])
        ->withBasicAuth('admin', 'admin')
        ->withHeaders([
            'Authorization' => 'Basic YWRtaW46YWRtaW4=',
            'Accept' => '*/*',
        ])
        ->withBody(json_encode($payloads),'application/json')
        ->post('https://194.233.88.81:9443/t/carbon.super/api/identity/recovery/v0.9/validate-code');
        $data = json_decode($response->getBody()->getContents());
        $status = $response->status();
        $confirmation = $request->confirmation;
        if ($response->status() == '400') {
            $invalid = $data->description;
            return view('auth.forgotpassword.newpassword',compact('status','data','confirmation','invalid'));
        } else {
            return view('auth.forgotpassword.newpassword',compact('status','data','confirmation'));
        }
    }


    public function updatenewpassword(Request $request)
    {
        $payloads = [
            'key' => $request->confirmation,
            'password' => $request->password,
            'properties' => [],
        ];

        $response = Http::withOptions(['verify' => false])
        ->withBasicAuth('admin', 'admin')
        ->withHeaders([
            'Authorization' => 'Basic YWRtaW46YWRtaW4=',
            'Accept' => '*/*',
        ])
        ->withBody(json_encode($payloads),'application/json')
        ->post('https://194.233.88.81:9443/t/carbon.super/api/identity/recovery/v0.9/set-password');
        $data = json_decode($response->getBody()->getContents());
    
        if ($response->status() == '200') {
            return redirect(route ('loginpage'))->with('success', 'Bershasil mereset password');
        }

        return back()->with('warning', $data->description);
    }
}
