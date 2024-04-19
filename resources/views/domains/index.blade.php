@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Domains</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Domain</th>
		                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Registrar</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SSL Issuer</th>
		                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SSL Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SSL Expiry</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SSL Expires At</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
		              <tbody>
                  @foreach($domains as $key => $domain)
		                @php
		                  $ssl_validity = ceil( abs( $domain->ssl_expires_at - $domain->ssl_issued_at ) / 86400);
		                  $ssl_expiry_days = ceil(abs(time() - $domain->ssl_expires_at) / 86400);
		                  $ssl_expiry_percent = 100 - ( round( $ssl_expiry_days / $ssl_validity * 100)) ;
		                @endphp
                    <tr>
		                  <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ $domain->favicon_url }}" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <a href="/domain/{{ $domain->id}}/ ">
                              <h6 class="mb-0 text-sm">{{ $domain->domain_friendly_name }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $domain->domain_name }}</p>
                            </a>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">IONOS SE</p>
                        <p class="text-xs text-secondary mb-0">{{ $ssl_validity }}</p>
		                  </td>
                      <td>
                        <span class="text-xs font-weight-bold">{{ $domain->ssl_issuer}}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Active</span>
		                  </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">{{ $ssl_expiry_days }} Days</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow= {{ $ssl_expiry_percent }} aria-valuemin="0" aria-valuemax="100" style="width: {{ $ssl_expiry_percent }}%;" ></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', $domain->ssl_expires_at) }}</span>
		                  </td>
                      <td class="align-middle">			
                        <form action="{{ route('domains.destroy', $domain->id) }}" method="POST">
                          @csrf
			                    @method('DELETE')                    
                          <button type="submit" class="btn btn-danger">Delete</button>
			                    <a href="{{ route('domains.index') }}" class="btn btn-secondary">Edit</a>
                        </form>
		                  </td>		    		   
		                </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>                                  
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="?page=1" tabindex="-1"><i class="fa fa-angle-left"></i><span class="sr-only">Previous</span></a></li>
                <li class="page-item {{ (Request::is('?page=1') ? 'active' : '') }} "><a class="page-link" href="?page=1">1</a></li>
                <li class="page-item {{ (Request::is('?page=2') ? 'active' : '') }}"><a class="page-link " href="?page=2">2</a></li>
                <li class="page-item"> <a class="page-link" href="?page=2"> <i class="fa fa-angle-right"></i> <span class="sr-only">Next</span></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
