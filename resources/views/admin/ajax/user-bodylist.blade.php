<?php  
    $i=0;
?>
@foreach($list as $user)
    <?php 
        $i++;
    ?>
    <tr class="tr-shadow">
        <td>{{$i}}</td>
        <td>{{$user['name']}}</td>
        <td>
            @foreach($roles as $role)
                @if($role['id'] == $user['roles_id'])
                    {{$role['title']}}   
                @endif    
            @endforeach
        </td>
        <td class="text-right">{{$user['email']}}</td>
        <td class="text-right">{{$user['created_at']}}</td>
        <td class="text-right">{{$user['updated_at']}}</td>
        <td>
            <div class="table-data-feature">
                <button class="item" data-toggle="modal" data-target="#modal" data-placement="top" title="Edit" onclick="show_Dialog_Update({{$user['id']}})">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach