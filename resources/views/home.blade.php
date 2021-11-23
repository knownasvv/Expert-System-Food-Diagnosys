<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Foodn't | Expert System</title>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#disease_list').DataTable({});

            $('#submit-to-second-product').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                    $('#myAlert').css('display','block');
                    return false;
                }
            });

            $('#submit-to-second-product-check').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                    $('#myAlert').css('display','block');
                    return false;
                }
            });

            var path = "{{ url('search') }}";
            $('#disease-input-box').typeahead({
                source: function (query, process) {
                    return $.get(
                        route,
                        {query: query},
                        function (data) {return process(data);}
                    );
                }
            });

            $('#back').click(function() {
                if(confirm("Are you sure you want to go to the last question?"))
                    history.go(-1);
                return false;
            });

        });


        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;700&family=Nunito:wght@200;400;700&display=swap');
            *{
                line-height: 1rem;
                border-color: #5CB85C !important;
                font-family: 'Nunito', sans-serif;
            }
            html, .row, body{
                background-color: #cefdce;
            }
            .card-header{
                text-align: center;
                font-weight: 700;
            }
            button{
                text-align: center;
                align-self: center;
            }
            .buttons{
                text-align: center;
                margin-top: 12px;
            }
            .card-header{
                background: #5CB85C;
                color: white;
            }

            button[type="submit"], .paginate_button {
                color:white;
                font-family: 'Inconsolata', monospace;
                font-weight: 700;
                text-transform: uppercase;
                background-color: #5CB85C;
            }

            #back {
                color:black;
                font-family: 'Inconsolata', monospace;
                font-weight: 700;
                text-transform: uppercase;
                background-color: #cefdce;
            }


            button[type="submit"]:hover, .paginate_button:hover{
                background: #383;
            }

            button[type="submit"]:focus, .paginate_button:focus {
                background: rgb(32, 100, 32);
            }

            button[type="submit"]:active, .paginate_button:active, .paginate_button:visited{
                background: rgb(32, 100, 32);
            }

            .current{
            background: rgb(210, 255, 210);
            }
            .img{
                border-radius: 15%;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-light" style="background: #5CB85C; color: white !important;">
            <div class="container d-flex justify-content-center">
              <a class="navbar-brand bg-light p-1" href="#" style="border-radius: 100%">
                <img src="{{ asset('images/Logo.png')}}" width="32" height="32">
              </a>
              <a href="#" style="text-decoration: none; color: white;">
                <h5 style="font-weight: bold; line-height: 1rem;" class="p-0 m-0">FOODN'T</h5>
              </a>
            </div>
          </nav>

        <div class="container mx-auto d-flex align-items-center my-5 p-0">
            <div class="row w-100 align-middle row-cols-2 m-0 d-flex justify-content-evenly">
            <div class="card col-md-3 col-lg-3 col-xs-12 col-sm-12 p-0">
                @if (isset($lastInput))
                    <div class="card-header d-flex justify-content-between px-2">
                        <button type="button" class="btn btn-light btn-sm" id="back">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                            BACK
                        </button>
                        <h5 class="p-0 my-auto" style="font-weight: bold; line-height: 1rem;">Last Answer</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if (is_array($lastInput))
                            {{-- <?= print_r($lastInput)?> --}}
                                @foreach ($lastInput as $l)
                                    <li class="list-group-item">
                                        @if (isset($l->{"nama zat"})) {{ ucfirst($l->{"nama zat"}) }}
                                        @elseif (isset($l)) {{ ucfirst($l) }}
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item text-center">
                                    @if (isset($lastInput)) {{ ucfirst($lastInput) }}
                                    @elseif (isset( $lastInput )) {{ ucfirst($lastInput) }}
                                    @endif
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="accordion" id="accordionExample about-us">
                        <div class="accordion-item p-0">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" style="font-family: 'Inconsolata', monospace; font-weight: bold; border: 0px; background: #cefdce; color: black;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ABOUT FOODN'T
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse p-0" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0">
                                <div class="card-body p-0 py-2" style="font-size: 0.8rem;">
                                    <p class="text-center px-1 py-2 m-0">A food diagnosys expert system using <i>forward chaining.</i></p>
                                    <div class="card-header" style="background: #cefdce; color: black;">
                                        Made by Sigma-3
                                      </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">00000042524 - Elisabeth Hutabarat</li>
                                        <li class="list-group-item">00000040118 - Feiza Joane S L</li>
                                        <li class="list-group-item">00000040923 - Veren Valensia</li>
                                    </ul>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                @elseif(isset($start) && $start == "yes")
                <h5 class="card-header" id="about-us" style="font-family: 'Inconsolata', monospace;">ABOUT FOODN'T</h5>
                            <div class="card-body m-0 p-0" style="font-size: 0.8rem;">
                                <p class="text-center p-3 m-0">A food diagnosys expert system using <i>forward chaining.</i></p>
                                <div class="card-header m-0" style="background: #cefdce; color: black;">
                                    Made by Sigma-3
                                  </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">00000042524 - Elisabeth Hutabarat</li>
                                    <li class="list-group-item">00000040118 - Feiza Joane S L</li>
                                    <li class="list-group-item">00000040923 - Veren Valensia</li>
                                </ul>
                            </div>
                @endif

            </div>
            <div class="card col-md-8 col-lg-8 col-xs-12 col-sm-12 p-0">
                {{-- START YES --}}
                @if (isset($start) && $start == 'yes')
                    <h5 class="card-header">Question #1</h5>
                    <form class="text-center card-body" action="{{ url("/first") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Have you eaten excessive amount of food lately?</h5>
                        <img class="img col-4" src="{{ asset('images/excessive food.jpeg') }}"/>
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                            <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                        </div>
                    </form>
                @endif

                {{-- FIRST YES/NO --}}
                @if (isset($first) && $first == 'yes')
                <h5 class="card-header">Question #2</h5>
                <form class="text-center card-body" action="{{ url("/first-yes") }}" method="post">
                        {{ csrf_field() }}
                        <h5>What type of food is it, product or organic food?</h5>

                        <div class="container row" style="background: none;">
                            <div class="col-6">
                                <img class="img col-12 mb-3" src="{{ asset('images/product.png') }}"/>
                                <button type="submit" name="action" value="product" class="btn btn-primary" style="background-color: rgb(245, 213, 154); color: black;">Product</button>
                            </div>
                            <div class="col-6">
                                <img class="img col-12 mb-3" src="{{ asset('images/organic.jpg') }}"/>
                                <button type="submit" name="action" value="organic" class="btn btn-primary" style="background-color: rgb(172, 245, 154); color: black;">Organic</button>
                            </div>
                        </div>
                    </form>
                @elseif (isset($first) && $first == 'no')
                <h5 class="card-header">Question #2</h5>
                <form class="text-center card-body" action="{{ url("/before-first-no") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Do you have any disease?</h5>
                        <img class="img col-4" src="{{ asset('images/disease.jpg') }}"/>
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                            <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                        </div>
                    </form>
                @endif

                @if (isset($beforeFirstNo) && $beforeFirstNo == 'yes')
                <h5 class="card-header">Question #3</h5>
                <form class="text-center form-group card-body" action="{{ url("/first-no") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Please specify the disease below.</h5>
                        <input type="text" class="form-control typeahead" id="disease-input-box" name="diseases" placeholder="Disease" required/>
                       <div class="container buttons">
                        <button type="submit" name="action" value="yes" class="btn btn-primary">Submit</button>
                       </div>
                    </form>
                @elseif (isset($beforeFirstNo) && $beforeFirstNo == 'no')
                <h5 class="card-header">Result</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}

                        <h5>Sorry the system is not capable to help you right now ☹️</h5>
                        <h5>Do you want to start from the beginning?</h5>
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                        <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                        </div>
                    </form>
                @endif

                {{-- FIRST-YES PRODUCT/ORGANIC --}}
                @if (isset($firstYes) && $firstYes == 'product')
                    <h5 class="card-header">Question #3</h5>
                    <form class="form-control card-body" action="{{ url("/second-product") }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h5>Are there any of the substances in the product that suits with below?</h5>
                            <div class="row pl-5 container-fluid" style="background: none;">
                                @foreach($substance_product as $subs)
                                <div class="pretty p-default p-round p-smooth p-plain mb-2 col-5">
                                    <input type="checkbox" name="substances[]" value="{{ $subs->{"kode zat"} }}" id="{{ $subs->{"kode zat"} }}" />
                                    <div class="state p-success-o">
                                        <label class="form-check-label" for="{{ $subs->{"kode zat"} }}">
                                            {{ ucfirst($subs->{"nama zat"}) }}
                                        </label>
                                    </div>
                                </div><br>
                            @endforeach
                            <div class="pretty p-default p-round p-smooth p-plain mb-2">
                                <input type="checkbox" name="substances[]" value="not-listed" id="not-listed" />
                                <div class="state p-success-o">
                                    <label class="form-check-label" for="not-listed">
                                        Not listed
                                    </label>
                                </div>
                            </div><br>
                            </div>
                        <div class="container buttons">
                            <button type="submit" id="submit-to-second-product" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                @elseif (isset($firstYes) && $firstYes == 'organic')
                    <h5 class="card-header">Question #3</h5>
                    <form class="text-center card-body" action="{{ url("/second-organic") }}" method="post">
                        {{ csrf_field() }}
                        <h5>What is the organic food called?</h5>
                        <input type="text" name="organicFoodInput" required />
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                @endif

                {{-- SECOND-PRODUCT YES/NO --}}
                @if (isset($secondProduct) && $secondProduct == 'yes')
                <h5 class="card-header">Result</h5>
                <form class="card-body" action="{{ url("/second-product-check") }}" method="post">
                        {{ csrf_field() }}
                        <h5>The system determined that, the food you ate excessively is better avoided if you have disease in:</h5>
                        <h6 class="text-center subtitle">Please check the disease you have.</h6>
                        <div class="alert alert-danger fade show" role="alert" id="myAlert" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <span>You must check at least one checkbox.</span>
                        </div>
                        <ol class="list-group list-group-numbered">
                            @if(isset($list_diseases))
                                @foreach($list_disease_types as $dt)
                                    <?php $jenisNow = $dt->{'jenis penyakit'}; ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        {{-- <input type="checkbox" class="list_disease_types" name="diseases[]" value="{{ $jenisNow }}"> --}}

                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $dt->{'jenis penyakit'} }}</div>
                                        <ul style="list-style-type:none; list-style-position: inside; padding-left: 0;">
                                            @foreach($list_diseases as $d)
                                                @if($jenisNow == $d->{'jenis penyakit'})
                                                    <li class="my-2 col-lg-6 col-sm-12">
                                                        <div class="pretty p-default p-round p-smooth p-plain">
                                                            <input type="checkbox" class="list_diseases" name="diseases[]" value="{{ $d->{'nama penyakit'} }}" />
                                                            <div class="state p-success-o">
                                                                <label>{{ ucfirst($d->{'nama penyakit'}) }}</label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ol>
                        <div class="container buttons">
                            <button type="submit" id="submit-to-second-product-check" name="action" value="yes" class="btn btn-primary">Submit</button>
                            <button type="submit" name="action" value="no" class="btn btn-primary">No disease</button>
                        </div>
                    </form>
                @elseif (isset($secondProduct) && $secondProduct == 'no')
                <h5 class="card-header">Result</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}
                        <h5>The system determined that, the food you ate excessively is safe no matter what disease you have.</h5>
                        <h5>But remember, eating excessive food isn't always good for your health.</h5>
                        <h5>Do you want to start from the beginning?</h5>
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                            <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                        </div>
                    </form>
                @endif

                {{-- SECOND-ORGANIC YES/NO --}}
                @if (isset($secondOrganic) && $secondOrganic == 'yes')
                <h5 class="card-header">Question #4</h5>
                <form action="{{ url("/second-organic-check") }}" class="form-control card-body" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h5>We are not able to find any result regarding the food you input.</h5>
                    <h5>Are there any of the substances in the product that suits with below?.</h5>
                    @if(isset($substance_organic))
                        @foreach($substance_organic as $subs)
                        <div class="pretty p-default p-round p-smooth p-plain mb-2">
                            <input type="checkbox" name="substances[]" value="{{ $subs->{"kode zat"} }}" id="{{ $subs->{"kode zat"} }}" />
                            <div class="state p-success-o">
                                <label class="form-check-label" for="{{ $subs->{"kode zat"} }}">
                                    {{ $subs->{"nama zat"} }}
                                </label>
                            </div>
                        </div><br>
                        @endforeach
                    @endif
                    <div class="pretty p-default p-round p-smooth p-plain mb-2">
                        <input type="checkbox" name="substances[]" value="not-listed" id="not-listed" />
                        <div class="state p-success-o">
                            <label class="form-check-label" for="not-listed">
                                Not listed
                            </label>
                        </div>
                    </div><br>
                    <div class="container buttons">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @endif

                {{-- THIRD YES/NO --}}
                @if (isset($thirdYes) && $thirdYes == 'yes')
                <h5 class="card-header">Recommendation Table</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}
                        <h5>The system recommends you to avoid food(s) stated in table below.</h5>
                        <table id="disease_list" class="table table-striped table-hover border-dark table-responsive">
                            <thead>
                                <tr class="table table-success border-dark">
                                    <th>DISEASES</th>
                                    <th>SUBSTANCES</th>
                                    <th>FOOD TYPES</th>
                                    <th>FOODS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($avoid))
                            {{-- <?= dd($avoid);?> --}}
                                @foreach ($avoid as $a)
                                    <tr>
                                        <td>{{ ucfirst($a->{'nama penyakit'}) }}</td>
                                        <td>{{ ucfirst($a->{'nama zat'}) }}</td>
                                        <td>{{ ucfirst($a->{'jenis makanan'}) }}</td>
                                        <td>{{ ucfirst($a->{'isi makanan'}) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <br><br>
                        <h5>Do you want to start from the beginning?</h5>

                       <div class="container">
                        <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                        <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                       </div>
                    </form>
                @elseif (isset($thirdNo) && $thirdNo == 'no')
                <h5 class="card-header">Result</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Yay, that means you are safe to eat the food!.</h5>
                        <h5>But remember, eating excessive food is not always good for your health.</h5>
                        <h5>Do you want to start from the beginning?</h5>
                        <div class="container buttons">
                            <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                            <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                        </div>
                    </form>
                @endif

                {{-- SYSTEM-END NO-REPEAT/NO-EXIST --}}
                @if (isset($systemEnd) && $systemEnd == 'no-repeat')
                <h5 class="card-header">Result</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Well then, thank you for using our system!</h5>
                        <h5>Do you want to start from the beginning?</h5>
                       <div class="container buttons">
                        <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                        <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                       </div>
                    </form>
                @elseif (isset($systemEnd) && $systemEnd == 'not-exist')
                <h5 class="card-header">Result</h5>
                <form class="text-center card-body" action="{{ url("/ending") }}" method="post">
                        {{ csrf_field() }}
                        <h5>Sorry the system is not capable to find any answers :(</h5>
                        <h5>Do you want to start from the beginning?</h5>
                       <div class="container buttons">
                        <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                        <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                    </form>
                       </div>
                @endif
            </div>
        </div></div>
        <footer class="footer mt-auto py-3" style="background:#5CB85C; color: white;">
            <div class="container">
                <a href="https://github.com/knownasvv/Expert-System-Food-Diagnosys" target="_blank" style="text-decoration: none; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" style="line-height: 1rem;" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    <span style="line-height: 1rem; font-family: 'Inconsolata', monospace;">Source code</span>
                </a>
            </span>
            </div>
          </footer>
    </body>
</html>
