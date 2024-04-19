<?php
namespace App\Http\Controllers;

// Load composer framework
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require(__DIR__ . '/vendor/autoload.php');
}


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Domain;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\FaviconService;


class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::paginate(5);
            
        return view('domains.index', ['domains' => $domains]);
    }
    public function overview()
    {
        $totalDomains = Domain::count();

        $domains = Domain::all();
        $recentDomains = Domain::latest()->take(5)->get();

        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();
        $latestDomainsOfMonth = Domain::whereBetween('created_at', [$startDate, $endDate])->get();
    
        return view('domains.overview', compact('totalDomains', 'domains', 'recentDomains', 'latestDomainsOfMonth'));

    }
    public function create()
    {
        return view('domains.create');
    }

    public function store(Request $request, FaviconService $faviconService)
    {
	   $request->validate([
	   'domain_name' => 'required|unique:domains,domain_name',
	    
	   ]);

	   $domain = $request->input('domain_name');
	   
	   $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	   $socket_check = @fsockopen('ssl://' . $domain, 443, $errno, $errstr, 5);

	   if (empty($socket_check) || !isset($socket_check)) {
		$ssl_enabled = "1";	
	
	  } else
	  {
		$ssl_enabled = "0";
	  }

	$read = stream_socket_client("ssl://".$domain.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	$cert = stream_context_get_params($read);
	$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

	$ssl_issuer = $certinfo['issuer']['O'];

        $url = "https://" . $domain ;
	$faviconUrl = $faviconService->getFaviconUrl($url);

	//return response()->json(['favicon_url' => $faviconUrl]);

	Domain::create([
		'domain_name' => $request['domain_name'],
		'domain_friendly_name' => $request['domain_friendly_name'],
		'ssl_enabled' => $ssl_enabled,
		'ssl_issuer' => $ssl_issuer,
		'ssl_common_name' => $certinfo['subject']['CN'],
		'ssl_issued_at' => $certinfo['validFrom_time_t'],
		'ssl_expires_at' => $certinfo['validTo_time_t'],
		'favicon_url' => $faviconUrl,		
	]);


    
    	return redirect()->route('domains.index')->with('success', 'Domain added successfully.');
    }

    public function edit(Domain $domain)
    {
        return view('domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'domain_friendly_name' => 'required:domains,domain_friendly_name,' . $domain->id
        ]);

        $domain->update($request->all());
        return view('domains.show', compact('domain'))->with('success', 'Domain updated successfully.');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domains.index')->with('success', 'Domain deleted successfully.');
    }



    public function show($id)
    {
         $domain = Domain::find($id);

         if (!$domain) {
             return redirect()->route('domains.index')->with('error', 'Domain not found');
         }

         return view('domains.show', compact('domain'));
    }


}

?>
