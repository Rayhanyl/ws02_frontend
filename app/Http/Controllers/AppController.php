<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AppController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }


    public function index ()
    {
        return view('home.index');
    }

    public function myapp ()
    {
        return view('myapplication.index');
    }

    public function listapp (Request $request)
    {
        try {

            $limit = 6;
            $payloads = [
                'sortBy' => $request->sortBy, 
                'sortOrder' => $request->sortOrder,
                'limit' => $limit,
                'offset' => $request->offset,
                'groupId' =>$request->groupId,
            ];


            $data = getUrl($this->url .'/applications?'. http_build_query($payloads));
            if ($data == null){
            
                $request->session()->forget('token');
                return redirect(route('loginpage'));
            } 
            if($data->pagination->total >= $limit) {
                if($data->pagination->total % $limit == 0 ){
                    $numberpages = $data->pagination->total / $limit;  
                }else{
                    $numberpages = (($data->pagination->total - ($data->pagination->total % $limit)) / $limit)+1; 
                }
            }else{
                $numberpages = 1;
            }

            return view('myapplication.listapp', compact('data','numberpages','limit'));

        } catch (\Exception $e) {
            dd($e);

            alert('Get App Filled','Failed to get app', 'error');
            return redirect()->back();
        }
    }

    public function createapp()
    {
        try {

            $data = getUrl($this->url.'/throttling-policies/application');
            return view('myapplication.create', compact('data'));

        } catch (\Exception $e) {
            dd($e);

            alert('Get App Filled','Failed to get app', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'appname'              => 'required',
            'shared'            => 'required',
            'description'       => 'max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('warning', 'Field not complete!');
        }else{
            
            try {

                $payloads = [
                    'name' => $request->appname,
                    'throttlingPolicy' => $request->shared,
                    'description' => $request->description,
                    'tokenType' => 'JWT',
                    'groups' => [],
                    'attributes' => null,
                    'subscriptionScopes' => [],
                ];

                $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Authorization' => 'Bearer '.$request->session()->get('token'),
                ])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url. '/applications');

                $data =json_decode($response->getBody()->getContents());        
                return redirect(route('listapp'))->with('success', 'Successful Create Application!');

            } catch (\Exception $e) {
                dd($e);
            }
        }

    }


    public function editapp(Request $request, $id)
    {

        $options = getUrl($this->url .'/throttling-policies/application');
        $data = getUrl($this->url .'/applications/'. $id);
        
        return view('myapplication.edit', compact('data','options'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [

            'appname'            => 'required',
            'shared'            => 'required',
            'description'       => 'max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

            try {
                $payloads = [
                    'name' => $request->appname,
                    'throttlingPolicy' => $request->shared,
                    'description' => $request->description,
                    'tokenType' => 'JWT',
                    'groups' => [],
                    'attributes' => null,
                    'subscriptionScopes' => [],
                ];
                
                $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Authorization' => 'Bearer '.$request->session()->get('token'),
                ])
                ->withBody(json_encode($payloads),'application/json')
                ->put($this->url.'/applications/'. $id);
        
                $data =json_decode($response->getBody()->getContents());
                return redirect(route('listapp'))->with('success', 'Successful Update Application!');

            } catch (\Exception $e) {
                dd($e);
            }

        }
    }

    public function delete (Request $request, $id)
    {

        try {

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->delete($this->url . '/applications/'. $id);
    
            $data =json_decode($response->getBody()->getContents());
    
            if($response->status() == 200)
            {
                return back()->with('success', 'Successful Delete Application!');
            } 
            
            return back()->with('error', 'Failed Delete Application');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
