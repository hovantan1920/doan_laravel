@foreach($list as $item)
    <tr class="tr-shadow">
        <td>
            <div class="m-2 float-left" style="display:block">
                <img class="rounded m-1" style="height: 50px; width: 100px" src="{{$item['image_source']}}"/>
            </div>
        </td>
        <td>{{$item['slogan']}}</td>
        <td>{{$item['index']}}</td>
        <td>{{$item['updated_at']}}</td>
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