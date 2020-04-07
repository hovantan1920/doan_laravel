<?php  
    $i=0;
?>
@foreach($list as $categarie)
    <?php 
        $i++;
    ?>
    <tr class="tr-shadow">
        <td>{{$i}}</td>
        <td>{{$categarie['title']}}</td>
        <td class="text-right">{{$categarie['descride']}}</td>
        <td class="text-right">{{$categarie['created_at']}}</td>
        <td class="text-right">{{$categarie['updated_at']}}</td>
        <td>
            <div class="table-data-feature">
            <button class="item" title="Edit" data-toggle="modal" data-target="#modal" id="btn-edit" onclick="show_Dialog_Update({{$categarie['id']}})">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" title="Delete" onclick="del_Item({{$categarie['id']}})">
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