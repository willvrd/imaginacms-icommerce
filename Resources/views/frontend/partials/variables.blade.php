@push('footerscripts')
    @php
        $currency=localesymbol($code??'USD')
    @endphp
    <script>

        var icommerce = {
            locales: {!! json_encode(LaravelLocalization::getSupportedLocales()) !!},
            currentLocale: '{{locale()}}',
            currencySymbolLeft:"{{$currency->symbol_left}}",
            currencySymbolRight:"{{$currency->symbol_right}}",
            curremcyCode:"{{$currency->code}}",
            curremcyValue:"{{$currency->value}}",
            url:"{{url('/')}}"
        };
    </script>
@endpush