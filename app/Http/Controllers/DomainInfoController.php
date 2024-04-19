<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\FaviconService;

class DomainInfoController extends Controller
{
    public function index()
    {
        $domain = Domain::all();
        return view('domains.show', compact('domains'));
    }


    public function update(Request $request, Domain $domain_friendly_name)
    {
	$domain = $request['domain_name'];

        $request->validate([
		'domain_friendly_name' => 'required:domains,domain_friendly_name,' . $request['domain_id'] 

        ]);

	$domain->update($request->all());

        return redirect()->route('/domain/$domain->id')->with('success', 'Domain Info updated successfully.');
    }

}
