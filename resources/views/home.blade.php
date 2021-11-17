<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expert System</title>

        {{-- Semantic UI CDN --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    </head>
    <body>
        <div class="ui container">
            {{-- START YES --}}
            @if (isset($start) && $start == 'yes')
                <form class="text-center" action="{{ url("/first") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Have you eaten excessive amount of food lately?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @endif

            {{-- FIRST YES/NO --}}
            @if (isset($first) && $first == 'yes')
                <form class="text-center" action="{{ url("/first-yes") }}" method="post">
                    {{ csrf_field() }}
                    <h5>What type of food is it, product or organic food?</h5>
                    <button type="submit" name="action" value="product" class="btn btn-primary">Product</button>
                    <button type="submit" name="action" value="organic" class="btn btn-primary">Organic</button>
                </form>
            @elseif (isset($first) && $first == 'no')
                <form class="text-center" action="{{ url("/first-no") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Do you have any disease? Please specify the disease below.</h5>
                    <input type="text" name="diseaseInput" />
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Submit</button>
                </form>
            @endif

            {{-- FIRST-YES PRODUCT/ORGANIC --}}
            @if (isset($firstYes) && $firstYes == 'product')
                <form action="{{ url("/second-product") }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h5>Are there any of the substances in the product that suits with below?.</h5>
                    <input type="checkbox" name="substances[]" value="subs1"> Substance 1<br>
                    <input type="checkbox" name="substances[]" value="subs2"> Substance 2<br>
                    <input type="checkbox" name="substances[]" value="not-listed"> Not listed<br><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @elseif (isset($firstYes) && $firstYes == 'organic')
                <form class="text-center" action="{{ url("/second-organic") }}" method="post">
                    {{ csrf_field() }}
                    <h5>What is the organic food called?</h5>
                    <input type="text" name="organicFoodInput" />
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Submit</button>
                </form>
            @endif

            {{-- SECOND-PRODUCT YES/NO --}}
            @if (isset($secondProduct) && $secondProduct == 'yes')
                <form class="text-center" action="{{ url("/second-product-check") }}" method="post">
                    {{ csrf_field() }}
                    <h5>The system determined that, [FOOD] is better avoided if you have [LIST_DISEASES].</h5>
                    <h5>Do you have any of these disease resulted?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @elseif (isset($secondProduct) && $secondProduct == 'no')
                <form class="text-center" action="{{ url("/ending") }}" method="post">
                    {{ csrf_field() }}
                    <h5>The system determined that, [FOOD] is safe no matter what disease you have.</h5>
                    <h5>But remember, eating excessive food isn't always good for your health.</h5>
                    <h5>Do you want to start from the beginning?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @endif

            {{-- SECOND-ORGANIC YES/NO --}}
            @if (isset($secondOrganic) && $secondOrganic == 'yes')
            <form action="{{ url("/second-organic-check") }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h5>Are there any of the substance in the food you know and suits list below?</h5>
                <h5>Please specify the substance if you know.</h5>
                <input type="checkbox" name="substances[]" value="subs1"> Substance 1<br>
                <input type="checkbox" name="substances[]" value="subs2"> Substance 2<br>
                <input type="checkbox" name="substances[]" value="not-listed"> Not listed<br><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @endif

            {{-- THIRD YES/NO --}}
            @if (isset($thirdYes) && $thirdYes == 'yes')
                <form class="text-center" action="{{ url("/ending") }}" method="post">
                    {{ csrf_field() }}
                    <h5>The system recommends you to avoid [SUBSTANCE_TO_AVOID].</h5>
                    <h5>For example [FOOD] which has [SUBSTANCE]</h5>
                    <h5>Do you want to start from the beginning?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @elseif (isset($thirdNo) && $thirdNo == 'no')
                <form class="text-center" action="{{ url("/ending") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Yay, that means you are safe to eat the food!.</h5>
                    <h5>But remember, eating excessive food is not always good for your health.</h5>
                    <h5>Do you want to start from the beginning?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @endif

            {{-- SYSTEM-END NO-REPEAT/NO-EXIST --}}
            @if (isset($systemEnd) && $systemEnd == 'no-repeat')
                <h5>Well then, thank you for using our system!</h5>
            @elseif (isset($systemEnd) && $systemEnd == 'not-exist')
                <h5>Sorry the system is not capable to find any answers :(</h5>
            @endif
        </div>
    </body>
</html>
