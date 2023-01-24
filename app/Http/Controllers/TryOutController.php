<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
class TryOutController extends Controller
{
    public function __construct()
    {
        $this->url = getUrlApi();
    }

    public function vtryout(Request $request, $id)
    {
        $app = getUrl($this->url .'/applications/'. $id);
        $subs = getUrl($this->url .'/subscriptions?applicationId='. $id);
        $apptoken = getUrl($this->url .'/applications/'.$id.'/oauth-keys');
        $sandbox = collect($apptoken->list)->where('keyType', 'SANDBOX')->first();
        $production = collect($apptoken->list)->where('keyType', 'PRODUCTION')->first();
        if ($app == null){

            $request->session()->forget('token');
            return redirect(route('loginpage'));
        } 

        return view('myapplication.tryout.tryout', compact('app','subs','sandbox','production'));
    }

    public function generatetestkeyapikey(Request $request)
    {

        try {    
            $payloads = [
                'validityPeriod' => "-1",
                'additionalProperties' => null,
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->appid.'/api-keys/'.$request->keytype.'/generate');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '400') {
                return back()->with('warning', 'Invalid keyType, Sandbox Or Production');
            }
            if ($response->status() == ('200' || '201')) {

                return response()->json($data);
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function generatetestkeyoauth(Request $request)
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
}
