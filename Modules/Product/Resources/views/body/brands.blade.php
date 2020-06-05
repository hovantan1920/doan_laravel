@foreach($list as $brand)
    <tr class="tr-shadow">
        <td>
            <div class="m-2 float-left" style="display:block">
                <img class="rounded m-1" style="height: 50px; width: 100px" src="{{$brand['image_source']}}"/>
            </div>
        </td>
        <td>{{$brand['title']}}</td>
        <td>{{$brand['description']}}</td>
        <td>{{$brand['country']}}</td>
        <td>{{$brand['updated_at']}}</td>
        <td>
            <div class="table-data-feature">
            <button class="item" title="Edit" data-toggle="modal" data-target="#modal" id="btn-edit" 
            onclick="showDialogUpdate({{$brand['id']}})">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="remove({{$brand['id']}})">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                @if (!empty($brand['slug']))
                    <button class="item" title="More">
                        <a href="{{url($brand['slug'])}}.html"><i class="zmdi zmdi-more"></i></a>
                    </button>
                @endif
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>
@endforeach