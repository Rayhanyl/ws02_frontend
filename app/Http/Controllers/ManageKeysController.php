<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ManageKeysController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }

    private function getUrlToken ()
    {
        $token = session('idtoken');
        $tokenParts = explode(".", $token);  
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        $iss = $jwtPayload->iss;
        $url = explode('/',$iss);

        return $url[0].'//'.$url[2];
    }

    public function managekeys (Request $request, $id)
    {
        $app = getUrl($this->url .'/applications/'. $id);
        if ($app == null){

            $request->session()->forget('token');
            return redirect(route('loginpage'));
        } 
        return view('myapplication.managekeys.managekeys', compact('app'));
    }

    public function productionoauth (Request $request, $id)
    {
        $url = $this->getUrlToken();
        $app = getUrl($this->url .'/applications/'. $id);
        if ($app == null){
            
            $request->session()->forget('token');
            return redirect(route('loginpage'));
        } 

        $alldata = getUrl($this->url .'/applications/'.$id.'/oauth-keys');
        $data = collect($alldata->list)->where('keyType', 'PRODUCTION')->first();
        
        if ($data != null) {
            $base64 = base64_encode($data->consumerKey.$data->consumerSecret);
        }else{
            $base64 = '';
        }

        $grant = getUrl($this->url .'/settings');
        $granttype = [
            "refresh_token" => 'Refresh Token',
            "urn:ietf:params:oauth:grant-type:saml2-bearer" => 'SAML2',
            "implicit" => 'implicit',
            "password" => 'Password',
            "client_credentials" => 'Client Credentials',
            "iwa:ntlm" => 'IWA-NTLM',
            "authorization_code" => 'Code',
            "urn:ietf:params:oauth:grant-type:token-exchange" => 'Token Exchange',
            "urn:ietf:params:oauth:grant-type:jwt-bearer" => 'JWT'
        ];

        return view('myapplication.managekeys.production.oauthkeys', compact('app','grant', 'granttype','url','data','base64'));
    }

    public function productionapi (Request $request, $id)
    {
        $app = getUrl($this->url .'/applications/'. $id);
        if ($app == null){
            
            $request->session()->forget('token');
            return redirect(route('loginpage'));
        }

        return view('myapplication.managekeys.production.apikeys', compact('app'));
    }

    public function sandboxoauth (Request $request, $id)
    {

        $url = $this->getUrlToken();
        $app = getUrl($this->url .'/applications/'. $id);
        if ($app == null){
            
            $request->session()->forget('token');
            return redirect(route('loginpage'));
        }

        $alldata = getUrl($this->url .'/applications/'.$id.'/oauth-keys');
        $data = collect($alldata->list)->where('keyType', 'SANDBOX')->first();
        
        if ($data != null) {
            $base64 = base64_encode($data->consumerKey.$data->consumerSecret);
        }else{
            $base64 = '';
        }

        $grant = getUrl($this->url .'/settings');
        $granttype = [
            "refresh_token" => 'Refresh Token',
            "urn:ietf:params:oauth:grant-type:saml2-bearer" => 'SAML2',
            "implicit" => 'implicit',
            "password" => 'Password',
            "client_credentials" => 'Client Credentials',
            "iwa:ntlm" => 'IWA-NTLM',
            "authorization_code" => 'Code',
            "urn:ietf:params:oauth:grant-type:token-exchange" => 'Token Exchange',
            "urn:ietf:params:oauth:grant-type:jwt-bearer" => 'JWT'
        ];
        
        return view('myapplication.managekeys.sandbox.oauthkeys', compact('app','grant', 'granttype','url','data','base64'));
    }

    public function sandboxapi (Request $request, $id)
    {
        $app = getUrl($this->url .'/applications/'. $id);
        if ($app == null){
            
            $request->session()->forget('token');
            return redirect(route('loginpage'));
        } 
        return view('myapplication.managekeys.sandbox.apikeys', compact('app'));
    }

    public function oauthgenerate (Request $request)
    {   

        $grant = [];
        foreach($request->granttype as $key=>$item){
            if($item == 'on'){
                $grant[] = $key;
            }
        }

        $scope = [];
        foreach($request->scopetype as $key=>$item){
            if($item == 'on'){
                $scope[] = $key;
            }
        }

        try {
            $payloads = [
                'keyType' => $request->type,
                'keyManager' => 'Resident Key Manager',
                'grantTypesToBeSupported' => $grant,
                'callbackUrl' => $request->callback,
                'scopes' => $scope,
                'validityTime' => 3600,
                'additionalProperties' => null,
            ];
            
            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->id.'/generate-keys');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '409') {
                return back()->with('warning', 'Error 409!');
            }
            if ($response->status() == ('200' || '201')) {
                return back()->with('success', 'Successful Generate OauthKeys!');
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
            
        } catch (\Exception $e) {
            dd($e);
        }

        return $request->all();
    }

    public function updateoauth (Request $request)
    {   

        $additional = (object) $request->additional;

        $grant = [];
        foreach($request->granttype as $key=>$item){
            if($item == 'on'){
                $grant[] = $key;
            }
        }

        try {

            $payloads = [
                'keyMappingId' => $request->idmapping,
                'keyManager' => $request->keymanager,
                'supportedGrantTypes' => $grant,
                'callbackUrl' => $request->callback,
                'additionalProperties' => $additional 
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->put($this->url.'/applications/'. $request->id.'/oauth-keys/'.$request->idmapping);
    
            $data =json_decode($response->getBody()->getContents());

            if ($response->status() == ('200' || '201')) {
                return back()->with('success', 'Successful Update OauthKeys!');
            }
            return back()->with('warning', 'Somthing Wrong With Data!');

        } catch (\Exception $e) {
             dd($e);
        }
    }

    public function generateaccesstoken(Request $request) 
    {   
        try {

            $payloads = [
                'consumerSecret' => $request->consumersecretkey,
                'validityPeriod' => 3600,
                'scopes' => [],
                'revokeToken' => '',
            ];
            
            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->id.'/oauth-keys/'.$request->idmapping.'/generate-token');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '409') {
                return back()->with('warning', 'Error 409!');
            }
            if ($response->status() == ('200' || '201')) {

                return response()->json(['status' => 'success', 'data' => $data]);
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
            
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function genapikey(Request $request)
    {

        try {
            $period = -1;
            if ($request->validityPeriod != null) {
                $period = $request->validityPeriod;
            }
    
            $additional = [ 
                'permittedIP' => $request->ipaddresses,
                'permittedReferer'=> $request->httpreferrers 
            ];
    
            $additional = (object) $additional;
    
            $payloads = [
                'validityPeriod' => $period,
                'additionalProperties' => $additional,
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->appid.'/api-keys/'.$request->keytype.'/generate');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '409') {
                return back()->with('warning', 'Error 409!');
            }
            if ($response->status() == ('200' || '201')) {

                return response()->json(['status' => 'success', 'data' => $data]);
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}