<?php  
    $i=0;
?>
@foreach($list as $brand)
    <?php 
        $i++;
    ?>
    <tr class="tr-shadow">
        <td>{{$i}}</td>
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
                <button class="item" title="More">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>
@endforeach