<script>
    jQuery(document).ready(function () {
        var data = [];
        var obj;
        // build filter data for ajax request
        @foreach($filter as $item)
            obj = {
                col:'{{$item['col']}}',
                operator: '{{$item['operator']}}',
                value: '{{$item['value']}}',
                join:'{{$item['join']??'and'}}'
            };

            data.push(obj);
        @endforeach
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#users').dataTable({
            "language": {
                "processing"	: "<i class='fa fa-3x fa-asterisk fa-spin'></i>"
            },
            processing : true,
            serverSide : true,
            // order      : [],
            ajax       : {
                type: "POST",
                data : {filter:data},
                url      :	"{{route('apiUsers')}}",
                dataSrc  : "data",
            },
            columns    : [{data:"id"},{data:"first_name"}, { data:"last_name" },{data:"full_name" },{data:"gender"},
                {data:"num_msgs"},{data:"age"}, {data:"creation_date"},],
        });
    });
</script>
