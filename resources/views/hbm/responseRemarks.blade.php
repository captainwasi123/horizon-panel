
<form method="post" action="{{route('hbm.remarks.insert')}}">
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-2">
            <p><strong>Add Remarks:</strong></p>
        </div>
        <div class="col-lg-7">
                <input type="hidden" name="query_id" value="{{base64_encode($data->id)}}">
                <textarea class="form-control" rows="3" name="remarks" required></textarea>
                <br>
        </div>
        <div class="col-lg-3">
                <button type="submit" class="btn btn-success btn-sm rem-btn">Submit</button><br>
                <button type="reset" class="btn btn-default btn-sm rem-btn">Clear</button>
            
        </div>
    </div>
</form>
<div class="row">
    <div class="col-lg-12">
        <hr>
        <h5 style="padding-bottom: 5px;">History:</h5>
    </div> 

    @if(count($data->remarks) == '0')
        <div class="col-lg-12">
            <p>No Records Found.</p>
        </div>
    @endif
    @foreach($data->remarks as $key => $val)
        <div class="col-lg-12 rem-block">
            <p>{{$val->remarks}}</p>
            <p class="rem-date">{{date('d-M-Y h:i a', strtotime($val->created_at))}}</p><br>
            <p class="rem-user">User: {{empty($val->user) ? 'Unknown' : $val->user->fullname}}</p>
        </div>
    @endforeach
</div>