{{-- Table --}}

<div class="table-responsive">

<table id="{{ $id }}" style="width:100%" {{ $attributes->merge(['class' => $makeTableClass()]) }}>

    {{-- Table head --}}
    <thead @isset($headTheme) class="thead-{{ $headTheme }}" @endisset>
        <tr>
            @foreach($heads as $th)
                <th @isset($th['classes']) class="{{ $th['classes'] }}" @endisset
                    @isset($th['width']) style="width:{{ $th['width'] }}%" @endisset
                    @isset($th['no-export']) dt-no-export @endisset>
                    {{ is_array($th) ? ($th['label'] ?? '') : $th }}
                </th>
            @endforeach
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>{{ $slot }}</tbody>

    {{-- Table footer --}}
    @isset($withFooter)
        <tfoot @isset($footerTheme) class="thead-{{ $footerTheme }}" @endisset>
            <tr>
                @foreach($heads as $th)
                    <th>{{ is_array($th) ? ($th['label'] ?? '') : $th }}</th>
                @endforeach
            </tr>
        </tfoot>
    @endisset

</table>

</div>

{{-- Add plugin initialization and configuration code --}}

{{-- @push('js')
<script>

    $(() => {
        let config = @json($config);

        // Convert any string functions into real functions
        for (let col of config.columns) {
            console.log(col);
            for (let key in col) {
                if (typeof col[key] === 'string' && col[key].startsWith('function')) {
                    console.log(col[key]);
                    // Create a function from the string
                    col[key] = new Function("return " + col[key])();
                }
            }
        }

        console.log(config);

        $('#{{ $id }}').DataTable(config);
    })

</script>
@endpush --}}

{{-- Add CSS styling --}}

@isset($beautify)
    @push('css')
    <style type="text/css">
        #{{ $id }} tr td,  #{{ $id }} tr th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    @endpush
@endisset
