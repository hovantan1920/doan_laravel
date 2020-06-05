<?php  
    $i=0;
?>
@foreach($list as $cate)
    <?php 
        $i++;
    ?>
    <tr class="tr-shadow">
        <td>{{$i}}</td>
        <td>{{$cate['title']}}</td>
        <td class="text-center">{{$cate['description']}}</td>
        <td class="text-right">{{$cate['index']}}</td>
        <td>
            <div class="table-data-feature ">
            <button class="item" title="Edit" data-toggle="modal" data-target="#modal" id="btn-edit" 
            onclick="showDialogUpdate({{$cate['id']}})">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="remove({{$cate['id']}})">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                @if (!empty($cate['slug']))
                    <button class="item" title="More">
                        <a href="{{url($cate['slug'])}}.html"><i class="zmdi zmdi-more"></i></a>
                    </button>
                @endif
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>
@endforeach