
@foreach($list as $item)
    <tr class="tr-shadow">
        <td>
            <div class="m-2 float-left" style="display:block">
                <img class="rounded m-1" style="height: 50px; width: 100px" src="{{$item['image_source']}}"/>
            </div>    
        </td>
        <td>{{$item['title']}}</td>
        <td class="text-right">{{$item['price']}}</td>
        <td class="text-right">{{$item['price_compare']}}</td>
        <td class="text-right"> 
            @foreach ($categories as $category)
                @if ($category['id'] == $item['category_id'])
                    {{$category['title']}}
                @endif    
            @endforeach
        </td>
        <td class="text-right"> 
            @foreach ($groups as $group)
                @if ($group['id'] == $item['group_id'])
                    {{$group['title']}}
                @endif    
            @endforeach
        </td>
        <td class="text-right">{{$item['updated_at']}}</td>
        <td>
            <div class="table-data-feature">
            <button class="item" title="Edit" data-toggle="modal" data-target="#modal" id="btn-edit" 
            onclick="showDialogUpdate({{$item['id']}})">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="remove({{$item['id']}})">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" title="More">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>
@endforeach