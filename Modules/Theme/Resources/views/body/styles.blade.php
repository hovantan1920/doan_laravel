<?php  
    $i=0;
?>
@foreach($list as $item)
    <?php 
        $i++;
    ?>
    <tr class="tr-shadow">
        <td>{{$i}}</td>
        <td>{{$item['key']}}</td>
        <td style="color: {{$item['value']}}">{{$item['value']}}</td>
        <td>{{$item['description']}}</td>
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