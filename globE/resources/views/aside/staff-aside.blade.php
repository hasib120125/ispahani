
<?php $i=0;?>
@foreach($qDepartment as $qDepartment)
@for ($i = 0; $i < 1; $i++)
<ul class="list-unstyled">
       <li class="list-group-item"><a href="{{URL::to('teacher')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>{{$qDepartment->sfdp_name}}</a></li>
</ul>
@endfor
@endforeach