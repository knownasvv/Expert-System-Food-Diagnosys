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
            @if (isset($start) && $start == 'yes')
                <form class="text-center" action="{{ url("/first") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Have you eaten excessive amount of food lately?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @endif
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
            @if (isset($firstYes) && $firstYes == 'product')
                <form class="text-center" action="{{ url("/second-product") }}" method="post">
                    {{ csrf_field() }}
                    <h5>The system determined that, this food you ate is better avoided if you have [LIST_DISEASES].</h5>
                    <h5>Do you have any of these disease resulted?.</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @elseif (isset($firstYes) && $firstYes == 'organic')
                {{-- <form class="text-center" action="{{ url("/second-organic") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Have you eaten excessive amount of food lately?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form> --}}
            @endif
            @if (isset($secondProduct) && $secondProduct == 'yes')
                <form class="text-center" action="{{ url("/ending") }}" method="post">
                    {{ csrf_field() }}
                    <h5>The system recommends you to avoid [SUBSTANCE_TO_AVOID].</h5>
                    <h5>For example [FOOD] which has [SUBSTANCE]</h5>
                    <h5>Do you want to start from the beginning?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @elseif (isset($secondProduct) && $secondProduct == 'no')
                <form class="text-center" action="{{ url("/ending") }}" method="post">
                    {{ csrf_field() }}
                    <h5>Yay, thatmeans you are safe to eat the food!.</h5>
                    <h5>But remember, eating excessive food is not always good for your health.</h5>
                    <h5>Do you want to start from the beginning?</h5>
                    <button type="submit" name="action" value="yes" class="btn btn-primary">Yes</button>
                    <button type="submit" name="action" value="no" class="btn btn-primary">No</button>
                </form>
            @endif
            @if (isset($systemEnd) && $systemEnd == 'no-repeat')
                <h5>Well then, thank you for using our system!</h5>
            @endif
            @if (isset($systemEnd) && $systemEnd == 'not-exist')
                <h5>Sorry the system is not capable to find any answers :(</h5>
            @endif
        </div>
    </body>
</html>
